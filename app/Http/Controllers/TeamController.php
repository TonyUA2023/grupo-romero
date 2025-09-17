<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\Section;

class TeamController extends Controller
{
    public function index()
    {
        // Obtener la sección hero del equipo si existe
        $heroSection = Section::whereHas('page', function($q) {
            $q->where('slug', 'equipo');
        })
        ->where('type', 'hero')
        ->where('is_active', true)
        ->first();

        // Obtener todos los miembros activos del equipo
        $teamMembers = TeamMember::where('is_active', true)
                                ->orderBy('order')
                                ->get();

        // Agrupar por categorías si tienen especialidades
        $leadership = $teamMembers->filter(function($member) {
            return str_contains(strtolower($member->position), 'director') || 
                   str_contains(strtolower($member->position), 'gerente') ||
                   str_contains(strtolower($member->position), 'jef');
        });

        $doctors = $teamMembers->filter(function($member) {
            return str_contains(strtolower($member->position), 'doctor') || 
                   str_contains(strtolower($member->position), 'dr.') ||
                   str_contains(strtolower($member->position), 'oftalmólog') ||
                   str_contains(strtolower($member->position), 'optometr');
        });

        $staff = $teamMembers->filter(function($member) use ($leadership, $doctors) {
            return !$leadership->contains($member) && !$doctors->contains($member);
        });

        return view('team.index', compact(
            'teamMembers',
            'leadership',
            'doctors',
            'staff',
            'heroSection'
        ));
    }
}