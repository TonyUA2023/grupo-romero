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
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS SIN AUTENTICACIÓN
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('servicios')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('services.show');
});

Route::get('/galeria', [GalleryController::class, 'index'])->name('gallery.index');

Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});

Route::get('/testimonios', [TestimonialController::class, 'index'])->name('testimonials.index');

Route::get('/equipo', [TeamController::class, 'index'])->name('team.index');

Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');

Route::prefix('catalogo')->name('catalog.')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('index');
    Route::get('/vista-rapida/{id}', [CatalogController::class, 'quickView'])->name('quickview');
    Route::get('/buscar-sugerencias', [CatalogController::class, 'searchSuggestions'])->name('search.suggestions');
    Route::get('/comparar', [CatalogController::class, 'compare'])->name('compare');
    Route::get('/exportar', [CatalogController::class, 'export'])->name('export');
    Route::get('/{slug}', [CatalogController::class, 'show'])->name('show'); // debe ir al final dentro del grupo
});

// Rutas limpias para marcas y categorías (fuera del prefijo para URLs amigables)
Route::get('/marca/{slug}', [CatalogController::class, 'brand'])->name('catalog.brand');
Route::get('/categoria/{slug}', [CatalogController::class, 'category'])->name('catalog.category');

/*
|--------------------------------------------------------------------------
| RUTAS DE AUTENTICACIÓN Y PANEL USUARIO
|--------------------------------------------------------------------------
*/

// Incluye rutas Breeze o las tuyas personalizadas,
// si no usas Breeze elimina este require o reemplaza por tus rutas.
require __DIR__.'/auth.php';

// Rutas protegidas para usuarios autenticados y verificados
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| PANEL DE ADMINISTRACIÓN
|--------------------------------------------------------------------------
|
| Ajusta o crea un middleware 'admin' para restringir acceso a usuarios con rol admin/manager.
| El middleware debe verificar `auth` y también validar rol / permisos.
|
| Es recomendable usar middleware y gates con nombres concretos como 'auth', 'admin.auth', 'can:access-admin' para claridad.
|
*/

// Grupo principal admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Catálogo
    Route::prefix('catalog')->name('catalog.')->group(function () {
        Route::resource('products', ProductController::class)->names([
            'index' => 'products.index',
            'create' => 'products.create',
            'store' => 'products.store',
            'show' => 'products.show',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy'
        ]);
        Route::resource('categories', CategoryController::class)->names([
            'index' => 'categories.index',
            'create' => 'categories.create',
            'store' => 'categories.store',
            'show' => 'categories.show',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy'
        ]);
        Route::resource('brands', BrandController::class)->names([
            'index' => 'brands.index',
            'create' => 'brands.create',
            'store' => 'brands.store',
            'show' => 'brands.show',
            'edit' => 'brands.edit',
            'update' => 'brands.update',
            'destroy' => 'brands.destroy'
        ]);

        // Rutas adicionales masivas y multimedia
        Route::post('products/{product}/images', [ProductController::class, 'uploadImages'])->name('products.images.upload');
        Route::delete('products/images/{image}', [ProductController::class, 'deleteImage'])->name('products.images.delete');
        Route::post('products/{product}/features', [ProductController::class, 'addFeature'])->name('products.features.add');
        Route::delete('products/features/{feature}', [ProductController::class, 'deleteFeature'])->name('products.features.delete');
        Route::post('products/bulk-update', [ProductController::class, 'bulkUpdate'])->name('products.bulk.update');
        Route::post('products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulk.delete');
        Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
        Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
    });

    // Otras gestiones administrativas
    Route::resource('services', AdminServiceController::class)->names([
        'index' => 'services.index',
        'create' => 'services.create',
        'store' => 'services.store',
        'show' => 'services.show',
        'edit' => 'services.edit',
        'update' => 'services.update',
        'destroy' => 'services.destroy'
    ]);

    Route::resource('pages', AdminPageController::class)->names([
        'index' => 'pages.index',
        'create' => 'pages.create',
        'store' => 'pages.store',
        'show' => 'pages.show',
        'edit' => 'pages.edit',
        'update' => 'pages.update',
        'destroy' => 'pages.destroy'
    ]);

    Route::resource('sections', SectionController::class)->names([
        'index' => 'sections.index',
        'create' => 'sections.create',
        'store' => 'sections.store',
        'show' => 'sections.show',
        'edit' => 'sections.edit',
        'update' => 'sections.update',
        'destroy' => 'sections.destroy'
    ]);

    Route::resource('team', TeamMemberController::class)->names([
        'index' => 'team.index',
        'create' => 'team.create',
        'store' => 'team.store',
        'show' => 'team.show',
        'edit' => 'team.edit',
        'update' => 'team.update',
        'destroy' => 'team.destroy'
    ])->parameters(['team' => 'teamMember']);

    Route::resource('testimonials', AdminTestimonialController::class)->names([
        'index' => 'testimonials.index',
        'create' => 'testimonials.create',
        'store' => 'testimonials.store',
        'show' => 'testimonials.show',
        'edit' => 'testimonials.edit',
        'update' => 'testimonials.update',
        'destroy' => 'testimonials.destroy'
    ]);

    Route::resource('blog', BlogPostController::class)->names([
        'index' => 'blog.index',
        'create' => 'blog.create',
        'store' => 'blog.store',
        'show' => 'blog.show',
        'edit' => 'blog.edit',
        'update' => 'blog.update',
        'destroy' => 'blog.destroy'
    ])->parameters(['blog' => 'post']); 

    Route::resource('gallery', GalleryItemController::class)->names([
        'index' => 'gallery.index',
        'create' => 'gallery.create',
        'store' => 'gallery.store',
        'show' => 'gallery.show',
        'edit' => 'gallery.edit',
        'update' => 'gallery.update',
        'destroy' => 'gallery.destroy'
    ])->parameters(['gallery' => 'galleryItem']); 

    // Configuración del sitio
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Reportes y analytics - grupo de rutas ordenado
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/products', [AdminController::class, 'productsReport'])->name('products');
        Route::get('/sales', [AdminController::class, 'salesReport'])->name('sales');
        Route::get('/views', [AdminController::class, 'viewsReport'])->name('views');
    });
});

/*
|--------------------------------------------------------------------------
| RUTAS DINÁMICAS DE PÁGINAS (SIEMPRE AL FINAL)
|--------------------------------------------------------------------------
*/

Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');