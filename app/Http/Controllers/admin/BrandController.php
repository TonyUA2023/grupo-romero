<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('products')
                      ->orderBy('order')
                      ->orderBy('name')
                      ->paginate(20);
                      
        return view('admin.catalog.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.catalog.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:brands,slug',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        // Generar slug si no se proporciona
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Manejar checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Manejar la carga del logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('brands', 'public');
        }

        Brand::create($validated);

        return redirect()->route('admin.catalog.brands.index')
                       ->with('success', 'Marca creada exitosamente.');
    }

    public function show(Brand $brand)
    {
        $brand->load(['products' => function($query) {
            $query->with(['category'])->orderBy('name');
        }]);
        
        return view('admin.catalog.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.catalog.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug,' . $brand->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        // Manejar checkboxes
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        // Manejar la carga del logo
        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $validated['logo'] = $request->file('logo')->store('brands', 'public');
        }

        $brand->update($validated);

        return redirect()->route('admin.catalog.brands.index')
                       ->with('success', 'Marca actualizada exitosamente.');
    }

    public function destroy(Brand $brand)
    {
        // Verificar si tiene productos asociados
        if ($brand->products()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la marca porque tiene productos asociados.');
        }

        // Eliminar logo asociado
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('admin.catalog.brands.index')
                       ->with('success', 'Marca eliminada exitosamente.');
    }
}