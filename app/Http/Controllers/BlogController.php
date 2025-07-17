<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Section;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Obtener la sección hero del blog si existe
        $heroSection = Section::whereHas('page', function($q) {
            $q->where('slug', 'blogs');
        })
        ->where('type', 'hero')
        ->where('is_active', true)
        ->first();

        // Query base para posts
        $query = BlogPost::where('is_published', true)
                        ->where('published_at', '<=', now());

        // Filtro por categoría
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filtro por búsqueda
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%');
            });
        }

        // Filtro por tag
        if ($request->has('tag') && $request->tag != '') {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Filtro por mes/año
        if ($request->has('month') && $request->month != '') {
            $date = Carbon::parse($request->month);
            $query->whereYear('published_at', $date->year)
                  ->whereMonth('published_at', $date->month);
        }

        // Obtener posts paginados
        $posts = $query->orderBy('published_at', 'desc')
                      ->paginate(6)
                      ->withQueryString();

        // Post destacado (el más reciente)
        $featuredPost = null;
        if (!$request->hasAny(['category', 'search', 'tag', 'month'])) {
            $featuredPost = BlogPost::where('is_published', true)
                                   ->where('published_at', '<=', now())
                                   ->orderBy('published_at', 'desc')
                                   ->first();
        }

        // Obtener categorías únicas con conteo
        $categories = BlogPost::where('is_published', true)
                             ->where('published_at', '<=', now())
                             ->whereNotNull('category')
                             ->where('category', '!=', '')
                             ->selectRaw('category, COUNT(*) as count')
                             ->groupBy('category')
                             ->orderBy('count', 'desc')
                             ->get();

        // Obtener tags populares
        $allTags = BlogPost::where('is_published', true)
                          ->where('published_at', '<=', now())
                          ->whereNotNull('tags')
                          ->pluck('tags')
                          ->flatten()
                          ->filter()
                          ->countBy()
                          ->sortDesc()
                          ->take(15);

        // Obtener archivo (meses con posts)
        $archive = BlogPost::where('is_published', true)
                          ->where('published_at', '<=', now())
                          ->selectRaw('YEAR(published_at) as year, MONTH(published_at) as month, COUNT(*) as count')
                          ->groupBy('year', 'month')
                          ->orderBy('year', 'desc')
                          ->orderBy('month', 'desc')
                          ->take(12)
                          ->get()
                          ->map(function($item) {
                              $item->date = Carbon::createFromDate($item->year, $item->month, 1);
                              $item->formatted = $item->date->format('F Y');
                              $item->url_param = $item->date->format('Y-m');
                              return $item;
                          });

        // Posts más vistos para sidebar
        $popularPosts = BlogPost::where('is_published', true)
                               ->where('published_at', '<=', now())
                               ->orderBy('views', 'desc')
                               ->take(5)
                               ->get();

        return view('blogs.index', compact(
            'posts',
            'featuredPost',
            'categories',
            'allTags',
            'archive',
            'heroSection',
            'popularPosts'
        ));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
                       ->where('is_published', true)
                       ->where('published_at', '<=', now())
                       ->firstOrFail();

        // Incrementar vistas
        $post->increment('views');

        // Posts relacionados (misma categoría)
        $relatedPosts = BlogPost::where('id', '!=', $post->id)
                              ->where('is_published', true)
                              ->where('published_at', '<=', now())
                              ->where('category', $post->category)
                              ->orderBy('published_at', 'desc')
                              ->take(3)
                              ->get();

        // Si no hay suficientes posts relacionados, completar con recientes
        if ($relatedPosts->count() < 3) {
            $additionalPosts = BlogPost::where('id', '!=', $post->id)
                                      ->where('is_published', true)
                                      ->where('published_at', '<=', now())
                                      ->whereNotIn('id', $relatedPosts->pluck('id'))
                                      ->orderBy('published_at', 'desc')
                                      ->take(3 - $relatedPosts->count())
                                      ->get();
            
            $relatedPosts = $relatedPosts->concat($additionalPosts);
        }

        // Posts recientes para sidebar
        $recentPosts = BlogPost::where('id', '!=', $post->id)
                              ->where('is_published', true)
                              ->where('published_at', '<=', now())
                              ->orderBy('published_at', 'desc')
                              ->take(5)
                              ->get();

        // Navegación anterior/siguiente
        $previousPost = BlogPost::where('is_published', true)
                              ->where('published_at', '<=', now())
                              ->where('published_at', '<', $post->published_at)
                              ->orderBy('published_at', 'desc')
                              ->first();

        $nextPost = BlogPost::where('is_published', true)
                          ->where('published_at', '<=', now())
                          ->where('published_at', '>', $post->published_at)
                          ->orderBy('published_at', 'asc')
                          ->first();

        // Calcular tiempo de lectura
        $wordCount = str_word_count(strip_tags($post->content));
        $readingTime = ceil($wordCount / 200); // Promedio de 200 palabras por minuto

        return view('blogs.show', compact(
            'post', 
            'relatedPosts',
            'recentPosts',
            'previousPost',
            'nextPost',
            'readingTime'
        ));
    }
}