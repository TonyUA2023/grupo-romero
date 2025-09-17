{{-- ===== SECCIÓN TOUR VIRTUAL - DISEÑO ELEGANTE CORPORATIVO ===== --}}
<section id="video-tour-local" class="py-20 lg:py-24 bg-gray-50 relative overflow-hidden">
    
    {{-- Elementos decorativos sutiles --}}
    <div class="absolute top-20 left-20 w-32 h-32 bg-blue-100 rounded-full opacity-30 blur-2xl"></div>
    <div class="absolute bottom-20 right-20 w-40 h-40 bg-red-100 rounded-full opacity-25 blur-3xl"></div>
    
    @if($presentationVideo)
        @php
            // Decodificar el JSON de datos adicionales
            $additionalData = [];
            if (!empty($presentationVideo->data)) {
                // Primera decodificación para quitar las comillas externas
                $decodedOnce = json_decode($presentationVideo->data, true);
                
                // Si el resultado es una cadena, decodificamos nuevamente
                if (is_string($decodedOnce)) {
                    $additionalData = json_decode($decodedOnce, true);
                } else {
                    $additionalData = $decodedOnce;
                }
                
                // Asegurarnos de que sea un array
                if (!is_array($additionalData)) {
                    $additionalData = [];
                }
            }
            
            // Extraer el ID del video de YouTube
            $videoUrl = $presentationVideo->content ?? '';
            $videoId = '';
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $videoUrl, $matches)) {
                $videoId = $matches[1];
            } else {
                // Si no es una URL completa, asumimos que es solo el ID
                $videoId = basename(parse_url($videoUrl, PHP_URL_PATH));
            }
        @endphp
    @endif
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado de la sección --}}
        <div class="text-center mb-16">
            {{-- Badge superior --}}
            <div class="inline-flex items-center px-4 py-2 bg-red-50 rounded-full mb-6 border border-red-100">
                <svg class="w-4 h-4 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <span class="text-red-600 text-sm font-semibold uppercase tracking-wide">Nuestras Instalaciones</span>
            </div>
            
            {{-- Título principal --}}
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Tour Virtual 
                <span class="text-blue-600 relative">
                    360°
                    <div class="absolute -bottom-2 left-0 right-0 h-1 bg-blue-600 rounded-full"></div>
                </span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Descubre nuestras modernas instalaciones y tecnología de vanguardia desde la comodidad de tu hogar
            </p>
        </div>

        @if($presentationVideo && !empty($videoId))
            {{-- Video principal del tour --}}
            <div class="mb-16 tour-animate">
                <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                    
                    {{-- Contenedor del video --}}
                    <div class="relative">
                        <div class="aspect-video bg-gray-900">
                            <iframe 
                                class="w-full h-full lazy-video"
                                data-src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1&autoplay=0" 
                                title="Tour Virtual - {{ $presentationVideo->title }}"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                                loading="lazy">
                            </iframe>
                        </div>
                        
                        {{-- Badge de tour virtual --}}
                        <div class="absolute top-6 left-6">
                            <div class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                                <span>Tour Virtual</span>
                            </div>
                        </div>
                        
                        {{-- Controles adicionales --}}
                        <div class="absolute top-6 right-6">
                            <button class="bg-white/20 backdrop-blur-sm text-white p-2 rounded-full hover:bg-white/30 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    {{-- Información del video --}}
                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                            
                            {{-- Información textual --}}
                            <div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">
                                    {{ $presentationVideo->title }}
                                </h3>
                                <p class="text-gray-600 text-lg mb-6 leading-relaxed">
                                    {{ $presentationVideo->subtitle }}
                                </p>
                                
                                {{-- Características destacadas --}}
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-600 rounded-full"></div>
                                        <span class="text-gray-700">Tecnología de última generación</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-red-600 rounded-full"></div>
                                        <span class="text-gray-700">Espacios amplios y modernos</span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-green-600 rounded-full"></div>
                                        <span class="text-gray-700">Ambiente cómodo y relajante</span>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Estadísticas desde JSON --}}
                            <div class="grid grid-cols-2 gap-6">
                                @if(count($additionalData) > 0)
                                    @foreach(array_slice($additionalData, 0, 4) as $index => $stat)
                                        @php
                                            $statTitle = $stat['title'] ?? '';
                                            $statSubtitle = $stat['subtitle'] ?? $stat['subtittle'] ?? '';
                                        @endphp
                                        
                                        @if(!empty($statTitle))
                                            <div class="text-center p-4 bg-{{ $index % 2 == 0 ? 'blue' : 'red' }}-50 rounded-xl border border-{{ $index % 2 == 0 ? 'blue' : 'red' }}-100">
                                                <div class="text-2xl lg:text-3xl font-bold text-{{ $index % 2 == 0 ? 'blue' : 'red' }}-600 mb-1">
                                                    {{ $statTitle }}
                                                </div>
                                                <div class="text-sm text-{{ $index % 2 == 0 ? 'blue' : 'red' }}-700 font-medium">
                                                    {{ $statSubtitle }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    {{-- Estadísticas por defecto --}}
                                    <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                                        <div class="text-2xl lg:text-3xl font-bold text-blue-600 mb-1">15+</div>
                                        <div class="text-sm text-blue-700 font-medium">Años de Experiencia</div>
                                    </div>
                                    <div class="text-center p-4 bg-red-50 rounded-xl border border-red-100">
                                        <div class="text-2xl lg:text-3xl font-bold text-red-600 mb-1">5000+</div>
                                        <div class="text-sm text-red-700 font-medium">Pacientes Atendidos</div>
                                    </div>
                                    <div class="text-center p-4 bg-blue-50 rounded-xl border border-blue-100">
                                        <div class="text-2xl lg:text-3xl font-bold text-blue-600 mb-1">98%</div>
                                        <div class="text-sm text-blue-700 font-medium">Satisfacción</div>
                                    </div>
                                    <div class="text-center p-4 bg-red-50 rounded-xl border border-red-100">
                                        <div class="text-2xl lg:text-3xl font-bold text-red-600 mb-1">24/7</div>
                                        <div class="text-sm text-red-700 font-medium">Atención</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($presentationVideo)
            {{-- Estado cuando hay datos pero no video válido --}}
            <div class="mb-16 tour-animate">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-200">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-2xl mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $presentationVideo->title }}</h3>
                    <p class="text-xl text-gray-600 mb-8">{{ $presentationVideo->subtitle }}</p>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <p class="text-blue-700">El tour virtual estará disponible próximamente</p>
                    </div>
                </div>
            </div>

        @else
            {{-- Estado cuando no hay video de presentación --}}
            <div class="mb-16 tour-animate">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-200">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-2xl mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tour Virtual 360°</h3>
                    <p class="text-xl text-gray-600 mb-8">
                        Estamos preparando una experiencia inmersiva para que puedas conocer nuestras instalaciones desde casa.
                    </p>
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                        <p class="text-blue-700 font-medium">¡Próximamente disponible!</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Grid de características adicionales --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 tour-feature-animate" style="animation-delay: 0.1s;">
                <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m0 0h2M7 7h10M7 10h10M7 13h10M7 16h10"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Áreas Especializadas</h3>
                <p class="text-gray-600">Consultorios equipados con la más avanzada tecnología optométrica.</p>
            </div>
            
            <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 tour-feature-animate" style="animation-delay: 0.2s;">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Ambiente Relajante</h3>
                <p class="text-gray-600">Espacios diseñados para tu comodidad y tranquilidad durante la consulta.</p>
            </div>
            
            <div class="group bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 tour-feature-animate" style="animation-delay: 0.3s;">
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Protocolos de Seguridad</h3>
                <p class="text-gray-600">Cumplimos con los más altos estándares de higiene y seguridad.</p>
            </div>
        </div>

        {{-- CTA final --}}
        <div class="text-center">
            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 inline-block">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">¿Listo para visitarnos?</h3>
                <p class="text-gray-600 mb-6 max-w-md">
                    Agenda tu cita y descubre por qué somos la mejor opción para tu salud visual.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contacto" 
                       class="inline-flex items-center px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg group">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Visítanos en Persona</span>
                        <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    
                    <a href="/servicios" 
                       class="inline-flex items-center px-8 py-4 border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold rounded-xl transition-all duration-300 group">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Conocer Servicios</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Estilos CSS específicos --}}
