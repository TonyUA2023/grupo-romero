<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index()
    {
        $categories = GalleryItem::select('category')
                                ->distinct()
                                ->pluck('category');

        $galleryItems = GalleryItem::where('is_active', true)
                                  ->orderBy('order')
                                  ->get()
                                  ->groupBy('category');

        return view('gallery.index', compact('categories', 'galleryItems'));
    }
}