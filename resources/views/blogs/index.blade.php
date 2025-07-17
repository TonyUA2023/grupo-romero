@extends('layouts.app')

@section('title', 'Blog - GRC Clínica Optométrica')
@section('description', 'Artículos y consejos sobre salud visual, cuidado de la vista y las últimas tendencias en optometría.')


@section('content')

<style>
    :root {
        --primary-color: #3B82F6;
        --primary-dark: #2563EB;
        --secondary-color: #10B981;
        --gray-50: #F9FAFB;
        --gray-100: #F3F4F6;
        --gray-200: #E5E7EB;
        --gray-300: #D1D5DB;
        --gray-400: #9CA3AF;
        --gray-500: #6B7280;
        --gray-600: #4B5563;
        --gray-700: #374151;
        --gray-800: #1F2937;
        --gray-900: #111827;
        --border-radius: 1rem;
        --border-radius-lg: 1.5rem;
        --transition-speed: 0.3s;
        --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 60px rgba(0, 0, 0, 0.15);
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Enhanced animations */
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

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }

    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    .animate-fade-in-scale {
        animation: fadeInScale 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    /* Animation delays */
    .animation-delay-100 { animation-delay: 0.1s; }
    .animation-delay-200 { animation-delay: 0.2s; }
    .animation-delay-300 { animation-delay: 0.3s; }
    .animation-delay-400 { animation-delay: 0.4s; }
    .animation-delay-500 { animation-delay: 0.5s; }
    .animation-delay-600 { animation-delay: 0.6s; }

    /* Enhanced gradient text */
    .gradient-text {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
    }

    /* Hero section decorative elements */
    .hero-decoration {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border-radius: 50%;
    }

    /* Enhanced search bar */
    .search-container {
        position: relative;
        max-width: 100%;
    }

    .search-input {
        width: 100%;
        padding: 1rem 3rem 1rem 3.5rem;
        background: var(--gray-50);
        border: 2px solid transparent;
        border-radius: 2rem;
        font-size: 1rem;
        transition: all var(--transition-speed) cubic-bezier(0.16, 1, 0.3, 1);
    }

    .search-input:focus {
        outline: none;
        background: white;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transform: translateY(-2px);
    }

    .search-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        transition: color var(--transition-speed);
    }

    .search-input:focus ~ .search-icon {
        color: var(--primary-color);
    }

    /* Category pills enhanced */
    .category-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.625rem 1.5rem;
        background: var(--gray-100);
        color: var(--gray-700);
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all var(--transition-speed);
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
        white-space: nowrap;
    }

    .category-pill::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s;
    }

    .category-pill:hover {
        background: var(--gray-200);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .category-pill:hover::before {
        left: 100%;
    }

    .category-pill.active {
        background: var(--primary-color);
        color: white;
        font-weight: 600;
    }

    .category-pill.active:hover {
        background: var(--primary-dark);
    }

    /* Blog card enhanced */
    .blog-card {
        background: white;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        transition: all var(--transition-speed) cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid var(--gray-200);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .blog-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform var(--transition-speed);
    }

    .blog-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: transparent;
    }

    .blog-card:hover::before {
        transform: scaleX(1);
    }

    /* Featured blog card */
    .featured-card {
        background: white;
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        transition: all var(--transition-speed);
        position: relative;
    }

    .featured-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-xl);
    }

    .featured-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        color: white;
        border-radius: 2rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        animation: pulse 2s infinite;
    }

    /* Image container with zoom */
    .image-container {
        position: relative;
        overflow: hidden;
        background: var(--gray-100);
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .blog-card:hover .image-container img,
    .featured-card:hover .image-container img {
        transform: scale(1.1);
    }

    /* Read more arrow */
    .read-more-arrow {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        transition: all var(--transition-speed);
    }

    .blog-card:hover .read-more-arrow {
        transform: translateX(5px);
        background: var(--primary-dark);
    }

    /* Widget cards */
    .widget-card {
        background: white;
        border-radius: var(--border-radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        transition: all var(--transition-speed);
        border: 1px solid var(--gray-200);
    }

    .widget-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-5px);
    }

    .widget-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .widget-title i {
        font-size: 1.5rem;
    }

    /* Popular post item */
    .popular-post-item {
        display: block;
        padding: 0.75rem;
        margin: -0.75rem;
        border-radius: 0.75rem;
        transition: all var(--transition-speed);
        text-decoration: none;
    }

    .popular-post-item:hover {
        background: var(--gray-50);
        transform: translateX(5px);
    }

    /* Tag cloud */
    .tag-item {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: var(--gray-100);
        color: var(--gray-700);
        border-radius: 2rem;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all var(--transition-speed);
        border: 2px solid transparent;
    }

    .tag-item:hover {
        background: var(--primary-color);
        color: white;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    /* Archive link */
    .archive-link {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        margin: 0 -1rem;
        border-radius: 0.75rem;
        transition: all var(--transition-speed);
        text-decoration: none;
        color: var(--gray-700);
    }

    .archive-link:hover {
        background: var(--gray-50);
        color: var(--primary-color);
        padding-left: 1.5rem;
    }

    /* Pagination enhanced */
    .pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
        min-width: 2.5rem;
        height: 2.5rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all var(--transition-speed);
        text-decoration: none;
    }

    .pagination a {
        background: white;
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
    }

    .pagination a:hover {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .pagination .active span {
        background: var(--primary-color);
        color: white;
        font-weight: 600;
    }

    /* Responsive filters */
    .filters-container {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    @media (max-width: 1024px) {
        .filters-container {
            flex-direction: column;
            align-items: stretch;
        }

        .category-pills {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
            padding-bottom: 0.5rem;
        }

        .category-pills::-webkit-scrollbar {
            height: 4px;
        }

        .category-pills::-webkit-scrollbar-track {
            background: var(--gray-100);
            border-radius: 2px;
        }

        .category-pills::-webkit-scrollbar-thumb {
            background: var(--gray-400);
            border-radius: 2px;
        }
    }

    /* Mobile optimizations */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem !important;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.125rem !important;
        }

        .blog-grid {
            grid-template-columns: 1fr !important;
        }

        .featured-card .grid {
            grid-template-columns: 1fr !important;
        }

        .widget-grid {
            grid-template-columns: 1fr !important;
        }

        .search-input {
            font-size: 16px; /* Prevent zoom on iOS */
        }
    }

    /* Loading skeleton */
    .skeleton {
        background: linear-gradient(90deg, var(--gray-200) 25%, var(--gray-100) 50%, var(--gray-200) 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Accessibility improvements */
    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    /* Focus states */
    a:focus,
    button:focus,
    input:focus,
    .category-pill:focus,
    .tag-item:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 3px;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: var(--gray-300);
        margin-bottom: 1rem;
    }

    .empty-state-title {
        font-size: 1.5rem;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        color: var(--gray-500);
        margin-bottom: 2rem;
    }

    /* Newsletter section */
    .newsletter-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }

    .newsletter-decoration {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite;
    }

    /* Print styles */
    @media print {
        .no-print {
            display: none !important;
        }
        
        .blog-card {
            break-inside: avoid;
            box-shadow: none;
            border: 1px solid #ddd;
        }
    }
