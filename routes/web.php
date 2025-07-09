<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas Públicas (sin autenticación)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de Servicios
Route::prefix('servicios')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('services.show');
});

// Galería
Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery.index');

// Blog
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

// Testimonios
Route::get('/testimonios', [TestimonialController::class, 'index'])->name('testimonials.index');

// Equipo
Route::get('/equipo', [TeamController::class, 'index'])->name('team.index');

// Contacto
Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');

// Incluir rutas de autenticación de Breeze
require __DIR__.'/auth.php';

// Rutas de Autenticación (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Panel de Administración (requiere autenticación y rol de admin)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Gestión de Servicios
    Route::resource('services', AdminServiceController::class)->names([
        'index' => 'services.index',
        'create' => 'services.create',
        'store' => 'services.store',
        'show' => 'services.show',
        'edit' => 'services.edit',
        'update' => 'services.update',
        'destroy' => 'services.destroy'
    ]);
    
    // Gestión de Páginas
    Route::resource('pages', AdminPageController::class)->names([
        'index' => 'pages.index',
        'create' => 'pages.create',
        'store' => 'pages.store',
        'show' => 'pages.show',
        'edit' => 'pages.edit',
        'update' => 'pages.update',
        'destroy' => 'pages.destroy'
    ]);
    
    // Gestión de Secciones
    Route::resource('sections', SectionController::class)->names([
        'index' => 'sections.index',
        'create' => 'sections.create',
        'store' => 'sections.store',
        'show' => 'sections.show',
        'edit' => 'sections.edit',
        'update' => 'sections.update',
        'destroy' => 'sections.destroy'
    ]);
    
    // Gestión de Equipo
    Route::resource('team', TeamMemberController::class)->names([
        'index' => 'team.index',
        'create' => 'team.create',
        'store' => 'team.store',
        'show' => 'team.show',
        'edit' => 'team.edit',
        'update' => 'team.update',
        'destroy' => 'team.destroy'
    ]);
    
    // Gestión de Testimonios
    Route::resource('testimonials', AdminTestimonialController::class)->names([
        'index' => 'testimonials.index',
        'create' => 'testimonials.create',
        'store' => 'testimonials.store',
        'show' => 'testimonials.show',
        'edit' => 'testimonials.edit',
        'update' => 'testimonials.update',
        'destroy' => 'testimonials.destroy'
    ]);
    
    // Gestión de Blog
    Route::resource('blog', BlogPostController::class)->names([
        'index' => 'blog.index',
        'create' => 'blog.create',
        'store' => 'blog.store',
        'show' => 'blog.show',
        'edit' => 'blog.edit',
        'update' => 'blog.update',
        'destroy' => 'blog.destroy'
    ]);
    
    // Gestión de Galería
    Route::resource('gallery', GalleryItemController::class)->names([
        'index' => 'gallery.index',
        'create' => 'gallery.create',
        'store' => 'gallery.store',
        'show' => 'gallery.show',
        'edit' => 'gallery.edit',
        'update' => 'gallery.update',
        'destroy' => 'gallery.destroy'
    ]);
    
    // Configuración
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Rutas de Páginas Dinámicas (DEBE IR AL FINAL)
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');