<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\ProductFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand']);

        // Filtro por búsqueda
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filtro por categoría
        if ($request->filled('category')) {
            $query->where('category_id', $request->get('category'));
        }

        // Filtro por marca
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->get('brand'));
        }

        // Filtro por estado
        if ($request->filled('status')) {
            if ($request->get('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->get('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Nuevo filtro: productos con imagen de modelo
        if ($request->filled('has_model') && $request->get('has_model') === '1') {
            $query->whereNotNull('model_image');
        }

        $products = $query->orderBy('order')
                         ->orderBy('created_at', 'desc')
                         ->paginate(20)
                         ->withQueryString();
                          
        return view('admin.catalog.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.catalog.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug',
            'sku' => 'nullable|string|unique:products,sku',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'gender' => 'required|in:unisex,hombre,mujer,niño',
            'type' => 'required|in:sol,oftalmico,ambos',
            'frame_material' => 'nullable|string|max:100',
            'frame_color' => 'nullable|string|max:100',
            'lens_type' => 'nullable|string|max:100',
            'lens_color' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:50',
            'featured_image' => 'nullable|image|max:2048',
            'model_image' => 'nullable|image|max:2048', // Nueva validación
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'video' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime|max:102400'
        ]);

        // Generar slug si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Generar SKU si no se proporciona
        if (empty($validated['sku'])) {
            $validated['sku'] = 'PRD-' . strtoupper(Str::random(8));
        }

        // Manejar checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_new'] = $request->has('is_new');
        $validated['is_active'] = $request->has('is_active');

        try {
            DB::beginTransaction();

            // Manejar la imagen destacada
            if ($request->hasFile('featured_image')) {
                $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
            }

            // Manejar la imagen del modelo
            if ($request->hasFile('model_image')) {
                $validated['model_image'] = $request->file('model_image')->store('products/models', 'public');
            }

            // Manejar el video
            if ($request->hasFile('video')) {
                $validated['video'] = $request->file('video')->store('products/videos', 'public');
            }

            $product = Product::create($validated);

            // Manejar imágenes adicionales
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'is_primary' => $index === 0 && !$product->featured_image,
                        'order' => $index
                    ]);
                }
            }

            // Manejar características
            if ($request->has('features')) {
                foreach ($request->features as $index => $feature) {
                    if (!empty($feature['name']) && !empty($feature['value'])) {
                        ProductFeature::create([
                            'product_id' => $product->id,
                            'name' => $feature['name'],
                            'value' => $feature['value'],
                            'order' => $index
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.catalog.products.index')
                           ->with('success', 'Producto creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                        ->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'images', 'features']);
        return view('admin.catalog.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $brands = Brand::where('is_active', true)->orderBy('name')->get();
        $product->load(['images', 'features']);
        
        return view('admin.catalog.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'gender' => 'required|in:unisex,hombre,mujer,niño',
            'type' => 'required|in:sol,oftalmico,ambos',
            'frame_material' => 'nullable|string|max:100',
            'frame_color' => 'nullable|string|max:100',
            'lens_type' => 'nullable|string|max:100',
            'lens_color' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:50',
            'featured_image' => 'nullable|image|max:2048',
            'model_image' => 'nullable|image|max:2048', // Nueva validación
            'is_featured' => 'boolean',
            'is_new' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'video' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime|max:102400'
        ]);

        // Manejar checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_new'] = $request->has('is_new');
        $validated['is_active'] = $request->has('is_active');

        try {
            DB::beginTransaction();

            // Manejar la imagen destacada
            if ($request->hasFile('featured_image')) {
                if ($product->featured_image) {
                    Storage::disk('public')->delete($product->featured_image);
                }
                $validated['featured_image'] = $request->file('featured_image')->store('products', 'public');
            }

            // Manejar la imagen del modelo
            if ($request->hasFile('model_image')) {
                if ($product->model_image) {
                    Storage::disk('public')->delete($product->model_image);
                }
                $validated['model_image'] = $request->file('model_image')->store('products/models', 'public');
            }

            // Manejar el video
            if ($request->hasFile('video')) {
                if ($product->video) {
                    Storage::disk('public')->delete($product->video);
                }
                $validated['video'] = $request->file('video')->store('products/videos', 'public');
            }

            $product->update($validated);

            // Manejar características existentes
            if ($request->has('existing_features')) {
                foreach ($request->existing_features as $featureId => $feature) {
                    if (!empty($feature['name']) && !empty($feature['value'])) {
                        ProductFeature::where('id', $featureId)
                                     ->where('product_id', $product->id)
                                     ->update([
                                         'name' => $feature['name'],
                                         'value' => $feature['value']
                                     ]);
                    }
                }
            }

            // Manejar nuevas características
            if ($request->has('features')) {
                $maxOrder = $product->features()->max('order') ?? -1;
                foreach ($request->features as $index => $feature) {
                    if (!empty($feature['name']) && !empty($feature['value'])) {
                        ProductFeature::create([
                            'product_id' => $product->id,
                            'name' => $feature['name'],
                            'value' => $feature['value'],
                            'order' => $maxOrder + $index + 1
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.catalog.products.index')
                           ->with('success', 'Producto actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                        ->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            // Eliminar imagen destacada
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }

            // Eliminar imagen del modelo
            if ($product->model_image) {
                Storage::disk('public')->delete($product->model_image);
            }

            // Eliminar video
            if ($product->video) {
                Storage::disk('public')->delete($product->video);
            }

            // Eliminar imágenes adicionales
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
            }

            // Eliminar el producto (las imágenes y características se eliminan por cascade)
            $product->delete();

            DB::commit();

            return redirect()->route('admin.catalog.products.index')
                           ->with('success', 'Producto eliminado exitosamente.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }

    // Métodos adicionales para manejo de imágenes
    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|max:2048'
        ]);

        $uploadedImages = [];
        $maxOrder = $product->images()->max('order') ?? -1;

        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('products', 'public');
            $productImage = ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_primary' => false,
                'order' => $maxOrder + $index + 1
            ]);
            $uploadedImages[] = $productImage;
        }

        return response()->json([
            'success' => true,
            'images' => $uploadedImages
        ]);
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        
        // Eliminar archivo
        Storage::disk('public')->delete($image->image_path);
        
        // Eliminar registro
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Imagen eliminada exitosamente'
        ]);
    }

    // Métodos adicionales para manejo de características
    public function addFeature(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|string|max:255'
        ]);

        $maxOrder = $product->features()->max('order') ?? -1;

        $feature = ProductFeature::create([
            'product_id' => $product->id,
            'name' => $validated['name'],
            'value' => $validated['value'],
            'order' => $maxOrder + 1
        ]);

        return response()->json([
            'success' => true,
            'feature' => $feature
        ]);
    }

    public function deleteFeature($featureId)
    {
        $feature = ProductFeature::findOrFail($featureId);
        $feature->delete();

        return response()->json([
            'success' => true,
            'message' => 'Característica eliminada exitosamente'
        ]);
    }

    /**
     * Vista previa de la imagen con modelo
     */
    public function modelPreview(Product $product)
    {
        if (!$product->model_image) {
            return response()->json([
                'success' => false,
                'message' => 'Este producto no tiene imagen con modelo'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'image_url' => $product->model_image_url,
            'product_name' => $product->name
        ]);
    }
}