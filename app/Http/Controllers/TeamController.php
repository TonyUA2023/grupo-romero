<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::where('is_active', true)
                                ->orderBy('order')
                                ->get();

        return view('team.index', compact('teamMembers'));
    }
}