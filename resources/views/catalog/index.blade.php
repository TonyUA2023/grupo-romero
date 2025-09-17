@extends('layouts.app')

@section('title', 'Catálogo - ' . config('app.name'))
@section('description', 'Explora nuestra exclusiva colección de lentes de las mejores marcas del mundo. Encuentra el estilo perfecto para ti.')

@section('header-transparent', true)

@section('content')

<!-- ===== PRELOADER ===== -->
<div id="preloader" class="fixed inset-0 bg-black z-[9999] flex items-center justify-center transition-opacity duration-500">
    <div class="relative">
        <div class="w-16 h-16 border-2 border-white/20 rounded-full animate-spin"></div>
        <div class="absolute inset-0 w-16 h-16 border-2 border-transparent border-t-white rounded-full animate-spin"></div>
    </div>
</div>

<style>
    /* ===== VARIABLES Y CONFIGURACIÓN ===== */
    :root {
        --primary-black: #0a0a0a;
        --soft-black: #1a1a1a;
        --dark-gray: #2a2a2a;
        --medium-gray: #4a4a4a;
        --light-gray: #6a6a6a;
        --soft-gray: #e5e5e5;
        --off-white: #f8f8f8;
        --pure-white: #ffffff;
        --accent-blue: #0066ff;
        --accent-hover: #0052cc;
        --transition-smooth: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== RESET Y ESTILOS BASE ===== */
    * {
        scroll-behavior: smooth;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* ===== TIPOGRAFÍA ===== */
    .heading-display {
        font-weight: 100;
        letter-spacing: -0.02em;
        line-height: 0.9;
    }

    .heading-primary {
        font-weight: 200;
        letter-spacing: -0.01em;
        line-height: 1.1;
    }

    .text-elegant {
        font-weight: 300;
        letter-spacing: 0.01em;
        line-height: 1.7;
    }

    /* ===== ANIMACIONES ===== */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s var(--transition-smooth) forwards;
        opacity: 0;
    }

    /* ===== CONTAINER ===== */
    .container-custom {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 40px;
    }

    @media (max-width: 768px) {
        .container-custom {
            padding: 0 20px;
        }
    }

    /* ===== FILTROS SIDEBAR ===== */
    .filter-section {
        border-bottom: 1px solid var(--soft-gray);
        padding: 24px 0;
    }

    .filter-section:last-child {
        border-bottom: none;
    }

    .filter-title {
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .filter-checkbox {
        width: 18px;
        height: 18px;
        border: 1px solid var(--medium-gray);
        margin-right: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-checkbox:checked {
        background: var(--primary-black);
        border-color: var(--primary-black);
    }

    /* ===== APPLY FILTERS BUTTON ===== */
    .apply-filters-container {
        position: sticky;
        bottom: 0;
        background: white;
        padding: 20px 0;
        border-top: 1px solid var(--soft-gray);
        margin-top: 20px;
    }

    .apply-filters-btn {
        width: 100%;
        background: var(--primary-black);
        color: white;
        padding: 12px 24px;
        font-size: 14px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .apply-filters-btn:hover {
        background: var(--soft-black);
    }

    .apply-filters-btn:disabled {
        background: var(--light-gray);
        cursor: not-allowed;
    }

    .clear-filters-btn {
        width: 100%;
        background: transparent;
        color: var(--medium-gray);
        padding: 8px 24px;
        font-size: 13px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 8px;
    }

    .clear-filters-btn:hover {
        color: var(--primary-black);
    }

    /* ===== PRODUCT GRID ===== */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 40px;
    }

    @media (max-width: 768px) {
        .product-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }

    .product-card {
        position: relative;
        overflow: hidden;
        transition: all 0.4s var(--transition-smooth);
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-image-container {
        position: relative;
        aspect-ratio: 3/2;
        overflow: hidden;
        background: var(--off-white);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s var(--transition-smooth);
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s var(--transition-smooth);
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .product-info {
        padding: 20px 0;
    }

    .product-brand {
        font-size: 12px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--medium-gray);
        margin-bottom: 4px;
    }

    .product-name {
        font-size: 16px;
        font-weight: 300;
        margin-bottom: 8px;
        transition: color 0.3s ease;
    }

    .product-card:hover .product-name {
        color: var(--accent-blue);
    }

    .product-price {
        font-size: 18px;
        font-weight: 300;
    }

    .price-sale {
        color: var(--accent-blue);
        margin-right: 8px;
    }

    .price-original {
        color: var(--medium-gray);
        text-decoration: line-through;
    }

    /* ===== BADGES ===== */
    .badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: var(--primary-black);
        color: white;
        padding: 6px 16px;
        font-size: 11px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        z-index: 1;
    }

    .badge-sale {
        background: var(--accent-blue);
    }

    /* ===== FILTER TAGS ===== */
    .filter-tag {
        display: inline-flex;
        align-items: center;
        background: var(--off-white);
        padding: 8px 16px;
        margin: 4px;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .filter-tag:hover {
        background: var(--soft-gray);
    }

    .filter-tag-close {
        margin-left: 8px;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

    .filter-tag-close:hover {
        opacity: 1;
    }

    /* ===== MOBILE FILTER TOGGLE ===== */
    .mobile-filter-toggle {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background: var(--primary-black);
        color: white;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        z-index: 100;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .mobile-filter-toggle:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
    }

    /* ===== ACTIVE FILTERS DISPLAY ===== */
    .active-filters-container {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
    }

    .filter-badge {
        display: inline-flex;
        align-items: center;
        background: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        margin: 4px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }

    .filter-badge:hover {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    }

    .filter-badge a {
        margin-left: 8px;
        color: #999;
        transition: color 0.2s ease;
    }

    .filter-badge a:hover {
        color: #333;
    }

    @media (max-width: 1024px) {
        .mobile-filter-toggle {
            display: flex;
        }

        .filters-sidebar {
            position: fixed;
            top: 0;
            left: -100%;
            width: 320px;
            height: 100vh;
            background: white;
            z-index: 1000;
            overflow-y: auto;
            transition: left 0.4s var(--transition-smooth);
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.1);
        }

        .filters-sidebar.active {
            left: 0;
        }

        .filters-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .filters-overlay.active {
            display: block;
        }
    }

    /* ===== PAGINATION ===== */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        margin-top: 60px;
    }

    .pagination a,
    .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        font-size: 14px;
        font-weight: 300;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background: var(--off-white);
    }

    .pagination .active {
        background: var(--primary-black);
        color: white;
    }

    /* ===== LOADING STATE ===== */
    .loading-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .loading-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* ===== QUICK VIEW BUTTON ===== */
    .quick-view-btn {
        background: white;
        color: var(--primary-black);
        padding: 12px 32px;
        font-size: 13px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border: 1px solid white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .quick-view-btn:hover {
        background: transparent;
        color: white;
    }

    /* ===== REVEAL ON SCROLL ===== */
    .reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s var(--transition-smooth);
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* ===== PRICE SLIDER ===== */
    .price-slider {
        position: relative;
        width: 100%;
        height: 4px;
        background: var(--soft-gray);
        margin: 20px 0;
        border-radius: 2px;
    }

    .price-slider-fill {
        position: absolute;
        height: 100%;
        background: var(--primary-black);
        border-radius: 2px;
    }

    .price-slider-handle {
        position: absolute;
        width: 16px;
        height: 16px;
        background: var(--primary-black);
        border: 2px solid white;
        border-radius: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<!-- ===== HERO SECTION ===== -->
<section class="relative h-[60vh] flex items-center overflow-hidden bg-black">
    <div class="absolute inset-0 z-0">
        @if($heroSection && $heroSection->image)
            <img src="{{ asset('storage/' . $heroSection->image) }}" 
                 alt="Catálogo" 
                 class="w-full h-full object-cover opacity-30">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-black"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/50"></div>
    </div>

    <div class="relative z-10 container-custom pt-20">
        <div class="max-w-3xl">
            <h1 class="heading-display text-5xl md:text-7xl lg:text-8xl text-white mb-6 animate-fade-in-up">
                Catálogo
            </h1>
            <p class="text-elegant text-lg md:text-xl text-white/70 max-w-xl animate-fade-in-up" style="animation-delay: 0.2s;">
                Explora nuestra exclusiva colección de lentes de las mejores marcas del mundo
            </p>
        </div>
    </div>
</section>

<!-- ===== MAIN CONTENT ===== -->
<section class="py-20 bg-white">
    <div class="container-custom">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-8">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li><a href="/" class="hover:text-black transition-colors">Inicio</a></li>
                <li>/</li>
                <li class="text-black">Catálogo</li>
                @if($activeCategory)
                    <li>/</li>
                    <li class="text-black">{{ $activeCategory->name }}</li>
                @endif
                @if($activeBrand)
                    <li>/</li>
                    <li class="text-black">{{ $activeBrand->name }}</li>
                @endif
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            <!-- Filters Sidebar -->
            <aside class="lg:col-span-1">
                <div class="filters-sidebar" id="filtersSidebar">
                    <!-- Close button for mobile -->
                    <div class="lg:hidden flex justify-between items-center p-6 border-b">
                        <h3 class="text-lg font-light">Filtros</h3>
                        <button onclick="toggleFilters()" class="text-2xl">&times;</button>
                    </div>

                    <div class="p-6 lg:p-0">
                        <!-- Active Filters -->
                        @if(request()->has('categoria') || request()->has('marca') || request()->has('buscar') || request()->has('genero') || request()->has('tipo'))
                        <div class="filter-section">
                            <h3 class="filter-title">Filtros activos</h3>
                            <div class="flex flex-wrap -m-1">
                                @if(request()->has('buscar'))
                                    <div class="filter-tag">
                                        <span>{{ request('buscar') }}</span>
                                        <a href="{{ route('catalog.index', request()->except('buscar')) }}" class="filter-tag-close">×</a>
                                    </div>
                                @endif
                                @if($activeCategory)
                                    <div class="filter-tag">
                                        <span>{{ $activeCategory->name }}</span>
                                        <a href="{{ route('catalog.index', request()->except('categoria')) }}" class="filter-tag-close">×</a>
                                    </div>
                                @endif
                                @if($activeBrand)
                                    <div class="filter-tag">
                                        <span>{{ $activeBrand->name }}</span>
                                        <a href="{{ route('catalog.index', request()->except('marca')) }}" class="filter-tag-close">×</a>
                                    </div>
                                @endif
                                @if(request()->has('genero'))
                                    <div class="filter-tag">
                                        <span>{{ ucfirst(request('genero')) }}</span>
                                        <a href="{{ route('catalog.index', request()->except('genero')) }}" class="filter-tag-close">×</a>
                                    </div>
                                @endif
                                @if(request()->has('tipo'))
                                    <div class="filter-tag">
                                        <span>{{ ucfirst(request('tipo')) }}</span>
                                        <a href="{{ route('catalog.index', request()->except('tipo')) }}" class="filter-tag-close">×</a>
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('catalog.index') }}" class="text-sm text-gray-500 hover:text-black mt-4 inline-block">Limpiar todos</a>
                        </div>
                        @endif

                        <!-- Search -->
                        <div class="filter-section">
                            <form action="{{ route('catalog.index') }}" method="GET">
                                @foreach(request()->except(['buscar']) as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                <div class="relative">
                                    <input type="text" 
                                           name="buscar" 
                                           value="{{ request('buscar') }}"
                                           placeholder="Buscar productos..." 
                                           class="w-full px-4 py-3 pr-10 border border-gray-200 focus:border-black transition-colors text-sm">
                                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Categories -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <span>Categorías</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </h3>
                            <div class="space-y-3">
                                @foreach($categories as $category)
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                           class="filter-checkbox"
                                           data-filter-type="categoria"
                                           data-filter-value="{{ $category->slug }}"
                                           {{ $activeCategory && $activeCategory->id == $category->id ? 'checked' : '' }}>
                                    <span class="text-sm group-hover:text-black transition-colors">
                                        {{ $category->name }} 
                                        <span class="text-gray-400">({{ $category->products_count }})</span>
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Brands -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <span>Marcas</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </h3>
                            <div class="space-y-3 max-h-64 overflow-y-auto">
                                @foreach($brands as $brand)
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                           class="filter-checkbox"
                                           data-filter-type="marca"
                                           data-filter-value="{{ $brand->slug }}"
                                           {{ $activeBrand && $activeBrand->id == $brand->id ? 'checked' : '' }}>
                                    <span class="text-sm group-hover:text-black transition-colors">
                                        {{ $brand->name }} 
                                        <span class="text-gray-400">({{ $brand->products_count }})</span>
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <span>Género</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </h3>
                            <div class="space-y-3">
                                @foreach(['unisex' => 'Unisex', 'hombre' => 'Hombre', 'mujer' => 'Mujer', 'niño' => 'Niño'] as $value => $label)
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                           class="filter-checkbox"
                                           data-filter-type="genero"
                                           data-filter-value="{{ $value }}"
                                           {{ request('genero') == $value ? 'checked' : '' }}>
                                    <span class="text-sm group-hover:text-black transition-colors">{{ $label }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <span>Tipo</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </h3>
                            <div class="space-y-3">
                                @foreach(['sol' => 'Lentes de Sol', 'oftalmico' => 'Lentes Oftálmicos', 'ambos' => 'Ambos'] as $value => $label)
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                           class="filter-checkbox"
                                           data-filter-type="tipo"
                                           data-filter-value="{{ $value }}"
                                           {{ request('tipo') == $value ? 'checked' : '' }}>
                                    <span class="text-sm group-hover:text-black transition-colors">{{ $label }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Frame Material -->
                        @if($frameMaterials && $frameMaterials->count() > 0)
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <span>Material</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </h3>
                            <div class="space-y-3">
                                @foreach($frameMaterials as $material)
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                           class="filter-checkbox"
                                           data-filter-type="frame_material"
                                           data-filter-value="{{ $material }}"
                                           {{ request('frame_material') == $material ? 'checked' : '' }}>
                                    <span class="text-sm group-hover:text-black transition-colors">{{ ucfirst($material) }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Special Filters -->
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <span>Destacados</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </h3>
                            <div class="space-y-3">
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                           class="filter-checkbox"
                                           data-filter-type="on_sale"
                                           data-filter-value="1"
                                           {{ request('on_sale') ? 'checked' : '' }}>
                                    <span class="text-sm group-hover:text-black transition-colors">En Oferta</span>
                                </label>
                                <label class="flex items-center cursor-pointer group">
                                    <input type="checkbox" 
                                           class="filter-checkbox"
                                           data-filter-type="is_new"
                                           data-filter-value="1"
                                           {{ request('is_new') ? 'checked' : '' }}>
                                    <span class="text-sm group-hover:text-black transition-colors">Nuevos</span>
                                </label>
                            </div>
                        </div>

                        <!-- Price Range -->
                        @if($priceRange)
                        <div class="filter-section">
                            <h3 class="filter-title">
                                <span>Precio</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </h3>
                            <form id="priceForm" action="{{ route('catalog.index') }}" method="GET">
                                @foreach(request()->except(['precio_min', 'precio_max']) as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                
                                <div class="flex items-center space-x-4 mb-4">
                                    <input type="number" 
                                           id="precio_min_input"
                                           value="{{ request('precio_min', $priceRange->min_price) }}"
                                           min="{{ $priceRange->min_price }}"
                                           max="{{ $priceRange->max_price }}"
                                           class="w-full px-3 py-2 border border-gray-200 text-sm">
                                    <span>-</span>
                                    <input type="number" 
                                           id="precio_max_input"
                                           value="{{ request('precio_max', $priceRange->max_price) }}"
                                           min="{{ $priceRange->min_price }}"
                                           max="{{ $priceRange->max_price }}"
                                           class="w-full px-3 py-2 border border-gray-200 text-sm">
                                </div>
                                <div class="text-xs text-gray-500 mb-4">
                                    Rango: S/ {{ number_format($priceRange->min_price, 2) }} - S/ {{ number_format($priceRange->max_price, 2) }}
                                </div>
                                <button type="submit" class="w-full bg-black text-white py-2 text-sm hover:bg-gray-800 transition-colors">
                                    Aplicar
                                </button>
                            </form>
                        </div>
                        @endif

                        <!-- Apply Filters Button Container -->
                        <div class="apply-filters-container">
                            <div class="text-center text-sm text-gray-600 mb-2" id="filterCount">
                                <!-- Filter count will be displayed here -->
                            </div>
                            <button id="applyFiltersBtn" class="apply-filters-btn">
                                Aplicar Filtros
                            </button>
                            <button id="clearFiltersBtn" class="clear-filters-btn">
                                Limpiar filtros
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filters overlay for mobile -->
                <div class="filters-overlay" id="filtersOverlay" onclick="toggleFilters()"></div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <!-- Active Filters Display -->
                @if(request()->has('categoria') || request()->has('marca') || request()->has('genero') || request()->has('tipo') || request()->has('frame_material') || request()->has('on_sale') || request()->has('is_new'))
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Filtros activos:</h4>
                        <a href="{{ route('catalog.index', request()->only('buscar', 'ordenar')) }}" 
                           class="text-sm text-gray-500 hover:text-black transition-colors">
                            <i class="fas fa-times mr-1"></i>Limpiar todos
                        </a>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if($activeCategory)
                            <span class="inline-flex items-center bg-white px-3 py-1 rounded-full text-sm">
                                {{ $activeCategory->name }}
                                <a href="{{ route('catalog.index', request()->except('categoria')) }}" 
                                   class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        @if($activeBrand)
                            <span class="inline-flex items-center bg-white px-3 py-1 rounded-full text-sm">
                                {{ $activeBrand->name }}
                                <a href="{{ route('catalog.index', request()->except('marca')) }}" 
                                   class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        @if(request()->has('genero'))
                            <span class="inline-flex items-center bg-white px-3 py-1 rounded-full text-sm">
                                {{ ucfirst(request('genero')) }}
                                <a href="{{ route('catalog.index', request()->except('genero')) }}" 
                                   class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        @if(request()->has('tipo'))
                            <span class="inline-flex items-center bg-white px-3 py-1 rounded-full text-sm">
                                {{ ucfirst(request('tipo')) }}
                                <a href="{{ route('catalog.index', request()->except('tipo')) }}" 
                                   class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        @if(request()->has('frame_material'))
                            <span class="inline-flex items-center bg-white px-3 py-1 rounded-full text-sm">
                                {{ ucfirst(request('frame_material')) }}
                                <a href="{{ route('catalog.index', request()->except('frame_material')) }}" 
                                   class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        @if(request()->has('on_sale'))
                            <span class="inline-flex items-center bg-white px-3 py-1 rounded-full text-sm">
                                En Oferta
                                <a href="{{ route('catalog.index', request()->except('on_sale')) }}" 
                                   class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        @if(request()->has('is_new'))
                            <span class="inline-flex items-center bg-white px-3 py-1 rounded-full text-sm">
                                Nuevos
                                <a href="{{ route('catalog.index', request()->except('is_new')) }}" 
                                   class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Sort and Results -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">
                            Mostrando <strong>{{ $products->count() }}</strong> de <strong>{{ $filteredCount }}</strong> productos
                        </p>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <label class="text-sm text-gray-600">Ordenar por:</label>
                        <select id="sortSelect" class="px-4 py-2 border border-gray-200 text-sm focus:border-black transition-colors">
                            <option value="relevancia" {{ request('ordenar', 'relevancia') == 'relevancia' ? 'selected' : '' }}>
                                Relevancia
                            </option>
                            <option value="nuevo" {{ request('ordenar') == 'nuevo' ? 'selected' : '' }}>
                                Más recientes
                            </option>
                            <option value="precio_asc" {{ request('ordenar') == 'precio_asc' ? 'selected' : '' }}>
                                Precio: Menor a Mayor
                            </option>
                            <option value="precio_desc" {{ request('ordenar') == 'precio_desc' ? 'selected' : '' }}>
                                Precio: Mayor a Menor
                            </option>
                            <option value="nombre_asc" {{ request('ordenar') == 'nombre_asc' ? 'selected' : '' }}>
                                Nombre: A-Z
                            </option>
                            <option value="descuento" {{ request('ordenar') == 'descuento' ? 'selected' : '' }}>
                                Mayor descuento
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="relative">
                    <div class="loading-overlay" id="loadingOverlay">
                        <div class="w-12 h-12 border-2 border-gray-300 border-t-black rounded-full animate-spin"></div>
                    </div>

                    @if($products->count() > 0)
                        <div class="product-grid">
                            @foreach($products as $product)
                            <article class="product-card reveal">
                                <!-- Badges -->
                                @if($product->is_new)
                                    <span class="badge">Nuevo</span>
                                @elseif($product->isOnSale)
                                    <span class="badge badge-sale">-{{ $product->discount_percentage }}%</span>
                                @endif

                                <!-- Image -->
                                <div class="product-image-container">
                                    <a href="{{ route('catalog.show', $product->slug) }}" class="block">
                                        <img src="{{ $product->main_image ? asset('storage/' . $product->main_image) : 'https://via.placeholder.com/400x300' }}" 
                                             alt="{{ $product->name }}"
                                             class="product-image"
                                             loading="lazy">
                                    </a>
                                    
                                    <!-- Overlay with quick actions -->
                                    <div class="product-overlay">
                                        <button onclick="quickView(event, {{ $product->id }})" class="quick-view-btn">
                                            Vista rápida
                                        </button>
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="product-info">
                                    <p class="product-brand">{{ $product->brand->name }}</p>
                                    <h3 class="product-name">
                                        <a href="{{ route('catalog.show', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="product-price">
                                        @if($product->sale_price)
                                            <span class="price-sale">S/ {{ number_format($product->sale_price, 2) }}</span>
                                            <span class="price-original">S/ {{ number_format($product->price, 2) }}</span>
                                        @else
                                            <span>S/ {{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($products->hasPages())
                        <div class="pagination">
                            {{ $products->links() }}
                        </div>
                        @endif
                    @else
                        <div class="text-center py-20">
                            <i class="fas fa-search text-6xl text-gray-200 mb-6"></i>
                            <h3 class="text-2xl font-light text-gray-600 mb-4">No se encontraron productos</h3>
                            <p class="text-gray-500 mb-8">Intenta ajustar los filtros o realizar otra búsqueda</p>
                            <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-black border-b border-black pb-1 hover:pb-2 transition-all">
                                Ver todos los productos
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile Filter Toggle -->
<button class="mobile-filter-toggle" onclick="toggleFilters()">
    <i class="fas fa-filter"></i>
    @php
        $activeFiltersCount = 0;
        if($activeCategory) $activeFiltersCount++;
        if($activeBrand) $activeFiltersCount++;
        if(request()->has('genero')) $activeFiltersCount++;
        if(request()->has('tipo')) $activeFiltersCount++;
        if(request()->has('frame_material')) $activeFiltersCount++;
        if(request()->has('on_sale')) $activeFiltersCount++;
        if(request()->has('is_new')) $activeFiltersCount++;
    @endphp
    @if($activeFiltersCount > 0)
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
            {{ $activeFiltersCount }}
        </span>
    @endif
</button>

<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 invisible transition-all duration-300">
    <div class="bg-white max-w-4xl w-full max-h-[90vh] overflow-auto relative">
        <button onclick="closeQuickView()" class="absolute top-4 right-4 text-2xl hover:text-gray-600 transition-colors">
            &times;
        </button>
        <div id="quickViewContent" class="p-8">
            <!-- Content will be loaded here -->
        </div>
    </div>
</div>

<script>
// Preloader
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        setTimeout(() => {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
                document.body.classList.add('loaded');
            }, 500);
        }, 500);
    }
});

// Store selected filters
let selectedFilters = {};

// Initialize selected filters from URL
function initializeFilters() {
    const urlParams = new URLSearchParams(window.location.search);
    
    // Initialize selectedFilters from current URL
    urlParams.forEach((value, key) => {
        if (key !== 'page' && key !== 'buscar' && key !== 'ordenar' && key !== 'precio_min' && key !== 'precio_max') {
            selectedFilters[key] = value;
        }
    });

    // Update checkbox states
    document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
        const filterType = checkbox.dataset.filterType;
        const filterValue = checkbox.dataset.filterValue;
        
        if (selectedFilters[filterType] === filterValue) {
            checkbox.checked = true;
        } else {
            checkbox.checked = false;
        }
    });
}

// Function to build URL with selected filters
function buildFilterUrl(additionalFilters = {}) {
    const currentParams = new URLSearchParams(window.location.search);
    const filters = { ...selectedFilters, ...additionalFilters };
    
    // Keep search and sort parameters
    const searchParam = currentParams.get('buscar');
    const sortParam = currentParams.get('ordenar');
    
    // Clear all parameters
    const newParams = new URLSearchParams();
    
    // Re-add search and sort if they exist
    if (searchParam) newParams.set('buscar', searchParam);
    if (sortParam) newParams.set('ordenar', sortParam);
    
    // Apply selected filters
    Object.keys(filters).forEach(key => {
        if (filters[key] !== null && filters[key] !== '') {
            newParams.set(key, filters[key]);
        }
    });
    
    // Reset to page 1 when filters change
    if (Object.keys(additionalFilters).length > 0) {
        newParams.set('page', 1);
    }
    
    return '{{ route("catalog.index") }}?' + newParams.toString();
}

// Handle filter checkboxes - allows multiple filter types but one value per type
document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const filterType = this.dataset.filterType;
        const filterValue = this.dataset.filterValue;
        
        if (this.checked) {
            // Uncheck other checkboxes of the same type
            document.querySelectorAll(`.filter-checkbox[data-filter-type="${filterType}"]`).forEach(cb => {
                if (cb !== this) cb.checked = false;
            });
            selectedFilters[filterType] = filterValue;
        } else {
            delete selectedFilters[filterType];
        }
        
        // Enable/disable apply button based on changes
        updateApplyButton();
    });
});

