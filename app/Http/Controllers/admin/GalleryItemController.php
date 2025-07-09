<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    public function index()
    {
        $galleryItems = GalleryItem::orderBy('order')->paginate(12);
        return view('admin.gallery.index', compact('galleryItems'));
    }

    public function create()
    {
        $categories = GalleryItem::distinct()->pluck('category');
        return view('admin.gallery.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|max:2048',
            'category' => 'required|string|max:100',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Manejar la carga de imágenes
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Ítem de galería creado exitosamente.');
    }

    public function show(GalleryItem $galleryItem)
    {
        return view('admin.gallery.show', compact('galleryItem'));
    }

    public function edit(GalleryItem $galleryItem)
    {
        $categories = GalleryItem::distinct()->pluck('category');
        return view('admin.gallery.edit', compact('galleryItem', 'categories'));
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|string|max:100',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Manejar la carga de imágenes
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($galleryItem->image) {
                Storage::disk('public')->delete($galleryItem->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $galleryItem->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Ítem de galería actualizado exitosamente.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        // Eliminar imagen asociada
        if ($galleryItem->image) {
            Storage::disk('public')->delete($galleryItem->image);
        }

        $galleryItem->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Ítem de galería eliminado exitosamente.');
    }
}