</style>
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-emerald-600 py-16 md:py-24 overflow-hidden">
    <!-- Decorative elements -->
    <div class="hero-decoration w-32 h-32 md:w-40 md:h-40 -top-10 -left-10 animate-float"></div>
    <div class="hero-decoration w-48 h-48 md:w-60 md:h-60 top-20 right-20 animate-float animation-delay-200"></div>
    <div class="hero-decoration w-24 h-24 md:w-32 md:h-32 bottom-10 left-1/4 animate-float animation-delay-400"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white">
            <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-light mb-4 md:mb-6 animate-fade-in-up">
                {{ $heroSection->title ?? 'Nuestro Blog' }}
            </h1>
            <p class="hero-subtitle text-lg md:text-xl lg:text-2xl font-light text-white/90 max-w-3xl mx-auto animate-fade-in-up animation-delay-200">
                {{ $heroSection->content ?? 'Descubre consejos, noticias y tendencias sobre salud visual de la mano de nuestros especialistas' }}
            </p>
        </div>
    </div>
</section>

<!-- Search and Filters Section -->
<section class="bg-white border-b border-gray-100 sticky top-0 z-40 shadow-sm no-print">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6">
        <form method="GET" action="{{ route('blogs.index') }}" class="filters-container">
            <!-- Search -->
            <div class="search-container w-full lg:w-96">
                <input type="search" 
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Buscar artículos..." 
                       class="search-input"
                       aria-label="Buscar artículos">
                <i class="fas fa-search search-icon" aria-hidden="true"></i>
            </div>

            <!-- Category filters -->
            <div class="category-pills flex gap-2 md:gap-3">
                <a href="{{ route('blogs.index') }}" 
                   class="category-pill {{ !request('category') ? 'active' : '' }}"
                   aria-current="{{ !request('category') ? 'page' : 'false' }}">
                    Todos
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('blogs.index', ['category' => $cat->category]) }}" 
                       class="category-pill {{ request('category') == $cat->category ? 'active' : '' }}"
                       aria-current="{{ request('category') == $cat->category ? 'page' : 'false' }}">
                        {{ $cat->category }} <span class="ml-1 opacity-75">({{ $cat->count }})</span>
                    </a>
                @endforeach
            </div>
        </form>
    </div>