// Update apply button state
function updateApplyButton() {
    const applyBtn = document.getElementById('applyFiltersBtn');
    const filterCount = document.getElementById('filterCount');
    const hasChanges = checkForFilterChanges();
    
    // Count selected filters
    const selectedCount = Object.keys(selectedFilters).length;
    
    // Update filter count display
    if (selectedCount > 0) {
        filterCount.innerHTML = `<i class="fas fa-filter mr-1"></i>${selectedCount} filtro${selectedCount > 1 ? 's' : ''} seleccionado${selectedCount > 1 ? 's' : ''}`;
    } else {
        filterCount.innerHTML = '';
    }
    
    if (hasChanges) {
        applyBtn.disabled = false;
        applyBtn.textContent = 'Aplicar Filtros';
    } else {
        applyBtn.disabled = true;
        applyBtn.textContent = 'Sin cambios';
    }
}

// Check if filters have changed from current URL
function checkForFilterChanges() {
    const urlParams = new URLSearchParams(window.location.search);
    const currentFilters = {};
    
    urlParams.forEach((value, key) => {
        if (key !== 'page' && key !== 'buscar' && key !== 'ordenar') {
            currentFilters[key] = value;
        }
    });
    
    // Check if filters are different
    const selectedKeys = Object.keys(selectedFilters);
    const currentKeys = Object.keys(currentFilters);
    
    // Create a combined set of all keys
    const allKeys = new Set([...selectedKeys, ...currentKeys]);
    
    for (let key of allKeys) {
        // If one has the key and the other doesn't, there's a change
        if ((selectedFilters[key] && !currentFilters[key]) || 
            (!selectedFilters[key] && currentFilters[key])) {
            return true;
        }
        
        // If both have the key but values are different
        if (selectedFilters[key] !== currentFilters[key]) {
            return true;
        }
    }
    
    return false;
}

