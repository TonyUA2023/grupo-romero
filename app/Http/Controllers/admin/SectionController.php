<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('page')->orderBy('order')->paginate(10);
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        $pages = Page::where('status', true)->orderBy('title')->get();
        $sectionTypes = [
            'hero' => 'Hero (Cabecera)',
            'features' => 'Características',
            'services' => 'Servicios',
            'testimonials' => 'Testimonios',
            'gallery' => 'Galería',
            'contact' => 'Contacto',
            'team' => 'Equipo',
            'cta' => 'Llamado a la Acción',
            'text_image' => 'Texto + Imagen',
            'custom' => 'Personalizado'
        ];
        $section = null;  // Aquí defines la variable para evitar el error
        return view('admin.sections.create', compact('pages', 'sectionTypes', 'section'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|string|max:50',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'data' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Manejar la carga de imágenes
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sections', 'public');
        }

        // Convertir datos adicionales a JSON
        if ($request->has('data')) {
            $validated['data'] = json_encode($request->data);
        }

        Section::create($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Sección creada exitosamente.');
    }

    public function show(Section $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    public function edit(Section $section)
    {
        $pages = Page::where('status', true)->orderBy('title')->get();
        $sectionTypes = [
            'hero' => 'Hero (Cabecera)',
            'features' => 'Características',
            'services' => 'Servicios',
            'testimonials' => 'Testimonios',
            'gallery' => 'Galería',
            'contact' => 'Contacto',
            'team' => 'Equipo',
            'cta' => 'Llamado a la Acción',
            'text_image' => 'Texto + Imagen',
            'custom' => 'Personalizado'
        ];
        
        return view('admin.sections.edit', compact('section', 'pages', 'sectionTypes'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|string|max:50',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'data' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Manejar la carga de imágenes
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($section->image) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('sections', 'public');
        }

        // Convertir datos adicionales a JSON
        if ($request->has('data')) {
            $validated['data'] = json_encode($request->data);
        }

        $section->update($validated);

        return redirect()->route('admin.sections.index')
            ->with('success', 'Sección actualizada exitosamente.');
    }

    public function destroy(Section $section)
    {
        // Eliminar imagen asociada
        if ($section->image) {
            Storage::disk('public')->delete($section->image);
        }

        $section->delete();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Sección eliminada exitosamente.');
    }
}