<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\GalleryItem;
use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Section;
use App\Models\TeamMember;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $featuredServices = Service::where('featured', true)
                                   ->where('is_active', true)
                                   ->orderBy('order')
                                   ->take(3)
                                   ->get();

        $testimonials = Testimonial::where('is_active', true)
                                    ->orderBy('order')
                                    ->take(6)
                                    ->get();

        $galleryItems = GalleryItem::where('is_active', true)
                                   ->orderBy('order')
                                   ->take(6)
                                   ->get();

        $settings = Setting::pluck('value', 'key');

        $heroSections = Section::where('page_id', 1)
                               ->where('type', 'hero')
                               ->where('is_active', true)
                               ->orderBy('order')
                               ->get();

        $cardsSections = Section::where('page_id', 1)
                                ->where('order', 3)
                                ->where('is_active', true)
                                ->orderBy('id')
                                ->take(3)
                                ->get();

        $servicesSections = Section::where('page_id', 1)
                                   ->where('type', 'services')
                                   ->where('order', 4)
                                   ->where('is_active', true)
                                   ->orderBy('id')
                                   ->get();

        $latestPosts = BlogPost::where('is_published', true)
                               ->orderBy('published_at', 'desc')
                               ->take(4)
                               ->get();

        $team = TeamMember::where('is_active', true)
                          ->orderBy('id', 'desc')
                          ->get();

        $facilitiesImages = GalleryItem::where('is_active', true)
                                       ->where('category', 'instalaciones-home')
                                       ->orderBy('created_at', 'desc')
                                       ->take(6)
                                       ->get();

        $brands = Brand::where('is_active', true)
                       ->orderBy('id', 'desc')
                       ->take(10)
                       ->get();
                       
        $glassesvideo = Section::where('page_id', 1)
                               ->where('type', 'custom')
                               ->where('is_active', true)
                               ->where('order', 5)
                               ->take(3)
                               ->get();

        $presentationVideo = Section::where('page_id', 1)
                                    ->where('type', 'custom')
                                    ->where('is_active', true)
                                    ->where('order', 6)
                                    ->first();

        $testimonialVideos = Testimonial::where('is_active', true)
                                        ->whereNotNull('link')
                                        ->orderBy('order')
                                        ->take(3)
                                        ->get();

        // Variable para productos con video
        $videoSpotlightProducts = Product::where('is_active', true)
                                        ->where(function ($query) {
                                            $query->whereNotNull('video')->orWhereNotNull('link');
                                        })
                                        ->with(['brand', 'category', 'images'])
                                        ->orderBy('created_at', 'desc')
                                        ->take(10)
                                        ->get();

        // Productos destacados (base para los filtros)
        $featuredProducts = Product::where('is_featured', true)
                                   ->where('is_active', true)
                                   ->with(['brand', 'category', 'images'])
                                   ->orderBy('created_at', 'desc')
                                   ->take(18) // Más productos para los filtros
                                   ->get();

        // VARIABLES PARA SECCIÓN DE FILTROS DE PRODUCTOS
        
        // Productos Nuevos - Solo productos marcados como nuevos
        $newProducts = Product::where('is_active', true)
                              ->where('is_new', true)
                              ->with(['brand', 'category', 'images'])
                              ->orderBy('created_at', 'desc')
                              ->take(12)
                              ->get();

        // Productos en Oferta - Solo productos con precio de oferta
        $saleProducts = Product::where('is_active', true)
                               ->whereNotNull('sale_price')
                               ->where('sale_price', '>', 0)
                               ->whereColumn('sale_price', '<', 'price')
                               ->with(['brand', 'category', 'images'])
                               ->orderBy(DB::raw('((price - sale_price) / price)'), 'desc') // Ordenar por mayor descuento
                               ->take(12)
                               ->get();

        // Si no hay suficientes productos nuevos, completar con destacados
        if ($newProducts->count() < 6) {
            $additionalProducts = Product::where('is_active', true)
                                        ->where('is_featured', true)
                                        ->whereNotIn('id', $newProducts->pluck('id'))
                                        ->with(['brand', 'category', 'images'])
                                        ->orderBy('created_at', 'desc')
                                        ->take(12 - $newProducts->count())
                                        ->get();
            $newProducts = $newProducts->concat($additionalProducts);
        }

        // Si no hay suficientes productos en oferta, completar con destacados
        if ($saleProducts->count() < 6) {
            $additionalSaleProducts = Product::where('is_active', true)
                                            ->where('is_featured', true)
                                            ->whereNotIn('id', $saleProducts->pluck('id'))
                                            ->with(['brand', 'category', 'images'])
                                            ->orderBy('price', 'asc') // Ordenar por precio más bajo
                                            ->take(12 - $saleProducts->count())
                                            ->get();
            $saleProducts = $saleProducts->concat($additionalSaleProducts);
        }

        // VARIABLES PARA PRODUCTOS POR GÉNERO
        
        // Productos para hombres (incluye unisex)
        $mensProducts = Product::where('is_active', true)
                               ->whereIn('gender', ['hombre', 'unisex'])
                               ->with(['brand', 'category', 'images'])
                               ->orderBy('created_at', 'desc')
                               ->take(12)
                               ->get();

        // Productos para mujeres (incluye unisex)
        $womensProducts = Product::where('is_active', true)
                                ->whereIn('gender', ['mujer', 'unisex'])
                                ->with(['brand', 'category', 'images'])
                                ->orderBy('created_at', 'desc')
                                ->take(12)
                                ->get();

        // Productos para niños
        $kidsProducts = Product::where('is_active', true)
                               ->where('gender', 'niño')
                               ->with(['brand', 'category', 'images'])
                               ->orderBy('created_at', 'desc')
                               ->take(12)
                               ->get();

        // Portadas para secciones de género (para banners o destacados)
        $menCoverProduct = Product::where('is_active', true)
                                  ->whereIn('gender', ['hombre', 'unisex'])
                                  ->where(function ($query) {
                                      $query->whereNotNull('model_image')->orWhereNotNull('featured_image');
                                  })
                                  ->inRandomOrder()
                                  ->first();

        $womenCoverProduct = Product::where('is_active', true)
                                    ->whereIn('gender', ['mujer', 'unisex'])
                                    ->where(function ($query) {
                                        $query->whereNotNull('model_image')->orWhereNotNull('featured_image');
                                    })
                                    ->inRandomOrder()
                                    ->first();

        $kidCoverProduct = Product::where('is_active', true)
                                  ->where('gender', 'niño')
                                  ->where(function ($query) {
                                      $query->whereNotNull('model_image')->orWhereNotNull('featured_image');
                                  })
                                  ->inRandomOrder()
                                  ->first();

        // Categorías de productos con contador
        $productCategories = Category::where('is_active', true)
                                     ->whereNotNull('image')
                                     ->whereNull('parent_id')
                                     ->withCount(['products' => function ($query) {
                                         $query->where('is_active', true);
                                     }])
                                     ->orderBy('order')
                                     ->take(11) // Tomar más categorías para el grid
                                     ->get();

        return view('home.index', compact(
            'featuredServices',
            'testimonials',
            'galleryItems',
            'latestPosts',
            'settings',
            'heroSections',
            'cardsSections',
            'servicesSections',
            'team',
            'facilitiesImages',
            'brands',
            'featuredProducts',
            'glassesvideo',
            'presentationVideo',
            'testimonialVideos',
            'videoSpotlightProducts',
            // Variables para productos por género
            'mensProducts',
            'womensProducts',
            'kidsProducts',
            'menCoverProduct',
            'womenCoverProduct',
            'kidCoverProduct',
            // Variables para filtros de productos
            'newProducts',
            'saleProducts',
            // Categorías
            'productCategories'
        ));
    }
}