// Apply filters button
document.getElementById('applyFiltersBtn').addEventListener('click', function() {
    if (!this.disabled) {
        document.getElementById('loadingOverlay').classList.add('active');
        window.location.href = buildFilterUrl();
    }
});

// Clear filters button
document.getElementById('clearFiltersBtn').addEventListener('click', function() {
    selectedFilters = {};
    document.querySelectorAll('.filter-checkbox').forEach(cb => cb.checked = false);
    updateApplyButton();
    
    // Optional: Apply clear immediately
    document.getElementById('loadingOverlay').classList.add('active');
    const searchParam = new URLSearchParams(window.location.search).get('buscar');
    const clearUrl = '{{ route("catalog.index") }}' + (searchParam ? '?buscar=' + searchParam : '');
    window.location.href = clearUrl;
});

// Handle sort select
document.getElementById('sortSelect').addEventListener('change', function() {
    document.getElementById('loadingOverlay').classList.add('active');
    window.location.href = buildFilterUrl({ ordenar: this.value });
});

// Reveal on scroll
const revealElements = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
});

revealElements.forEach(el => revealObserver.observe(el));

// Mobile filters toggle
function toggleFilters() {
    const sidebar = document.getElementById('filtersSidebar');
    const overlay = document.getElementById('filtersOverlay');
    
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
    document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
}

