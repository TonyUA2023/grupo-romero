<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Page;
use App\Models\BlogPost;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'services' => Service::count(),
            'pages' => Page::count(),
            'posts' => BlogPost::count(),
            'team' => TeamMember::count()
        ];

        $recentPosts = BlogPost::latest()->take(5)->get();
        $recentServices = Service::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentServices'));
    }
}