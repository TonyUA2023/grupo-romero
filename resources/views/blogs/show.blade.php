@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title . ' - GRC Clínica Optométrica')
@section('description', $post->meta_description ?? Str::limit($post->excerpt, 160))

@push('meta')
<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
<meta property="og:description" content="{{ $post->meta_description ?? Str::limit($post->excerpt, 160) }}">
<meta property="og:image" content="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/default-blog.jpg') }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $post->meta_title ?? $post->title }}">
<meta property="twitter:description" content="{{ $post->meta_description ?? Str::limit($post->excerpt, 160) }}">
<meta property="twitter:image" content="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/default-blog.jpg') }}">

<!-- Article specific -->
<meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
<meta property="article:author" content="{{ $post->author }}">
@if($post->tags && is_array($post->tags))
    @foreach($post->tags as $tag)
    <meta property="article:tag" content="{{ $tag }}">
    @endforeach
@endif
@endpush

@push('styles')
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
        --transition-speed: 0.3s;
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

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    .animation-delay-200 { animation-delay: 0.2s; }
    .animation-delay-400 { animation-delay: 0.4s; }
    .animation-delay-600 { animation-delay: 0.6s; }

    /* Enhanced progress bar */
    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        z-index: 100;
        transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.5);
    }

    /* Back to top button */
    .back-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        background: var(--primary-color);
        color: white;
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transition: all var(--transition-speed) ease;
        z-index: 90;
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .back-to-top:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    }

    /* Table of contents */
    .table-of-contents {
        background: var(--gray-50);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--gray-200);
    }

    .table-of-contents h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: var(--gray-900);
    }

    .table-of-contents ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .table-of-contents li {
        margin-bottom: 0.5rem;
    }

    .table-of-contents a {
        color: var(--gray-600);
        text-decoration: none;
        display: flex;
        align-items: center;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        transition: all var(--transition-speed);
        font-size: 0.875rem;
    }

    .table-of-contents a:hover {
        background: white;
        color: var(--primary-color);
        padding-left: 1.25rem;
    }

    .table-of-contents a.active {
        background: white;
        color: var(--primary-color);
        font-weight: 500;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Enhanced blog content */
    .blog-content {
        font-size: 1.125rem;
        line-height: 1.8;
        color: var(--gray-700);
    }

    @media (max-width: 768px) {
        .blog-content {
            font-size: 1rem;
            line-height: 1.75;
        }
    }

    .blog-content h1,
    .blog-content h2,
    .blog-content h3,
    .blog-content h4,
    .blog-content h5,
    .blog-content h6 {
        color: var(--gray-900);
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
        font-weight: 600;
        position: relative;
        scroll-margin-top: 5rem;
    }

    .blog-content h2 {
        font-size: 1.875rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--gray-100);
    }

    .blog-content h3 {
        font-size: 1.5rem;
    }

    @media (max-width: 768px) {
        .blog-content h2 { font-size: 1.5rem; }
        .blog-content h3 { font-size: 1.25rem; }
    }

    .blog-content p {
        margin-bottom: 1.5rem;
    }

    .blog-content ul,
    .blog-content ol {
        margin-bottom: 1.5rem;
        padding-left: 2rem;
    }

    .blog-content li {
        margin-bottom: 0.75rem;
        position: relative;
    }

    .blog-content ul li::before {
        content: "•";
        color: var(--primary-color);
        font-weight: bold;
        position: absolute;
        left: -1.5rem;
    }

    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: var(--border-radius);
        margin: 2.5rem auto;
        display: block;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.15);
        transition: transform var(--transition-speed);
    }

    .blog-content img:hover {
        transform: scale(1.02);
    }

    .blog-content blockquote {
        border-left: 4px solid var(--primary-color);
        padding: 1.5rem 1.5rem 1.5rem 2rem;
        margin: 2rem 0;
        font-style: italic;
        color: var(--gray-600);
        background: var(--gray-50);
        border-radius: 0 var(--border-radius) var(--border-radius) 0;
        position: relative;
    }

    .blog-content blockquote::before {
        content: """;
        font-size: 3rem;
        color: var(--primary-color);
        position: absolute;
        top: -0.5rem;
        left: 1rem;
        opacity: 0.3;
    }

    .blog-content a {
        color: var(--primary-color);
        text-decoration: none;
        position: relative;
        font-weight: 500;
        transition: color var(--transition-speed);
    }

    .blog-content a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-color);
        transition: width var(--transition-speed);
    }

    .blog-content a:hover {
        color: var(--primary-dark);
    }

    .blog-content a:hover::after {
        width: 100%;
    }

    .blog-content pre {
        background-color: var(--gray-900);
        color: var(--gray-100);
        padding: 1.5rem;
        border-radius: var(--border-radius);
        overflow-x: auto;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
        line-height: 1.6;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .blog-content code {
        background-color: var(--gray-100);
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-family: 'Monaco', 'Consolas', monospace;
    }

    .blog-content pre code {
        background-color: transparent;
        padding: 0;
    }

    /* Enhanced share buttons */
    .share-buttons-container {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        align-items: center;
    }

    .share-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all var(--transition-speed);
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .share-button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .share-button:hover::before {
        width: 300px;
        height: 300px;
    }

    .share-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .share-button i {
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    @media (max-width: 640px) {
        .share-button {
            padding: 0.75rem;
            width: 3rem;
            height: 3rem;
        }
        
        .share-button span {
            display: none;
        }
        
        .share-button i {
            margin-right: 0;
        }
    }

    /* Enhanced gradient text */
    .gradient-text {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
    }

    /* Enhanced related posts */
    .related-post-card {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        transition: all var(--transition-speed);
        border: 1px solid var(--gray-200);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .related-post-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: transparent;
    }

    .related-post-card .image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: var(--gray-100);
    }

    .related-post-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .related-post-card:hover img {
        transform: scale(1.1);
    }

    .related-post-card .content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    /* Enhanced tag pills */
    .tag-pill {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: var(--gray-100);
        color: var(--gray-700);
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all var(--transition-speed);
        text-decoration: none;
        border: 2px solid transparent;
    }

    .tag-pill:hover {
        background: var(--primary-color);
        color: white;
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    /* Enhanced author box */
    .author-box {
        background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
        border-radius: var(--border-radius);
        padding: 2rem;
        border: 1px solid var(--gray-200);
        transition: all var(--transition-speed);
    }

    .author-box:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    /* Mobile-optimized sidebar */
    @media (max-width: 1024px) {
        .sidebar-sticky {
            position: relative !important;
            top: 0 !important;
        }
    }

    /* Enhanced navigation cards */
    .nav-card {
        display: block;
        padding: 1.5rem;
        background: var(--gray-50);
        border-radius: var(--border-radius);
        transition: all var(--transition-speed);
        text-decoration: none;
        border: 1px solid var(--gray-200);
        position: relative;
        overflow: hidden;
    }

    .nav-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
        transition: width var(--transition-speed);
    }

    .nav-card:hover {
        background: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transform: translateX(5px);
    }

    .nav-card:hover::before {
        width: 100%;
    }

    /* Reading time indicator */
    .reading-time-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        font-size: 0.875rem;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Responsive hero section */
    @media (max-width: 768px) {
        .hero-section {
            padding: 3rem 0;
        }
        
        .hero-title {
            font-size: 2rem !important;
            line-height: 1.3;
        }
        
        .hero-meta {
            flex-direction: column;
            gap: 1rem;
        }
    }

    /* Enhanced CTA box */
    .cta-box {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border-radius: var(--border-radius);
        padding: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .cta-box::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        animation: pulse 4s ease-in-out infinite;
    }

    .cta-button {
        display: inline-block;
        background: white;
        color: var(--primary-color);
        padding: 0.75rem 2rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all var(--transition-speed);
        text-decoration: none;
        position: relative;
        z-index: 1;
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        background: var(--gray-50);
    }

    /* Focus states for accessibility */
    a:focus,
    button:focus {
        outline: 3px solid var(--primary-color);
        outline-offset: 3px;
    }

    /* Print styles */
    @media print {
        .no-print {
            display: none !important;
        }
        
        .blog-content {
            font-size: 12pt;
            line-height: 1.5;
        }
        
        .blog-content a {
            color: black;
            text-decoration: underline;
        }
    }
</style>
@endpush

@section('content')

<!-- Progress Bar -->
<div class="reading-progress" id="readingProgress"></div>

<!-- Back to Top Button -->
<button class="back-to-top no-print" id="backToTop" aria-label="Volver arriba">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Hero Section -->
<section class="hero-section relative bg-gradient-to-br from-gray-900 to-gray-800 py-16 md:py-24 overflow-hidden">
    <div class="absolute inset-0">
        @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover opacity-20"
                 loading="lazy">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-gray-900/50"></div>
    </div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-white">
            <!-- Breadcrumb -->
            <nav class="mb-6 md:mb-8 animate-fade-in-up" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center justify-center gap-2 text-xs sm:text-sm text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Inicio</a></li>
                    <li aria-hidden="true">/</li>
                    <li><a href="{{ route('blogs.index') }}" class="hover:text-white transition-colors">Blog</a></li>
                    <li aria-hidden="true">/</li>
                    <li class="text-white truncate max-w-[200px]" aria-current="page">{{ $post->title }}</li>
                </ol>
            </nav>

            <!-- Category -->
            <div class="mb-4 md:mb-6 animate-fade-in-up animation-delay-200">
                <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-xs sm:text-sm font-light uppercase tracking-wider">
                    {{ $post->category ?? 'Sin categoría' }}
                </span>
            </div>

            <!-- Title -->
            <h1 class="hero-title text-3xl md:text-4xl lg:text-5xl font-light mb-4 md:mb-6 animate-fade-in-up animation-delay-400">
                {{ $post->title }}
            </h1>

            <!-- Meta info -->
            <div class="hero-meta flex flex-wrap items-center justify-center gap-3 md:gap-4 text-gray-300 animate-fade-in-up animation-delay-600 text-sm md:text-base">
                <div class="reading-time-badge">
                    <i class="fas fa-user"></i>
                    <span>{{ $post->author }}</span>
                </div>
                <div class="reading-time-badge">
                    <i class="fas fa-calendar"></i>
                    <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                        {{ $post->published_at->format('d M, Y') }}
                    </time>
                </div>
                <div class="reading-time-badge">
                    <i class="fas fa-clock"></i>
                    <span>{{ $readingTime }} min de lectura</span>
                </div>
                <div class="reading-time-badge">
                    <i class="fas fa-eye"></i>
                    <span>{{ number_format($post->views) }} vistas</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<article class="py-8 md:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            <!-- Main Content Area -->
            <div class="lg:col-span-8">
                <!-- Featured Image -->
                @if($post->featured_image)
                <div class="mb-8 md:mb-12 animate-slide-in-left">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full rounded-2xl shadow-2xl"
                         loading="lazy">
                </div>
                @endif

                <!-- Excerpt -->
                @if($post->excerpt)
                <div class="mb-6 md:mb-8 text-lg md:text-xl text-gray-600 font-light leading-relaxed border-l-4 border-blue-500 pl-4 md:pl-6 animate-slide-in-left animation-delay-200">
                    {{ $post->excerpt }}
                </div>
                @endif

                <!-- Table of Contents (visible on mobile) -->
                <div class="lg:hidden table-of-contents mb-8" id="mobileToc">
                    <h3><i class="fas fa-list-ul mr-2"></i>Tabla de contenidos</h3>
                    <ul id="mobileTocList"></ul>
                </div>

                <!-- Content -->
                <div class="blog-content animate-slide-in-left animation-delay-400" id="blogContent">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags && is_array($post->tags) && count($post->tags) > 0)
                <div class="mt-8 md:mt-12 pt-8 border-t border-gray-200 no-print">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Etiquetas relacionadas:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            @if(!empty($tag))
                            <a href="{{ route('blogs.index', ['tag' => $tag]) }}" 
                               class="tag-pill">
                                #{{ $tag }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Share buttons -->
                <div class="mt-8 md:mt-12 pt-8 border-t border-gray-200 no-print">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Compartir este artículo:</h3>
                    <div class="share-buttons-container">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="share-button bg-blue-600 text-white hover:bg-blue-700"
                           aria-label="Compartir en Facebook">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="share-button bg-sky-500 text-white hover:bg-sky-600"
                           aria-label="Compartir en Twitter">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="share-button bg-blue-700 text-white hover:bg-blue-800"
                           aria-label="Compartir en LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                            <span>LinkedIn</span>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="share-button bg-green-600 text-white hover:bg-green-700"
                           aria-label="Compartir en WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                            <span>WhatsApp</span>
                        </a>
                        <button onclick="copyToClipboard('{{ url()->current() }}')" 
                                class="share-button bg-gray-600 text-white hover:bg-gray-700"
                                aria-label="Copiar enlace">
                            <i class="fas fa-link"></i>
                            <span>Copiar enlace</span>
                        </button>
                    </div>
                    <div id="copyNotification" class="hidden mt-2 text-sm text-green-600 font-medium">
                        ¡Enlace copiado al portapapeles!
                    </div>
                </div>

                <!-- Author Box -->
                <div class="author-box mt-8 md:mt-12 no-print">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Acerca del autor</h3>
                    <div class="flex flex-col sm:flex-row items-start gap-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 mb-2">{{ $post->author }}</h4>
                            <p class="text-gray-600 font-light">
                                Especialista en salud visual en GRC Clínica Optométrica. 
                                Comprometido con brindar información valiosa para el cuidado de tus ojos.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="mt-8 md:mt-12 grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 no-print" aria-label="Navegación entre artículos">
                    @if($previousPost)
                    <a href="{{ route('blogs.show', $previousPost->slug) }}" 
                       class="nav-card group">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-arrow-left mr-2 text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                            <span class="text-sm text-gray-500">Artículo anterior</span>
                        </div>
                        <h4 class="text-gray-900 font-medium group-hover:text-blue-600 transition-colors line-clamp-2">
                            {{ $previousPost->title }}
                        </h4>
                    </a>
                    @else
                    <div></div>
                    @endif

                    @if($nextPost)
                    <a href="{{ route('blogs.show', $nextPost->slug) }}" 
                       class="nav-card group text-right">
                        <div class="flex items-center justify-end mb-2">
                            <span class="text-sm text-gray-500">Siguiente artículo</span>
                            <i class="fas fa-arrow-right ml-2 text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                        </div>
                        <h4 class="text-gray-900 font-medium group-hover:text-blue-600 transition-colors line-clamp-2">
                            {{ $nextPost->title }}
                        </h4>
                    </a>
                    @endif
                </nav>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4">
                <div class="sidebar-sticky lg:sticky lg:top-24 space-y-6 md:space-y-8">
                    <!-- Table of Contents (desktop) -->
                    <div class="hidden lg:block table-of-contents no-print" id="desktopToc">
                        <h3><i class="fas fa-list-ul mr-2"></i>Tabla de contenidos</h3>
                        <ul id="desktopTocList"></ul>
                    </div>

                    <!-- Recent Posts -->
                    <div class="bg-gray-50 rounded-2xl p-6">
                        <h3 class="text-xl font-light text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-newspaper mr-3 text-blue-600"></i>
                            Artículos Recientes
                        </h3>
                        <div class="space-y-4">
                            @foreach($recentPosts as $recentPost)
                            <a href="{{ route('blogs.show', $recentPost->slug) }}" 
                               class="block hover:bg-white p-3 rounded-lg transition-all group">
                                <h4 class="text-sm font-medium text-gray-900 group-hover:text-blue-600 transition-colors mb-1 line-clamp-2">
                                    {{ $recentPost->title }}
                                </h4>
                                <time class="text-xs text-gray-500" datetime="{{ $recentPost->published_at->format('Y-m-d') }}">
                                    {{ $recentPost->published_at->format('d M, Y') }}
                                </time>
                            </a>
                            @endforeach
                        </div>
                        <a href="{{ route('blogs.index') }}" 
                           class="mt-6 inline-block text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                            Ver todos los artículos →
                        </a>
                    </div>

                    <!-- CTA -->
                    <div class="cta-box">
                        <h3 class="text-xl font-light mb-4">¿Necesitas un examen visual?</h3>
                        <p class="text-sm text-white/90 mb-6">
                            Agenda tu cita con nuestros especialistas y cuida tu salud visual.
                        </p>
                        <a href="{{ route('contact') }}" 
                           class="cta-button">
                            Agendar Cita
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="py-12 md:py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl md:text-3xl font-light text-gray-900 mb-8 text-center">
            Artículos <span class="gradient-text">Relacionados</span>
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @foreach($relatedPosts as $relatedPost)
            <article class="related-post-card">
                @if($relatedPost->featured_image)
                <div class="image-container">
                    <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" 
                         alt="{{ $relatedPost->title }}" 
                         class="w-full h-full object-cover"
                         loading="lazy">
                </div>
                @endif
                <div class="content">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-light uppercase tracking-wider">
                            {{ $relatedPost->category ?? 'Sin categoría' }}
                        </span>
                        <time class="text-gray-400 text-sm" datetime="{{ $relatedPost->published_at->format('Y-m-d') }}">
                            {{ $relatedPost->published_at->format('d/m/Y') }}
                        </time>
                    </div>
                    <h3 class="text-lg md:text-xl font-light text-gray-900 mb-3 hover:text-blue-600 transition-colors">
                        <a href="{{ route('blogs.show', $relatedPost->slug) }}" class="line-clamp-2">
                            {{ $relatedPost->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 font-light text-sm leading-relaxed line-clamp-3">
                        {{ $relatedPost->excerpt ?? Str::limit(strip_tags($relatedPost->content), 100) }}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reading progress bar
    const updateProgressBar = () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById('readingProgress').style.width = scrolled + '%';
    };

    window.addEventListener('scroll', updateProgressBar);

    // Back to top button
    const backToTopButton = document.getElementById('backToTop');
    
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });

    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Generate table of contents
    const generateTOC = () => {
        const content = document.getElementById('blogContent');
        const headings = content.querySelectorAll('h2, h3');
        const mobileTocList = document.getElementById('mobileTocList');
        const desktopTocList = document.getElementById('desktopTocList');
        
        if (headings.length === 0) {
            document.getElementById('mobileToc').style.display = 'none';
            document.getElementById('desktopToc').style.display = 'none';
            return;
        }

        headings.forEach((heading, index) => {
            // Add ID to heading if it doesn't have one
            if (!heading.id) {
                heading.id = 'heading-' + index;
            }

            // Create TOC item
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = '#' + heading.id;
            a.textContent = heading.textContent;
            a.classList.add('toc-link');
            
            if (heading.tagName === 'H3') {
                li.style.marginLeft = '1rem';
            }
            
            li.appendChild(a);
            
            // Add to both mobile and desktop TOC
            mobileTocList.appendChild(li.cloneNode(true));
            desktopTocList.appendChild(li);
        });

        // Smooth scroll for TOC links
        document.querySelectorAll('.toc-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = 80; // Account for fixed header
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - offset;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Highlight active section in TOC
        const observerOptions = {
            rootMargin: '-80px 0px -70% 0px'
        };

        const observerCallback = (entries) => {
            entries.forEach(entry => {
                const id = entry.target.id;
                const tocLinks = document.querySelectorAll(`a[href="#${id}"]`);
                
                if (entry.isIntersecting) {
                    // Remove all active classes
                    document.querySelectorAll('.toc-link.active').forEach(link => {
                        link.classList.remove('active');
                    });
                    // Add active class to current section
                    tocLinks.forEach(link => link.classList.add('active'));
                }
            });
        };

        const observer = new IntersectionObserver(observerCallback, observerOptions);
        headings.forEach(heading => observer.observe(heading));
    };

    generateTOC();

    // Copy to clipboard function
    window.copyToClipboard = function(text) {
        navigator.clipboard.writeText(text).then(function() {
            const notification = document.getElementById('copyNotification');
            notification.classList.remove('hidden');
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 3000);
        });
    };

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

    // Add print button functionality (optional)
    window.printArticle = function() {
        window.print();
    };
});
</script>
@endpush