</section>

<!-- Main Content Area -->
<section class="py-8 md:py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($featuredPost && !request()->hasAny(['category', 'search', 'tag', 'month']))
        <!-- Featured Post -->
        <div class="mb-12 md:mb-16">
            <article class="featured-card animate-fade-in-scale">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="image-container h-64 md:h-96 lg:h-auto">
                        <img src="{{ $featuredPost->featured_image ? asset('storage/' . $featuredPost->featured_image) : 'https://via.placeholder.com/800x600' }}" 
                             alt="{{ $featuredPost->title }}" 
                             loading="lazy">
                        <div class="absolute top-4 left-4 md:top-6 md:left-6">
                            <span class="featured-badge">
                                <i class="fas fa-star" aria-hidden="true"></i>
                                Destacado
                            </span>
                        </div>
                    </div>
                    <div class="p-6 md:p-8 lg:p-12 flex flex-col justify-center">
                        <div class="flex flex-wrap items-center gap-3 md:gap-4 mb-4 md:mb-6">
                            <span class="category-pill !py-1 !px-3 !text-xs">
                                {{ $featuredPost->category ?? 'Sin categoría' }}
                            </span>
                            <time class="text-gray-400 text-sm" datetime="{{ $featuredPost->published_at->format('Y-m-d') }}">
                                {{ $featuredPost->published_at->format('d/m/Y') }}
                            </time>
                        </div>
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-light text-gray-900 mb-3 md:mb-4 hover:text-blue-600 transition-colors">
                            <a href="{{ route('blogs.show', $featuredPost->slug) }}">
                                {{ $featuredPost->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 font-light text-base md:text-lg leading-relaxed mb-4 md:mb-6 line-clamp-3">
                            {{ $featuredPost->excerpt }}
                        </p>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <div class="flex items-center gap-3 md:gap-4">
                                @if($featuredPost->author_image)
                                    <img src="{{ asset('storage/' . $featuredPost->author_image) }}" 
                                         alt="{{ $featuredPost->author }}" 
                                         class="w-10 h-10 md:w-12 md:h-12 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                @endif
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm md:text-base">{{ $featuredPost->author }}</h4>
                                    <p class="text-gray-500 text-xs md:text-sm">
                                        {{ $featuredPost->published_at->diffForHumans() }} · {{ number_format($featuredPost->views) }} vistas
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('blogs.show', $featuredPost->slug) }}" 
                               class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium text-sm uppercase tracking-wider transition-colors group">
                                Leer más 
                                <span class="read-more-arrow !w-8 !h-8 text-xs">
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        @endif

        <!-- Blog Posts Grid -->
        <div class="blog-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 mb-8 md:mb-12">
            @forelse($posts as $post)
                @if(!$featuredPost || $post->id !== $featuredPost->id || request()->hasAny(['category', 'search', 'tag', 'month']))
                <article class="blog-card animate-fade-in-up animation-delay-{{ $loop->index % 6 * 100 }}">
                    <div class="image-container h-48 md:h-56">
                        <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/400x300' }}" 
                             alt="{{ $post->title }}" 
                             loading="lazy">
                    </div>
                    <div class="p-4 md:p-6 flex-grow flex flex-col">
                        <div class="flex flex-wrap items-center gap-2 md:gap-3 mb-3 md:mb-4">
                            <span class="category-pill !py-1 !px-3 !text-xs">
                                {{ $post->category ?? 'Sin categoría' }}
                            </span>
                            <time class="text-gray-400 text-xs md:text-sm" datetime="{{ $post->published_at->format('Y-m-d') }}">
                                {{ $post->published_at->format('d/m/Y') }}
                            </time>
                        </div>
                        <h3 class="text-lg md:text-xl font-light text-gray-900 mb-2 md:mb-3 hover:text-blue-600 transition-colors line-clamp-2">
                            <a href="{{ route('blogs.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 font-light text-sm md:text-base leading-relaxed mb-4 line-clamp-3 flex-grow">
                            {{ Str::limit($post->excerpt, 120) }}
                        </p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div class="flex items-center gap-2 text-xs md:text-sm text-gray-500">
                                <span>{{ $post->author }}</span>
                                <span aria-hidden="true">·</span>
                                <span>{{ number_format($post->views) }} vistas</span>
                            </div>
                            <a href="{{ route('blogs.show', $post->slug) }}" 
                               class="read-more-arrow !w-10 !h-10 text-sm"
                               aria-label="Leer más sobre {{ $post->title }}">
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endif
            @empty
                <div class="col-span-full empty-state">
                    <i class="fas fa-newspaper empty-state-icon" aria-hidden="true"></i>
                    <h2 class="empty-state-title">No se encontraron artículos</h2>
                    <p class="empty-state-text">
                        No hay artículos que coincidan con tu búsqueda.
                    </p>
                    <a href="{{ route('blogs.index') }}" class="category-pill active">
                        Ver todos los artículos
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <nav class="flex justify-center" aria-label="Paginación">
            <div class="pagination">
                {{ $posts->links() }}
            </div>
        </nav>
        @endif
    </div>
