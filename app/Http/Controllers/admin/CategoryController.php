<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
                             ->with('parent')
                             ->orderBy('order')
                             ->orderBy('name')
                             ->paginate(20);
                             
        return view('admin.catalog.categories.index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')
                                   ->where('is_active', true)
                                   ->orderBy('name')
                                   ->get();
                                   
        return view('admin.catalog.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        // Generar slug si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Manejar checkbox
        $validated['is_active'] = $request->has('is_active');

        // Evitar que una categoría sea su propio padre
        if ($request->parent_id) {
            if ($request->parent_id == ($request->id ?? null)) {
                return back()->withInput()
                            ->with('error', 'Una categoría no puede ser su propio padre.');
            }
        }

        // Manejar la carga de imagen
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($validated);

        return redirect()->route('admin.catalog.categories.index')
                       ->with('success', 'Categoría creada exitosamente.');
    }

    public function show(Category $category)
    {
        $category->load(['products' => function($query) {
            $query->with(['brand'])->orderBy('name');
        }, 'children', 'parent']);
        
        return view('admin.catalog.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parentCategories = Category::whereNull('parent_id')
                                   ->where('id', '!=', $category->id)
                                   ->where('is_active', true)
                                   ->orderBy('name')
                                   ->get();
                                   
        return view('admin.catalog.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        // Manejar checkbox
        $validated['is_active'] = $request->has('is_active');

        // Evitar que una categoría sea su propio padre
        if ($request->parent_id == $category->id) {
            return back()->withInput()
                        ->with('error', 'Una categoría no puede ser su propio padre.');
        }

        // Evitar bucles de categorías padre
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);
            $currentParent = $parent;
            while ($currentParent) {
                if ($currentParent->id == $category->id) {
                    return back()->withInput()
                                ->with('error', 'No se puede crear una referencia circular de categorías.');
                }
                $currentParent = $currentParent->parent;
            }
        }

        // Manejar la carga de imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.catalog.categories.index')
                       ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function destroy(Category $category)
    {
        // Verificar si tiene productos asociados
        if ($category->products()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }

        // Verificar si tiene subcategorías
        if ($category->children()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la categoría porque tiene subcategorías.');
        }

        // Eliminar imagen asociada
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.catalog.categories.index')
                       ->with('success', 'Categoría eliminada exitosamente.');
    }
}