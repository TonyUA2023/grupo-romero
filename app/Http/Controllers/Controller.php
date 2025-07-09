<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // Compartir páginas activas con todas las vistas
        View::composer('*', function ($view) {
            $navigationPages = Page::where('status', true)
                                 ->orderBy('order')
                                 ->get();
            
            $view->with('navigationPages', $navigationPages);
        });
    }
}
