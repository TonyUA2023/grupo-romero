<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('published_at', 'desc')->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogPost::distinct()->pluck('category');
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:blog_posts,slug',
            'excerpt' => 'required|string|max:300',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        // Generar slug si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Convertir tags de string a array
        if ($request->has('tags')) {
            $validated['tags'] = json_encode(
                array_map('trim', explode(',', $request->tags))
            );
        }

        // Manejar fecha de publicación
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = Carbon::now();
        }

        // Manejar imagen destacada
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo creado exitosamente.');
    }

    public function show(BlogPost $post)
    {
        return view('admin.blog.show', compact('post'));
    }

    public function edit(BlogPost $post)
    {
        $categories = BlogPost::distinct()->pluck('category');
        return view('admin.blog.edit', compact('post', 'categories'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blog_posts,slug,' . $post->id,
            'excerpt' => 'required|string|max:300',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date'
        ]);

        // Convertir tags de string a array
        if ($request->has('tags')) {
            $validated['tags'] = json_encode(
                array_map('trim', explode(',', $request->tags))
            );
        } else {
            $validated['tags'] = null;
        }

        // Manejar publicación
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = $post->published_at ?: Carbon::now();
        } elseif (!$validated['is_published']) {
            $validated['published_at'] = null;
        }

        // Manejar imagen destacada
        if ($request->hasFile('featured_image')) {
            // Eliminar imagen anterior si existe
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog', 'public');
            Log::info('Imagen destacada guardada en: ' . storage_path('app/public/' . $validated['featured_image']));
        }

        $post->update($validated);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo actualizado exitosamente.');
    }

    public function destroy(BlogPost $post)
    {
        // Eliminar imagen asociada
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Artículo eliminado exitosamente.');
    }
}