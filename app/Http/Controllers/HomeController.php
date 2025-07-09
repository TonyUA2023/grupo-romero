<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;
use App\Models\GalleryItem;
use App\Models\BlogPost;
use App\Models\Setting;
use App\Models\Section;


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
                                  ->take(4)
                                  ->get();

        $galleryItems = GalleryItem::where('is_active', true)
                                  ->orderBy('order')
                                  ->take(8)
                                  ->get();

        $latestPosts = BlogPost::where('is_published', true)
                              ->orderBy('published_at', 'desc')
                              ->take(3)
                              ->get();

        $settings = Setting::pluck('value', 'key');
        $featuredServices = Service::where('featured', true)
            ->where('is_active', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        $heroSection = Section::where('page_id', 1)
            ->where('type', 'hero')
            ->where('is_active', true)
            ->first();
        
        $cardsSections = Section::whereHas('page', function($q) {
            $q->where('slug', ''); // O usa el id de la página de inicio si lo tienes fijo
            })
            ->where('order', 3)
            ->where('is_active', true)
            ->orderBy('id')
            ->take(3)
            ->get();

        return view('home.index', compact(
            'featuredServices',
            'testimonials',
            'galleryItems',
            'latestPosts',
            'settings',
            'featuredServices',
            'testimonials',
            'heroSection',
            'cardsSections'
        ));
    }
}