¿{{-- ===== SECCIÓN BLOG - ESTILO CORPORATIVO LAURENT ===== --}}
<section class="py-20 lg:py-24 bg-light relative overflow-hidden">
    
    {{-- Elementos decorativos sutiles (Colores Corporativos) --}}
    <div class="absolute top-20 right-20 w-64 h-64 bg-accent rounded-full opacity-10 blur-3xl"></div>
    <div class="absolute bottom-20 left-20 w-80 h-80 bg-primary rounded-full opacity-10 blur-3xl"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado de la sección --}}
        <div class="text-center mb-16">
            {{-- Badge superior --}}
            <div class="inline-flex items-center px-4 py-2 bg-white rounded-full mb-6 border border-gray-200 shadow-sm">
                <svg class="w-4 h-4 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <span class="text-primary text-sm font-bold uppercase tracking-wide">Blog de Salud Visual</span>
            </div>
            
            {{-- Título principal --}}
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-dark mb-6 leading-tight">
                Consejos & 
                <span class="text-accent relative inline-block">
                    Actualidad
                    <div class="absolute -bottom-2 left-0 w-full h-1 bg-accent rounded-full opacity-30"></div>
                </span>
            </h2>
            <p class="text-xl text-dark/70 max-w-3xl mx-auto leading-relaxed font-light">
                Descubre las últimas tendencias en cuidado ocular y consejos de nuestros expertos para mantener tu visión saludable.
            </p>
        </div>

        @if($latestPosts->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                
                {{-- Artículo destacado - Columna izquierda --}}
                @php $featuredPost = $latestPosts->first(); @endphp
                <article class="lg:col-span-7 xl:col-span-8 blog-animate">
                    <div class="group relative bg-white rounded-3xl shadow-lg hover:shadow-xl overflow-hidden transition-all duration-500 h-full flex flex-col">
                        
                        {{-- Imagen principal destacada --}}
                        <div class="relative h-72 lg:h-96 overflow-hidden">
                            <img src="{{ $featuredPost->featured_image ? asset('storage/' . $featuredPost->featured_image) : 'https://via.placeholder.com/800x600' }}" 
                                 alt="{{ $featuredPost->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            {{-- Overlay Gradiente --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-dark/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                            
                            {{-- Badge destacado --}}
                            <div class="absolute top-6 left-6">
                                <div class="bg-accent text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-lg uppercase tracking-wider">
                                    Destacado
                                </div>
                            </div>
                        </div>
                        
                        {{-- Contenido del artículo --}}
                        <div class="p-8 lg:p-10 flex flex-col flex-grow relative">
                            {{-- Categoría y Fecha --}}
                            <div class="flex items-center gap-4 mb-4 text-sm">
                                <span class="text-primary font-bold uppercase tracking-wide">{{ $featuredPost->category ?? 'Salud Visual' }}</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span class="text-gray-500">{{ $featuredPost->published_at->format('d M, Y') }}</span>
                            </div>

                            <h3 class="text-2xl lg:text-4xl font-bold text-dark mb-4 leading-tight group-hover:text-primary transition-colors duration-300">
                                <a href="{{ route('blogs.show', $featuredPost->slug) }}">
                                    {{ $featuredPost->title }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 text-lg mb-8 leading-relaxed line-clamp-3 flex-grow">
                                {{ $featuredPost->excerpt }}
                            </p>
                            
                            {{-- Link de lectura --}}
                            <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    5 min de lectura
                                </div>
                                <a href="{{ route('blogs.show', $featuredPost->slug) }}" 
                                   class="inline-flex items-center text-primary font-bold group-hover:text-accent transition-colors">
                                    Leer Artículo
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Artículos secundarios - Columna derecha --}}
                <div class="lg:col-span-5 xl:col-span-4 flex flex-col gap-6">
                    @foreach($latestPosts->skip(1)->take(3) as $index => $post)
                    <article class="group bg-white rounded-2xl shadow-md hover:shadow-lg overflow-hidden transition-all duration-300 flex flex-row h-full blog-card-animate" style="animation-delay: {{ ($index + 1) * 0.15 }}s;">
                        
                        {{-- Imagen pequeña --}}
                        <div class="w-1/3 relative overflow-hidden">
                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/400x300' }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        
                        {{-- Contenido --}}
                        <div class="w-2/3 p-5 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-2 text-xs">
                                    {{-- Categoría en color acento para contraste --}}
                                    <span class="text-accent font-bold uppercase">{{ $post->category ?? 'General' }}</span>
                                </div>
                                <h4 class="text-base font-bold text-dark leading-snug mb-2 group-hover:text-primary transition-colors line-clamp-2">
                                    <a href="{{ route('blogs.show', $post->slug) }}">
                                        {{ $post->title }}
                                    </a>
                                </h4>
                            </div>
                            <div class="text-xs text-gray-400 flex items-center justify-between mt-2">
                                <span>{{ $post->published_at->format('d M, Y') }}</span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    3 min
                                </span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                    
                    {{-- Botón "Ver todos" --}}
                    <a href="{{ route('blogs.index') }}" 
                       class="mt-auto w-full py-4 bg-gray-50 hover:bg-primary hover:text-white text-dark font-semibold rounded-2xl text-center transition-all duration-300 border border-gray-100 hover:border-primary flex items-center justify-center group">
                        <span>Ver todos los artículos</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

        @else
            {{-- Estado vacío --}}
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-gray-100">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-full mb-6">
                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Próximamente</h3>
                <p class="text-xl text-dark/70 mb-8 max-w-2xl mx-auto">
                    Estamos preparando contenido valioso sobre salud visual y las últimas tendencias en optometría.
                </p>
                <a href="/contacto" 
                   class="inline-flex items-center px-8 py-3 bg-primary hover:bg-primary-dark text-white font-bold rounded-full transition-all duration-300 shadow-lg hover:shadow-primary/30 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1v12z"></path>
                    </svg>
                    <span>Suscríbete para recibir novedades</span>
                </a>
            </div>
        @endif
    </div>
</section>

{{-- Estilos CSS específicos --}}
<style>
/* Animaciones para la sección de blog */
@keyframes blog-fade-in-up {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.blog-animate {
    animation: blog-fade-in-up 0.8s ease-out forwards;
    opacity: 0;
}

.blog-card-animate {
    animation: blog-fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}

/* Limitación de líneas para texto */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

{{-- JavaScript específico para blog --}}
<script>
(function() {
    'use strict';
    
    function initBlogSection() {
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        const animatedElements = document.querySelectorAll('.blog-animate, .blog-card-animate');
        animatedElements.forEach(el => {
            observer.observe(el);
        });

        // Efecto Parallax actualizado para usar clases genéricas o nuevas clases
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const blogSection = document.querySelector('section[class*="bg-light"]');
            if (blogSection) {
                const decorativeElements = blogSection.querySelectorAll('.absolute[class*="bg-accent"], .absolute[class*="bg-primary"]');
                
                decorativeElements.forEach((el, index) => {
                    const rate = scrolled * -0.2 * (index + 1);
                    el.style.transform = `translateY(${rate}px)`;
                });
            }
        });

        console.log('Sección de blog inicializada correctamente');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBlogSection);
    } else {
        initBlogSection();
    }
})();
</script>