</section>

<!-- Sidebar Widgets -->
<aside class="py-12 md:py-16 bg-white" aria-label="Contenido relacionado">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="widget-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            
            <!-- Popular Posts Widget -->
            <div class="widget-card animate-fade-in-up">
                <h3 class="widget-title">
                    <i class="fas fa-fire text-red-600" aria-hidden="true"></i>
                    Posts Populares
                </h3>
                <div class="space-y-3">
                    @foreach($popularPosts as $popPost)
                    <a href="{{ route('blogs.show', $popPost->slug) }}" 
                       class="popular-post-item group">
                        <h4 class="text-sm font-medium text-gray-900 group-hover:text-red-600 transition-colors mb-1 line-clamp-2">
                            {{ $popPost->title }}
                        </h4>
                        <div class="flex items-center text-xs text-gray-500">
                            <i class="fas fa-eye mr-1" aria-hidden="true"></i>
                            {{ number_format($popPost->views) }} vistas
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Categories Widget -->
            <div class="widget-card animate-fade-in-up animation-delay-100">
                <h3 class="widget-title">
                    <i class="fas fa-folder-open text-blue-600" aria-hidden="true"></i>
                    Categorías
                </h3>
                <div class="space-y-2">
                    @foreach($categories->take(5) as $cat)
                    <a href="{{ route('blogs.index', ['category' => $cat->category]) }}" 
                       class="archive-link group">
                        <span class="group-hover:text-blue-600 transition-colors">{{ $cat->category }}</span>
                        <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-full text-xs font-medium">
                            {{ $cat->count }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Tags Widget -->
            <div class="widget-card animate-fade-in-up animation-delay-200">
                <h3 class="widget-title">
                    <i class="fas fa-tags text-emerald-600" aria-hidden="true"></i>
                    Etiquetas Populares
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($allTags as $tag => $count)
                    <a href="{{ route('blogs.index', ['tag' => $tag]) }}" 
                       class="tag-item">
                        #{{ $tag }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Archive Widget -->
            <div class="widget-card animate-fade-in-up animation-delay-300">
                <h3 class="widget-title">
                    <i class="fas fa-calendar-alt text-purple-600" aria-hidden="true"></i>
                    Archivo
                </h3>
                <div class="space-y-2">
                    @foreach($archive as $month)
                    <a href="{{ route('blogs.index', ['month' => $month->url_param]) }}" 
                       class="archive-link">
                        <span>{{ $month->formatted }}</span>
                        <span class="text-xs text-gray-500">({{ $month->count }})</span>
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</aside>

<!-- Newsletter Section -->
<section class="newsletter-section py-16 md:py-20 relative no-print">
    <!-- Decorative elements -->
    <div class="newsletter-decoration w-64 h-64 md:w-80 md:h-80 -top-20 -left-20 opacity-10"></div>
    <div class="newsletter-decoration w-48 h-48 md:w-60 md:h-60 bottom-10 right-10 opacity-10 animation-delay-400"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white relative z-10">
        <h2 class="text-3xl md:text-4xl font-light mb-4 animate-fade-in-up">
            Mantente <span class="font-semibold">Informado</span>
        </h2>
        <p class="text-lg md:text-xl font-light text-white/90 mb-8 animate-fade-in-up animation-delay-200">
            Suscríbete a nuestro newsletter y recibe los mejores consejos de salud visual
        </p>
        <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto animate-fade-in-up animation-delay-400">
            <input type="email" 
                   placeholder="Tu correo electrónico" 
                   class="flex-1 px-6 py-3 rounded-full text-gray-900 focus:outline-none focus:ring-4 focus:ring-white/30"
                   required>
            <button type="submit" 
                    class="px-8 py-3 bg-white text-purple-600 rounded-full font-medium hover:bg-gray-100 transition-all hover:shadow-lg">
                Suscribirse
            </button>
        </form>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-fade-in-up, .animate-fade-in-scale').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s cubic-bezier(0.16, 1, 0.3, 1)';
        observer.observe(el);
    });

    // Auto-submit search form on input change with debounce
    let searchTimeout;
    const searchInput = document.querySelector('.search-input');
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (e.target.value.length === 0 || e.target.value.length > 2) {
                    this.form.submit();
                }
            }, 500);
        });
    }

    // Smooth scroll for category pills on mobile
    const categoryContainer = document.querySelector('.category-pills');
    if (categoryContainer && window.innerWidth < 1024) {
        let isDown = false;
        let startX;
        let scrollLeft;

        categoryContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            startX = e.pageX - categoryContainer.offsetLeft;
            scrollLeft = categoryContainer.scrollLeft;
        });

        categoryContainer.addEventListener('mouseleave', () => {
            isDown = false;
        });

        categoryContainer.addEventListener('mouseup', () => {
            isDown = false;
        });

        categoryContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - categoryContainer.offsetLeft;
            const walk = (x - startX) * 2;
            categoryContainer.scrollLeft = scrollLeft - walk;
        });
    }

    // Add loading state to pagination links
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function() {
            this.style.opacity = '0.5';
            this.style.pointerEvents = 'none';
        });
    });

    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[loading="lazy"]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Newsletter form handling
    const newsletterForm = document.querySelector('.newsletter-section form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your newsletter submission logic here
            alert('¡Gracias por suscribirte! Te mantendremos informado.');
            this.reset();
        });
    }
});
</script>

@endsection