// Quick View - Fixed to prevent event propagation
async function quickView(event, productId) {
    // Prevent the click from propagating to the parent link
    event.preventDefault();
    event.stopPropagation();
    
    const modal = document.getElementById('quickViewModal');
    const content = document.getElementById('quickViewContent');
    
    // Show loading
    content.innerHTML = '<div class="text-center py-12"><div class="w-12 h-12 border-2 border-gray-300 border-t-black rounded-full animate-spin mx-auto"></div></div>';
    
    // Show modal
    modal.classList.remove('opacity-0', 'invisible');
    document.body.style.overflow = 'hidden';
    
    try {
        const response = await fetch(`/catalogo/vista-rapida/${productId}`);
        const data = await response.json();
        content.innerHTML = data.html;
    } catch (error) {
        content.innerHTML = '<p class="text-center text-red-500">Error al cargar el producto</p>';
    }
}

function closeQuickView() {
    const modal = document.getElementById('quickViewModal');
    modal.classList.add('opacity-0', 'invisible');
    document.body.style.overflow = '';
}

// Close modal on outside click
document.getElementById('quickViewModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeQuickView();
    }
});

// Filter accordion toggle
document.querySelectorAll('.filter-title').forEach(title => {
    title.addEventListener('click', function() {
        const section = this.parentElement;
        const icon = this.querySelector('i');
        const content = this.nextElementSibling;
        
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
        icon.classList.toggle('fa-chevron-up');
        icon.classList.toggle('fa-chevron-down');
    });
});

