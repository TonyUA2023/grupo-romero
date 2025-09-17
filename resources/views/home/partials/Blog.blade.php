{{-- ===== SECCIÓN BLOG - DISEÑO ELEGANTE CORPORATIVO ===== --}}
<section class="py-20 lg:py-24 bg-white relative overflow-hidden">
    
    {{-- Elementos decorativos sutiles --}}
    <div class="absolute top-20 right-20 w-32 h-32 bg-red-100 rounded-full opacity-30 blur-2xl"></div>
    <div class="absolute bottom-20 left-20 w-40 h-40 bg-blue-100 rounded-full opacity-25 blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado de la sección --}}
        <div class="text-center mb-16">
            {{-- Badge superior --}}
            <div class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-full mb-6 border border-blue-100">
                <svg class="w-4 h-4 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <span class="text-blue-600 text-sm font-semibold uppercase tracking-wide">Nuestro Blog</span>
            </div>
            
            {{-- Título principal --}}
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Consejos & 
                <span class="text-red-600 relative">
                    Artículos
                    <div class="absolute -bottom-2 left-0 right-0 h-1 bg-red-600 rounded-full"></div>
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Mantente informado con las últimas tendencias y consejos de salud visual de nuestros especialistas
            </p>
        </div>

        @if($latestPosts->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                {{-- Artículo destacado - Columna izquierda --}}
                @php $featuredPost = $latestPosts->first(); @endphp
                <article class="lg:col-span-8 blog-animate">
                    <div class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl overflow-hidden transition-all duration-500 border border-gray-100">
                        
                        {{-- Imagen principal destacada --}}
                        <div class="relative h-80 lg:h-96 overflow-hidden">
                            <img src="{{ $featuredPost->featured_image ? asset('storage/' . $featuredPost->featured_image) : 'https://via.placeholder.com/800x600' }}" 
                                 alt="{{ $featuredPost->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            {{-- Overlay sutil --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            {{-- Badge destacado --}}
                            <div class="absolute top-6 left-6">
                                <div class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <span>Destacado</span>
                                </div>
                            </div>
                            
                            {{-- Información flotante en hover --}}
                            <div class="absolute bottom-6 left-6 right-6 transform translate-y-6 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <div class="bg-white/95 backdrop-blur-sm rounded-xl p-4">
                                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold">
                                            {{ $featuredPost->category ?? 'General' }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $featuredPost->published_at->format('d M, Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            5 min lectura
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Contenido del artículo --}}
                        <div class="p-8">
                            <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight group-hover:text-red-600 transition-colors duration-300">
                                {{ $featuredPost->title }}
                            </h3>
                            
                            <p class="text-gray-600 text-lg mb-6 leading-relaxed line-clamp-3">
                                {{ $featuredPost->excerpt }}
                            </p>
                            
                            {{-- Meta información --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-green-600 text-sm font-medium">Artículo reciente</span>
                                </div>
                                
                                <a href="{{ route('blogs.show', $featuredPost->slug) }}" 
                                   class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                                    <span>Leer completo</span>
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Artículos secundarios - Columna derecha --}}
                <div class="lg:col-span-4 space-y-6">
                    @foreach($latestPosts->skip(1)->take(3) as $index => $post)
                    <article class="group bg-white rounded-2xl shadow-lg hover:shadow-xl overflow-hidden transition-all duration-300 border border-gray-100 blog-card-animate" style="animation-delay: {{ ($index + 1) * 0.15 }}s;">
                        
                        {{-- Imagen del artículo --}}
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/400x300' }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            {{-- Overlay con categoría --}}
                            <div class="absolute top-4 left-4">
                                <span class="bg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $post->category ?? 'General' }}
                                </span>
                            </div>
                            
                            {{-- Indicador de lectura --}}
                            <div class="absolute bottom-4 right-4">
                                <div class="bg-white/90 backdrop-blur-sm rounded-full p-2">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Contenido del artículo --}}
                        <div class="p-6">
                            {{-- Meta información --}}
                            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $post->published_at->format('d M, Y') }}</span>
                                <span>•</span>
                                <span>3 min</span>
                            </div>
                            
                            {{-- Título --}}
                            <h3 class="text-lg font-bold text-gray-900 mb-3 leading-tight group-hover:text-{{ $index % 2 == 0 ? 'blue' : 'red' }}-600 transition-colors duration-300 line-clamp-2">
                                {{ $post->title }}
                            </h3>
                            
                            {{-- Extracto --}}
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $post->excerpt }}
                            </p>
                            
                            {{-- Link de lectura --}}
                            <a href="{{ route('blogs.show', $post->slug) }}" 
                               class="inline-flex items-center text-{{ $index % 2 == 0 ? 'blue' : 'red' }}-600 hover:text-{{ $index % 2 == 0 ? 'blue' : 'red' }}-700 font-medium text-sm group transition-colors">
                                <span>Leer más</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            {{-- CTA para ver todos los artículos --}}
            <div class="text-center mt-16">
                <a href="{{ route('blogs.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <span>Ver todos los artículos</span>
                    <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

        @else
            {{-- Estado vacío --}}
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-2xl mb-6">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Próximamente</h3>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Estamos preparando contenido valioso sobre salud visual y las últimas tendencias en optometría.
                </p>
                <a href="/contacto" 
                   class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
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
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

/* Efectos hover específicos */
.group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
}

.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

.group:hover .group-hover\:translate-x-1 {
    transform: translateX(0.25rem);
}

/* Sombras personalizadas */
.shadow-blog-custom {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Efectos de cristal */
.backdrop-blur-sm {
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}

/* Transiciones suaves específicas para blog */
.blog-animate *, .blog-card-animate * {
    transition-property: transform, opacity, background-color, border-color, color, box-shadow;
    transition-duration: 300ms;
    transition-timing-function: ease-in-out;
}

/* Efectos específicos para las cards */
.blog-card-animate:hover {
    transform: translateY(-4px);
}

/* Animación de pulso personalizada */
@keyframes blog-pulse {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.8;
        transform: scale(1.05);
    }
}

.animate-pulse {
    animation: blog-pulse 2s infinite;
}
</style>

{{-- JavaScript específico para blog --}}
<script>
// JavaScript encapsulado para la sección de blog
(function() {
    'use strict';
    
    function initBlogSection() {
        // Intersection Observer para animaciones
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observar elementos animados
        const animatedElements = document.querySelectorAll('.blog-animate, .blog-card-animate');
        animatedElements.forEach(el => {
            observer.observe(el);
        });

        // Efecto parallax sutil para elementos decorativos
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const blogSection = document.querySelector('section[class*="bg-white"]');
            if (blogSection) {
                const decorativeElements = blogSection.querySelectorAll('.absolute[class*="bg-red"], .absolute[class*="bg-blue"]');
                
                decorativeElements.forEach((el, index) => {
                    const rate = scrolled * -0.2 * (index + 1);
                    el.style.transform = `translateY(${rate}px)`;
                });
            }
        });

        // Smooth hover effects para cards de blog
        const blogCards = document.querySelectorAll('.blog-card-animate');
        blogCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px) scale(1.01)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        console.log('Sección de blog inicializada correctamente');
    }

    // Inicializar cuando esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBlogSection);
    } else {
        initBlogSection();
    }
})();
</script>