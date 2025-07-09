<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Section;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
                    ->where('status', true)
                    ->firstOrFail();

        $sections = Section::where('page_id', $page->id)
                           ->orderBy('order')
                           ->get();

        return view('pages.show', compact('page', 'sections'));
    }
}