// Search with suggestions
let searchTimeout;
const searchInput = document.querySelector('input[name="buscar"]');
const searchContainer = searchInput?.parentElement;

if (searchInput) {
    // Create suggestions container
    const suggestionsContainer = document.createElement('div');
    suggestionsContainer.className = 'absolute top-full left-0 right-0 bg-white border border-gray-200 shadow-lg mt-1 max-h-96 overflow-y-auto z-50 hidden';
    searchContainer.appendChild(suggestionsContainer);
    
    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        const query = e.target.value;
        
        if (query.length < 2) {
            suggestionsContainer.classList.add('hidden');
            return;
        }
        
        searchTimeout = setTimeout(() => {
            fetch(`/catalogo/buscar-sugerencias?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    displaySuggestions(data, suggestionsContainer);
                });
        }, 300);
    });
    
    // Close suggestions on outside click
    document.addEventListener('click', function(e) {
        if (!searchContainer.contains(e.target)) {
            suggestionsContainer.classList.add('hidden');
        }
    });
}

function displaySuggestions(data, container) {
    let html = '';
    
    // Products
    if (data.products && data.products.length > 0) {
        html += '<div class="p-3 border-b"><h4 class="text-xs font-medium text-gray-500 uppercase">Productos</h4></div>';
        data.products.forEach(product => {
            html += `
                <a href="/catalogo/${product.slug}" class="block p-3 hover:bg-gray-50 flex items-center space-x-3">
                    <img src="${product.featured_image ? '/storage/' + product.featured_image : 'https://via.placeholder.com/50'}" 
                         class="w-12 h-12 object-cover">
                    <div class="flex-1">
                        <p class="text-sm font-medium">${product.name}</p>
                        <p class="text-xs text-gray-500">${product.brand.name} - S/ ${product.sale_price || product.price}</p>
                    </div>
                </a>
            `;
        });
    }
    
    // Brands
    if (data.brands && data.brands.length > 0) {
        html += '<div class="p-3 border-b"><h4 class="text-xs font-medium text-gray-500 uppercase">Marcas</h4></div>';
        data.brands.forEach(brand => {
            html += `
                <a href="${buildFilterUrl({marca: brand.slug})}" class="block p-3 hover:bg-gray-50 text-sm">
                    ${brand.name}
                </a>
            `;
        });
    }
    
    // Categories
    if (data.categories && data.categories.length > 0) {
        html += '<div class="p-3 border-b"><h4 class="text-xs font-medium text-gray-500 uppercase">Categorías</h4></div>';
        data.categories.forEach(category => {
            html += `
                <a href="${buildFilterUrl({categoria: category.slug})}" class="block p-3 hover:bg-gray-50 text-sm">
                    ${category.name}
                </a>
            `;
        });
    }
    
    if (html === '') {
        html = '<div class="p-4 text-center text-gray-500">No se encontraron resultados</div>';
    }
    
    container.innerHTML = html;
    container.classList.remove('hidden');
}

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize filters from URL
    initializeFilters();
    updateApplyButton();
    
    // Handle price inputs
    const priceMinInput = document.getElementById('precio_min_input');
    const priceMaxInput = document.getElementById('precio_max_input');
    
    if (priceMinInput && priceMaxInput) {
        // Initialize price values from URL
        const urlParams = new URLSearchParams(window.location.search);
        const currentMinPrice = urlParams.get('precio_min');
        const currentMaxPrice = urlParams.get('precio_max');
        
        if (currentMinPrice) selectedFilters.precio_min = currentMinPrice;
        if (currentMaxPrice) selectedFilters.precio_max = currentMaxPrice;
        
        // Add event listeners
        priceMinInput.addEventListener('input', function() {
            if (this.value && this.value !== this.getAttribute('min')) {
                selectedFilters.precio_min = this.value;
            } else {
                delete selectedFilters.precio_min;
            }
            updateApplyButton();
        });
        
        priceMaxInput.addEventListener('input', function() {
            if (this.value && this.value !== this.getAttribute('max')) {
                selectedFilters.precio_max = this.value;
            } else {
                delete selectedFilters.precio_max;
            }
            updateApplyButton();
        });
    }
    
    // Check for filter changes in URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.toString()) {
        // Scroll to products if filters are active
        const productsSection = document.querySelector('.product-grid')?.closest('section');
        if (productsSection) {
            setTimeout(() => {
                window.scrollTo({
                    top: productsSection.offsetTop - 100,
                    behavior: 'smooth'
                });
            }, 500);
        }
    }
});
</script>

@endsection