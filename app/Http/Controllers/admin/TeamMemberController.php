<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('order')->paginate(10);
        return view('admin.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'specialties' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'social_links' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Manejar la carga de imágenes
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        // Convertir redes sociales a JSON
        if ($request->has('social_links')) {
            $socialLinks = [];
            foreach ($request->social_links as $link) {
                if (!empty($link['platform']) && !empty($link['url'])) {
                    $socialLinks[$link['platform']] = $link['url'];
                }
            }
            $validated['social_links'] = json_encode($socialLinks);
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Miembro del equipo creado exitosamente.');
    }

    public function show(TeamMember $teamMember)
    {
        return view('admin.team.show', compact('teamMember'));
    }

    public function edit(TeamMember $teamMember)
    {
        return view('admin.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'specialties' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'social_links' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        // Manejar la carga de imágenes
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($teamMember->image) {
                Storage::disk('public')->delete($teamMember->image);
            }
            $validated['image'] = $request->file('image')->store('team', 'public');
        }

        // Convertir redes sociales a JSON
        if ($request->has('social_links')) {
            $socialLinks = [];
            foreach ($request->social_links as $link) {
                if (!empty($link['platform']) && !empty($link['url'])) {
                    $socialLinks[$link['platform']] = $link['url'];
                }
            }
            $validated['social_links'] = json_encode($socialLinks);
        }

        $teamMember->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Miembro del equipo actualizado exitosamente.');
    }

    public function destroy(TeamMember $teamMember)
    {
        // Eliminar imagen asociada
        if ($teamMember->image) {
            Storage::disk('public')->delete($teamMember->image);
        }

        $teamMember->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Miembro del equipo eliminado exitosamente.');
    }
}