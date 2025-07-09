<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)
                                  ->orderBy('order')
                                  ->paginate(8);

        return view('testimonials.index', compact('testimonials'));
    }
}