<style>
/* Animaciones para la sección de tour */
@keyframes tour-fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.tour-animate {
    animation: tour-fade-in-up 0.8s ease-out forwards;
    opacity: 0;
}

.tour-feature-animate {
    animation: tour-fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}

/* Efectos hover específicos */
.group:hover .group-hover\:scale-110 {
    transform: scale(1.1);
}

.group:hover .group-hover\:translate-x-1 {
    transform: translateX(0.25rem);
}

/* Lazy loading para videos */
.lazy-video {
    transition: opacity 0.3s ease;
}

/* Efectos de cristal */
.backdrop-blur-sm {
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
}

/* Transiciones suaves específicas para tour */
.tour-animate *, .tour-feature-animate * {
    transition-property: transform, opacity, background-color, border-color, color, box-shadow;
    transition-duration: 300ms;
    transition-timing-function: ease-in-out;
}

/* Efectos específicos para las feature cards */
.tour-feature-animate:hover {
    transform: translateY(-4px);
}

/* Sombras personalizadas */
.shadow-tour-custom {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}
</style>

{{-- JavaScript específico para tour --}}
<script>
// JavaScript encapsulado para la sección de tour
(function() {
    'use strict';
    
    function initTourSection() {
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
        const animatedElements = document.querySelectorAll('.tour-animate, .tour-feature-animate');
        animatedElements.forEach(el => {
            observer.observe(el);
        });

        // Lazy loading para videos
        const lazyVideos = document.querySelectorAll('.lazy-video');
        
        const videoObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const video = entry.target;
                    const src = video.getAttribute('data-src');
                    if (src) {
                        video.setAttribute('src', src);
                        video.removeAttribute('data-src');
                        videoObserver.unobserve(video);
                    }
                }
            });
        });
        
        lazyVideos.forEach(video => {
            videoObserver.observe(video);
        });

        // Efecto parallax sutil para elementos decorativos
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const tourSection = document.querySelector('#video-tour-local');
            if (tourSection) {
                const decorativeElements = tourSection.querySelectorAll('.absolute[class*="bg-blue"], .absolute[class*="bg-red"]');
                
                decorativeElements.forEach((el, index) => {
                    const rate = scrolled * -0.2 * (index + 1);
                    el.style.transform = `translateY(${rate}px)`;
                });
            }
        });

        // Smooth hover effects para feature cards
        const featureCards = document.querySelectorAll('.tour-feature-animate');
        featureCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px) scale(1.01)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        console.log('Sección de tour virtual inicializada correctamente');
    }

    // Función para manejar clics en CTAs
    function trackCTA(action) {
        console.log('CTA clicked:', action);
        // Aquí puedes agregar tracking de analytics
    }

    // Inicializar cuando esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTourSection);
    } else {
        initTourSection();
    }
})();
</script>