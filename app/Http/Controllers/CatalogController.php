<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Section;
use App\Models\ProductFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Obtener sección hero del catálogo si existe
        $heroSection = Cache::remember('catalog_hero_section', 3600, function() {
            return Section::whereHas('page', function($q) {
                $q->where('slug', 'catalogo');
            })
            ->where('type', 'hero')
            ->where('is_active', true)
            ->first();
        });

        // Obtener todas las categorías activas con cache
        $categories = Cache::remember('catalog_categories', 3600, function() {
            return Category::where('is_active', true)
                         ->withCount(['products' => function($query) {
                             $query->where('is_active', true);
                         }])
                         ->orderBy('order')
                         ->get();
        });

        // Obtener todas las marcas activas con cache
        $brands = Cache::remember('catalog_brands', 3600, function() {
            return Brand::where('is_active', true)
                       ->withCount(['products' => function($query) {
                           $query->where('is_active', true);
                       }])
                       ->orderBy('name')
                       ->get();
        });

        // Query base para productos
        $query = Product::where('is_active', true)
                       ->with(['category', 'brand', 'images']);

        // Guardar parámetros de filtro en array
        $activeFilters = [];

        // Filtrar por categoría si se especifica
        if ($request->filled('categoria')) {
            $categorySlug = $request->categoria;
            $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
            $activeFilters['categoria'] = $categorySlug;
        }

        // Filtrar por marca si se especifica
        if ($request->filled('marca')) {
            $brandSlug = $request->marca;
            $query->whereHas('brand', function($q) use ($brandSlug) {
                $q->where('slug', $brandSlug);
            });
            $activeFilters['marca'] = $brandSlug;
        }

        // Filtrar por búsqueda si se especifica
        if ($request->filled('buscar')) {
            $searchTerm = $request->buscar;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('short_description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('sku', 'like', '%' . $searchTerm . '%')
                  ->orWhereHas('brand', function($bq) use ($searchTerm) {
                      $bq->where('name', 'like', '%' . $searchTerm . '%');
                  })
                  ->orWhereHas('category', function($cq) use ($searchTerm) {
                      $cq->where('name', 'like', '%' . $searchTerm . '%');
                  })
                  ->orWhereHas('features', function($fq) use ($searchTerm) {
                      $fq->where('value', 'like', '%' . $searchTerm . '%');
                  });
            });
            $activeFilters['buscar'] = $searchTerm;
        }

        // Filtrar por género si se especifica
        if ($request->filled('genero')) {
            $gender = $request->genero;
            $query->where('gender', $gender);
            $activeFilters['genero'] = $gender;
        }

        // Filtrar por tipo (sol/oftálmico) si se especifica
        if ($request->filled('tipo')) {
            $type = $request->tipo;
            $query->where('type', $type);
            $activeFilters['tipo'] = $type;
        }

        // Filtrar por rango de precio
        if ($request->filled('precio_min') || $request->filled('precio_max')) {
            $minPrice = $request->precio_min;
            $maxPrice = $request->precio_max;
            
            if ($minPrice) {
                $query->where(function($q) use ($minPrice) {
                    $q->where(function($sq) use ($minPrice) {
                        $sq->whereNotNull('sale_price')
                           ->where('sale_price', '>=', $minPrice);
                    })
                    ->orWhere(function($sq) use ($minPrice) {
                        $sq->whereNull('sale_price')
                           ->where('price', '>=', $minPrice);
                    });
                });
                $activeFilters['precio_min'] = $minPrice;
            }
            
            if ($maxPrice) {
                $query->where(function($q) use ($maxPrice) {
                    $q->where(function($sq) use ($maxPrice) {
                        $sq->whereNotNull('sale_price')
                           ->where('sale_price', '<=', $maxPrice);
                    })
                    ->orWhere(function($sq) use ($maxPrice) {
                        $sq->whereNull('sale_price')
                           ->where('price', '<=', $maxPrice);
                    });
                });
                $activeFilters['precio_max'] = $maxPrice;
            }
        }

        // Filtrar por material del marco
        if ($request->filled('frame_material')) {
            $material = $request->frame_material;
            $query->where('frame_material', $material);
            $activeFilters['frame_material'] = $material;
        }

        // Filtrar por productos nuevos
        if ($request->filled('is_new')) {
            $query->where('is_new', true);
            $activeFilters['is_new'] = true;
        }

        // Filtrar por productos en oferta
        if ($request->filled('on_sale')) {
            $query->whereNotNull('sale_price')
                  ->where('sale_price', '>', 0)
                  ->whereColumn('sale_price', '<', 'price');
            $activeFilters['on_sale'] = true;
        }

        // Filtrar por características del producto (product_features)
        // Esto permite filtros dinámicos basados en las características específicas
        $featureFilters = $request->except([
            'categoria', 'marca', 'buscar', 'genero', 'tipo', 
            'precio_min', 'precio_max', 'frame_material', 'is_new', 
            'on_sale', 'ordenar', 'vista', 'por_pagina', 'page'
        ]);

        foreach ($featureFilters as $featureName => $featureValue) {
            if (!empty($featureValue)) {
                $query->whereHas('features', function($q) use ($featureName, $featureValue) {
                    $q->where('name', str_replace('_', ' ', $featureName))
                      ->where('value', $featureValue);
                });
                $activeFilters[$featureName] = $featureValue;
            }
        }

        // Guardar la consulta actual para estadísticas
        $countQuery = clone $query;

        // Ordenamiento
        $sortBy = $request->get('ordenar', 'relevancia');
        switch ($sortBy) {
            case 'nombre_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'nombre_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'precio_asc':
                $query->orderByRaw('COALESCE(sale_price, price) ASC');
                break;
            case 'precio_desc':
                $query->orderByRaw('COALESCE(sale_price, price) DESC');
                break;
            case 'nuevo':
                $query->orderBy('created_at', 'desc');
                break;
            case 'populares':
                $query->orderBy('views', 'desc');
                break;
            case 'descuento':
                $query->orderByRaw('
                    CASE 
                        WHEN sale_price IS NOT NULL AND price > 0 
                        THEN ((price - sale_price) / price) 
                        ELSE 0 
                    END DESC
                ');
                break;
            default: // relevancia
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('order', 'asc')
                      ->orderBy('created_at', 'desc');
                break;
        }

        // Vista de productos (grid o lista)
        $viewMode = $request->get('vista', session('catalog_view_mode', 'grid'));
        session(['catalog_view_mode' => $viewMode]);

        // Número de productos por página
        $perPage = $request->get('por_pagina', session('catalog_per_page', 12));
        session(['catalog_per_page' => $perPage]);

        // Paginación
        $products = $query->paginate($perPage)->withQueryString();

        // Obtener categoría activa para el breadcrumb y título
        $activeCategory = null;
        if ($request->filled('categoria')) {
            $activeCategory = Category::where('slug', $request->categoria)
                                     ->where('is_active', true)
                                     ->first();
        }

        // Obtener marca activa para el breadcrumb y título
        $activeBrand = null;
        if ($request->filled('marca')) {
            $activeBrand = Brand::where('slug', $request->marca)
                                ->where('is_active', true)
                                ->first();
        }

        // Estadísticas para mostrar
        $totalProducts = Cache::remember('total_active_products', 300, function() {
            return Product::where('is_active', true)->count();
        });
        
        $filteredCount = $countQuery->count();

        // Obtener rango de precios para el filtro
        $priceRange = Cache::remember('product_price_range', 3600, function() {
            return Product::where('is_active', true)
                        ->selectRaw('MIN(COALESCE(sale_price, price)) as min_price, MAX(COALESCE(sale_price, price)) as max_price')
                        ->first();
        });

        // Obtener materiales únicos para filtro
        $frameMaterials = Cache::remember('frame_materials', 3600, function() {
            return Product::where('is_active', true)
                        ->whereNotNull('frame_material')
                        ->distinct()
                        ->pluck('frame_material')
                        ->filter()
                        ->sort();
        });

        // Obtener características únicas para filtros dinámicos
        $availableFeatures = Cache::remember('available_product_features', 3600, function() {
            return ProductFeature::select('name', DB::raw('COUNT(DISTINCT value) as value_count'))
                                ->whereHas('product', function($q) {
                                    $q->where('is_active', true);
                                })
                                ->groupBy('name')
                                ->having('value_count', '>', 1) // Solo mostrar características con múltiples valores
                                ->having('value_count', '<', 20) // No mostrar características con demasiados valores únicos
                                ->with(['product' => function($q) {
                                    $q->where('is_active', true);
                                }])
                                ->get()
                                ->map(function($feature) {
                                    $feature->values = ProductFeature::where('name', $feature->name)
                                                                   ->whereHas('product', function($q) {
                                                                       $q->where('is_active', true);
                                                                   })
                                                                   ->distinct()
                                                                   ->pluck('value')
                                                                   ->sort();
                                    return $feature;
                                });
        });

        // Guardar productos vistos recientemente en cookie
        $this->trackViewedProducts($products);

        // Obtener productos vistos recientemente
        $recentlyViewed = $this->getRecentlyViewed();

        // Si es una petición AJAX, devolver solo la parte de productos
        if ($request->ajax()) {
            return response()->json([
                'html' => view('catalog.partials.products-grid', compact(
                    'products',
                    'viewMode'
                ))->render(),
                'pagination' => $products->links()->render(),
                'count' => $filteredCount,
                'total' => $products->total()
            ]);
        }

        return view('catalog.index', compact(
            'products',
            'categories',
            'brands',
            'heroSection',
            'activeCategory',
            'activeBrand',
            'totalProducts',
            'filteredCount',
            'priceRange',
            'frameMaterials',
            'availableFeatures',
            'activeFilters',
            'viewMode',
            'perPage',
            'recentlyViewed'
        ));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
                        ->where('is_active', true)
                        ->with(['category', 'brand', 'images', 'features'])
                        ->firstOrFail();

        // Incrementar vistas
        $product->increment('views');

        // Guardar en productos vistos recientemente
        $this->addToRecentlyViewed($product);

        // Productos relacionados (misma categoría o marca)
        $relatedProducts = Product::where('is_active', true)
                                ->where('id', '!=', $product->id)
                                ->where(function($query) use ($product) {
                                    $query->where('category_id', $product->category_id)
                                          ->orWhere('brand_id', $product->brand_id);
                                })
                                ->with(['images'])
                                ->orderBy('is_featured', 'desc')
                                ->inRandomOrder()
                                ->take(4)
                                ->get();

        // Productos de la misma marca
        $brandProducts = Product::where('is_active', true)
                              ->where('brand_id', $product->brand_id)
                              ->where('id', '!=', $product->id)
                              ->with(['images'])
                              ->orderBy('is_featured', 'desc')
                              ->take(3)
                              ->get();

        // Productos vistos recientemente (excluyendo el actual)
        $recentlyViewed = $this->getRecentlyViewed($product->id);

        // Productos más vendidos de la categoría
        $bestSellers = Product::where('is_active', true)
                            ->where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->orderBy('views', 'desc')
                            ->with(['images'])
                            ->take(4)
                            ->get();

        return view('catalog.show', compact(
            'product',
            'relatedProducts',
            'brandProducts',
            'recentlyViewed',
            'bestSellers'
        ));
    }

    // Método para vista rápida (AJAX)
    public function quickView($id)
    {
        $product = Product::where('id', $id)
                        ->where('is_active', true)
                        ->with(['category', 'brand', 'images', 'features'])
                        ->firstOrFail();

        // Incrementar vistas
        $product->increment('views');

        return response()->json([
            'html' => view('catalog.partials.quick-view', compact('product'))->render()
        ]);
    }

    // Método para buscar sugerencias (AJAX)
    public function searchSuggestions(Request $request)
    {
        $term = $request->get('q', '');
        
        if (strlen($term) < 2) {
            return response()->json([
                'products' => [],
                'brands' => [],
                'categories' => []
            ]);
        }

        $products = Product::where('is_active', true)
                         ->where(function($query) use ($term) {
                             $query->where('name', 'like', '%' . $term . '%')
                                   ->orWhere('sku', 'like', '%' . $term . '%');
                         })
                         ->with(['brand', 'category'])
                         ->take(5)
                         ->get(['id', 'name', 'slug', 'price', 'sale_price', 'featured_image', 'brand_id', 'category_id']);

        $brands = Brand::where('is_active', true)
                      ->where('name', 'like', '%' . $term . '%')
                      ->take(3)
                      ->get(['id', 'name', 'slug']);

        $categories = Category::where('is_active', true)
                            ->where('name', 'like', '%' . $term . '%')
                            ->take(3)
                            ->get(['id', 'name', 'slug']);

        return response()->json([
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    // Método para comparar productos
    public function compare(Request $request)
    {
        $productIds = $request->get('products', []);
        
        if (count($productIds) < 2) {
            return redirect()->route('catalog.index')
                           ->with('error', 'Debes seleccionar al menos 2 productos para comparar');
        }

        if (count($productIds) > 4) {
            return redirect()->route('catalog.index')
                           ->with('error', 'Puedes comparar hasta 4 productos a la vez');
        }

        $products = Product::whereIn('id', $productIds)
                         ->where('is_active', true)
                         ->with(['brand', 'category', 'images', 'features'])
                         ->get();

        if ($products->count() < 2) {
            return redirect()->route('catalog.index')
                           ->with('error', 'Algunos productos no están disponibles');
        }

        // Obtener todas las características únicas de los productos seleccionados
        $allFeatures = $products->flatMap(function($product) {
            return $product->features->pluck('name');
        })->unique()->sort();

        return view('catalog.compare', compact('products', 'allFeatures'));
    }

    // Método para filtrar por marca específica
    public function brand($slug)
    {
        $brand = Brand::where('slug', $slug)
                     ->where('is_active', true)
                     ->firstOrFail();

        // Redirigir al catálogo con el filtro de marca aplicado
        return redirect()->route('catalog.index', ['marca' => $slug]);
    }

    // Método para filtrar por categoría específica
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
                          ->where('is_active', true)
                          ->firstOrFail();

        // Redirigir al catálogo con el filtro de categoría aplicado
        return redirect()->route('catalog.index', ['categoria' => $slug]);
    }

    // Métodos privados para manejar productos vistos recientemente
    private function trackViewedProducts($products)
    {
        $viewed = json_decode(Cookie::get('viewed_products', '[]'), true);
        
        foreach ($products as $product) {
            if (!in_array($product->id, $viewed)) {
                $viewed[] = $product->id;
            }
        }
        
        // Mantener solo los últimos 20 productos
        $viewed = array_slice($viewed, -20);
        
        Cookie::queue('viewed_products', json_encode($viewed), 60 * 24 * 30); // 30 días
    }

    private function addToRecentlyViewed($product)
    {
        $viewed = json_decode(Cookie::get('recently_viewed', '[]'), true);
        
        // Remover si ya existe
        $viewed = array_diff($viewed, [$product->id]);
        
        // Agregar al principio
        array_unshift($viewed, $product->id);
        
        // Mantener solo los últimos 10
        $viewed = array_slice($viewed, 0, 10);
        
        Cookie::queue('recently_viewed', json_encode($viewed), 60 * 24 * 30); // 30 días
    }

    private function getRecentlyViewed($excludeId = null)
    {
        $viewed = json_decode(Cookie::get('recently_viewed', '[]'), true);
        
        if ($excludeId) {
            $viewed = array_diff($viewed, [$excludeId]);
        }
        
        if (empty($viewed)) {
            return collect();
        }
        
        // Preservar el orden de los IDs vistos
        $products = Product::whereIn('id', $viewed)
                         ->where('is_active', true)
                         ->with(['images'])
                         ->get()
                         ->keyBy('id');
        
        // Ordenar según el orden en que fueron vistos
        $orderedProducts = collect();
        foreach ($viewed as $id) {
            if ($products->has($id)) {
                $orderedProducts->push($products->get($id));
            }
        }
        
        return $orderedProducts;
    }

    // Método para exportar productos filtrados
    public function export(Request $request)
    {
        // Usar los mismos filtros que en index
        $query = Product::where('is_active', true)
                       ->with(['category', 'brand']);

        // Aplicar todos los filtros (mismo código que en index)
        // ... (aplicar todos los filtros aquí)

        $products = $query->get();

        // Headers para CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="productos_' . date('Y-m-d_H-i-s') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM para Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Headers
            fputcsv($file, [
                'SKU', 
                'Nombre', 
                'Marca', 
                'Categoría', 
                'Género',
                'Tipo',
                'Precio Regular', 
                'Precio Oferta', 
                'Descuento %',
                'Material',
                'Color Marco',
                'Tipo Lente',
                'Color Lente',
                'Tamaño',
                'Nuevo',
                'Destacado',
                'Vistas'
            ]);
            
            // Data
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->sku,
                    $product->name,
                    $product->brand->name,
                    $product->category->name,
                    ucfirst($product->gender),
                    ucfirst($product->type),
                    $product->price,
                    $product->sale_price ?: '',
                    $product->discount_percentage ? $product->discount_percentage . '%' : '',
                    $product->frame_material ?: '',
                    $product->frame_color ?: '',
                    $product->lens_type ?: '',
                    $product->lens_color ?: '',
                    $product->size ?: '',
                    $product->is_new ? 'Sí' : 'No',
                    $product->is_featured ? 'Sí' : 'No',
                    $product->views
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}