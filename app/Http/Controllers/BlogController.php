<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('is_published', true)
                         ->orderBy('published_at', 'desc')
                         ->paginate(6);

        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
                       ->where('is_published', true)
                       ->firstOrFail();

        // Incrementar vistas
        $post->increment('views');

        $recentPosts = BlogPost::where('id', '!=', $post->id)
                              ->where('is_published', true)
                              ->orderBy('published_at', 'desc')
                              ->take(4)
                              ->get();

        return view('blog.show', compact('post', 'recentPosts'));
    }
}