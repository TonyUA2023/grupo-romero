{{-- Sección de Videos Testimonios - Elegante Rojo y Azul Sin Degradados --}}
<section class="w-full py-16 lg:py-24 bg-gray-50 relative overflow-hidden">
    
    {{-- Elementos decorativos de fondo con colores sólidos --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-red-100 rounded-full blur-3xl opacity-30 animate-float-slow"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-blue-100 rounded-full blur-2xl opacity-30 animate-float-reverse"></div>
    <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-red-50 rounded-full blur-xl opacity-20 transform -translate-x-1/2 -translate-y-1/2"></div>
    
    {{-- Patrón de formas geométricas --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 right-32 w-4 h-4 bg-red-500 rounded-full animate-pulse"></div>
        <div class="absolute top-40 right-64 w-2 h-2 bg-blue-500 rounded-full animate-pulse delay-100"></div>
        <div class="absolute bottom-32 left-32 w-6 h-6 bg-red-600 rounded-full animate-pulse delay-200"></div>
        <div class="absolute bottom-56 left-64 w-3 h-3 bg-blue-600 rounded-full animate-pulse delay-300"></div>
        <div class="absolute top-60 left-20 w-2 h-2 bg-red-400 rounded-full animate-pulse delay-75"></div>
        <div class="absolute top-80 right-20 w-1 h-1 bg-blue-400 rounded-full animate-pulse delay-150"></div>
    </div>
    
    <div class="w-full px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado elegante --}}
        <div class="text-center mb-16 lg:mb-20 video-testimonials-header-animate">
            {{-- Badge superior elegante --}}
            <div class="inline-flex items-center px-8 py-4 bg-white border-2 border-red-200 rounded-full mb-8 shadow-lg hover:shadow-xl transition-all duration-300">
                <svg class="w-6 h-6 text-red-600 mr-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <span class="text-red-600 font-bold uppercase tracking-wider text-sm">Videos Testimonios</span>
            </div>
            
            {{-- Título principal elegante --}}
            <h2 class="text-4xl md:text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                <span class="text-gray-900 font-light">Historias</span>
                <br>
                <span class="text-blue-600 relative">
                    Reales
                    <div class="absolute -bottom-2 left-0 right-0 h-1 bg-red-500 rounded-full"></div>
                </span>
            </h2>
            
            <p class="text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed mb-8">
                Escucha directamente de nuestros pacientes cómo hemos transformado su visión y su vida
            </p>
            
            {{-- Línea decorativa con colores alternos --}}
            <div class="flex justify-center items-center space-x-2">
                <div class="w-8 h-1 bg-red-500 rounded-full"></div>
                <div class="w-16 h-1 bg-blue-500 rounded-full"></div>
                <div class="w-8 h-1 bg-red-500 rounded-full"></div>
            </div>
        </div>

        {{-- Contenedor responsivo de videos --}}
        <div class="relative w-full">
            
            {{-- Grid para desktop (lg y superiores) --}}
            <div class="hidden lg:grid lg:grid-cols-3 gap-8 xl:gap-10 max-w-7xl mx-auto">
                @foreach($testimonialVideos as $index => $testimonial)
                    <div class="video-testimonial-card group" style="animation-delay: {{ $index * 0.15 }}s;">
                        <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl border-2 border-gray-100 hover:border-red-200 transition-all duration-500 transform hover:-translate-y-3 hover:scale-[1.02]">
                            {{-- Contenedor del video --}}
                            <div class="relative aspect-video bg-gray-100 overflow-hidden">
                                <iframe 
                                    src="{{ $testimonial->link }}" 
                                    title="Testimonio de {{ $testimonial->name }}"
                                    class="w-full h-full object-cover"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                    allowfullscreen
                                    loading="lazy">
                                </iframe>
                                
                                {{-- Overlay elegante --}}
                                <div class="absolute inset-0 bg-blue-900 opacity-0 group-hover:opacity-20 transition-opacity duration-500 pointer-events-none"></div>
                                
                                {{-- Icono de play decorativo --}}
                                <div class="absolute top-4 right-4 w-12 h-12 bg-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:scale-110 shadow-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                                
                                {{-- Borde de acento en hover --}}
                                <div class="absolute top-0 left-0 right-0 h-1 bg-red-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                            </div>
                            
                            {{-- Información del testimonio --}}
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        {{-- Avatar elegante --}}
                                        <div class="w-14 h-14 bg-red-500 rounded-full flex items-center justify-center shadow-lg border-2 border-red-100">
                                            <span class="text-white font-bold text-lg">
                                                {{ strtoupper(substr($testimonial->name, 0, 1) . (str_contains($testimonial->name, ' ') ? substr($testimonial->name, strpos($testimonial->name, ' ') + 1, 1) : '')) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h3 class="text-gray-900 font-bold text-lg">{{ $testimonial->name }}</h3>
                                            <p class="text-blue-600 text-sm font-medium">{{ $testimonial->position ?? 'Paciente Satisfecho' }}</p>
                                        </div>
                                    </div>
                                    
                                    {{-- Estrellas de calificación --}}
                                    <div class="flex items-center space-x-1">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                
                                {{-- Contenido del testimonio --}}
                                <p class="text-gray-600 leading-relaxed mb-6 border-l-4 border-blue-200 pl-4">
                                    {{ Str::limit($testimonial->content, 120) }}
                                </p>
                                
                                {{-- Tags decorativos --}}
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-4 py-2 bg-red-50 text-red-700 text-xs rounded-full font-semibold border border-red-200">
                                        Video Testimonio
                                    </span>
                                    @if($testimonial->verified ?? false)
                                        <span class="px-4 py-2 bg-blue-50 text-blue-700 text-xs rounded-full font-semibold border border-blue-200">
                                            Verificado
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Línea decorativa inferior --}}
                            <div class="h-2 bg-gray-50 flex">
                                <div class="flex-1 bg-red-200"></div>
                                <div class="flex-1 bg-blue-200"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Carrusel para tablets y móviles --}}
            <div class="lg:hidden relative">
                
                {{-- Contenedor del carrusel --}}
                <div class="video-carousel-container relative overflow-hidden">
                    <div class="video-carousel-track flex transition-transform duration-700 ease-out" id="videoCarouselTrack">
                        @foreach($testimonialVideos as $index => $testimonial)
                            <div class="video-carousel-slide flex-none w-full sm:w-4/5 md:w-3/5 px-4">
                                <div class="video-testimonial-card group">
                                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border-2 border-gray-100 hover:border-red-200 transition-all duration-500 transform hover:-translate-y-2">
                                        {{-- Contenedor del video --}}
                                        <div class="relative aspect-video bg-gray-100 overflow-hidden">
                                            <iframe 
                                                src="{{ $testimonial->link }}" 
                                                title="Testimonio de {{ $testimonial->name }}"
                                                class="w-full h-full"
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                allowfullscreen
                                                loading="lazy">
                                            </iframe>
                                            
                                            {{-- Overlay --}}
                                            <div class="absolute inset-0 bg-blue-900 opacity-0 group-hover:opacity-20 transition-opacity duration-300 pointer-events-none"></div>
                                            
                                            {{-- Borde superior --}}
                                            <div class="absolute top-0 left-0 right-0 h-1 bg-red-500"></div>
                                        </div>
                                        
                                        {{-- Información del testimonio --}}
                                        <div class="p-6">
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center space-x-3">
                                                    {{-- Avatar --}}
                                                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center shadow-lg">
                                                        <span class="text-white font-bold text-sm">
                                                            {{ strtoupper(substr($testimonial->name, 0, 1) . (str_contains($testimonial->name, ' ') ? substr($testimonial->name, strpos($testimonial->name, ' ') + 1, 1) : '')) }}
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-gray-900 font-bold">{{ $testimonial->name }}</h3>
                                                        <p class="text-blue-600 text-sm">{{ $testimonial->position ?? 'Paciente' }}</p>
                                                    </div>
                                                </div>
                                                
                                                {{-- Estrellas --}}
                                                <div class="flex items-center">
                                                    @for($i = 0; $i < min(5, $testimonial->rating); $i++)
                                                        <svg class="w-4 h-4 text-yellow-400 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                            
                                            <p class="text-gray-600 text-sm leading-relaxed mb-4 border-l-4 border-blue-200 pl-3">
                                                {{ Str::limit($testimonial->content, 100) }}
                                            </p>
                                            
                                            {{-- Tag --}}
                                            <span class="inline-block px-3 py-1 bg-red-50 text-red-700 text-xs rounded-full font-semibold border border-red-200">
                                                Video Testimonio
                                            </span>
                                        </div>
                                        
                                        {{-- Línea decorativa inferior --}}
                                        <div class="h-2 bg-gray-50 flex">
                                            <div class="flex-1 bg-red-200"></div>
                                            <div class="flex-1 bg-blue-200"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Navegación del carrusel --}}
                <button class="video-carousel-btn video-prev absolute left-2 top-1/2 -translate-y-1/2 z-20 w-14 h-14 bg-white hover:bg-red-50 border-2 border-red-200 hover:border-red-400 rounded-full flex items-center justify-center transition-all duration-300 group shadow-xl hover:shadow-2xl" onclick="prevVideoTestimonial()">
                    <svg class="w-6 h-6 text-red-600 transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <button class="video-carousel-btn video-next absolute right-2 top-1/2 -translate-y-1/2 z-20 w-14 h-14 bg-white hover:bg-blue-50 border-2 border-blue-200 hover:border-blue-400 rounded-full flex items-center justify-center transition-all duration-300 group shadow-xl hover:shadow-2xl" onclick="nextVideoTestimonial()">
                    <svg class="w-6 h-6 text-blue-600 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>

                {{-- Indicadores del carrusel --}}
                <div class="flex justify-center mt-10 space-x-3" id="videoCarouselDots">
                    {{-- Los dots se generan dinámicamente con JavaScript --}}
                </div>
            </div>

            {{-- Botón CTA principal --}}
            @if($testimonialVideos->count() > 0)
                <div class="text-center mt-16 lg:mt-20">
                    <a href="{{ route('testimonials.index') ?? '#' }}" 
                       class="inline-flex items-center px-10 py-4 bg-red-600 hover:bg-red-700 text-white font-bold text-lg rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 hover:-translate-y-1 group border-2 border-red-700">
                        
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <span>Ver más testimonios en video</span>
                        <svg class="w-6 h-6 ml-3 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                        
                        {{-- Acento azul en el botón --}}
                        <div class="absolute bottom-0 left-0 w-full h-1 bg-blue-500 rounded-b-2xl"></div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- Estilos CSS --}}
<style>
/* Animaciones personalizadas */
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-25px) rotate(180deg); }
}

@keyframes float-reverse {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(25px) rotate(-180deg); }
}

@keyframes video-fade-in-up {
    from { opacity: 0; transform: translateY(60px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Aplicar animaciones */
.animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
.animate-float-reverse { animation: float-reverse 10s ease-in-out infinite; }

.video-testimonials-header-animate { animation: video-fade-in-up 1s ease-out forwards; }
.video-testimonial-card { 
    animation: video-fade-in-up 0.8s ease-out forwards; 
    opacity: 0;
}

/* Carrusel de videos */
.video-carousel-container {
    position: relative;
    width: 100%;
}

.video-carousel-track {
    display: flex;
    transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.video-carousel-slide {
    flex: 0 0 auto;
}

/* Navegación del carrusel */
.video-carousel-btn {
    transition: all 0.3s ease;
}

.video-carousel-btn:hover {
    transform: scale(1.1);
}

/* Dots del carrusel con colores alternos */
.video-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.4s ease;
    border: 2px solid transparent;
}

.video-dot:nth-child(odd) {
    background-color: #ef4444; /* red-500 */
    opacity: 0.3;
}

.video-dot:nth-child(even) {
    background-color: #3b82f6; /* blue-500 */
    opacity: 0.3;
}

.video-dot.active {
    opacity: 1;
    transform: scale(1.3);
    border-color: white;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

.video-dot:hover {
    opacity: 0.7;
    transform: scale(1.1);
}

/* Efectos especiales para videos */
.video-testimonial-card .bg-white {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.video-testimonial-card:hover .bg-white {
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .video-carousel-slide {
        width: 100% !important;
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
}

@media (min-width: 641px) and (max-width: 768px) {
    .video-carousel-slide {
        width: 80% !important;
    }
}

@media (min-width: 769px) and (max-width: 1023px) {
    .video-carousel-slide {
        width: 60% !important;
    }
}

/* Efectos adicionales */
.shadow-3xl {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}

/* Iframe optimizations */
iframe {
    border-radius: 0;
    transition: all 0.3s ease;
}

.group:hover iframe {
    transform: scale(1.02);
}

/* Líneas decorativas */
.border-l-4 {
    border-left-width: 4px;
}

/* Botón CTA con posición relativa para el acento */
.group {
    position: relative;
}
</style>

{{-- JavaScript mejorado --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Iniciando sección de videos testimonios...');
    
    // Variables del carrusel de videos
    let currentVideoSlide = 0;
    let totalVideoSlides = 0;
    let videoSlidesPerView = 1;
    let videoAutoplayInterval;
    let videoCarouselTrack;
    let videoCarouselDots;
    
    // Inicializar carrusel de videos
    function initVideoCarousel() {
        videoCarouselTrack = document.getElementById('videoCarouselTrack');
        videoCarouselDots = document.getElementById('videoCarouselDots');
        
        if (!videoCarouselTrack) return;
        
        const slides = videoCarouselTrack.querySelectorAll('.video-carousel-slide');
        totalVideoSlides = slides.length;
        
        if (totalVideoSlides === 0) return;
        
        // Calcular slides por vista según el ancho de pantalla
        updateVideoSlidesPerView();
        
        // Crear dots
        createVideoDots();
        
        // Configurar autoplay
        startVideoAutoplay();
        
        // Event listeners para resize
        window.addEventListener('resize', () => {
            updateVideoSlidesPerView();
            updateVideoCarouselPosition();
        });
        
        console.log(`Carrusel de videos inicializado: ${totalVideoSlides} slides`);
    }
    
    function updateVideoSlidesPerView() {
        const width = window.innerWidth;
        if (width < 640) {
            videoSlidesPerView = 1;
        } else if (width < 768) {
            videoSlidesPerView = 1.25;
        } else if (width < 1024) {
            videoSlidesPerView = 1.67;
        } else {
            videoSlidesPerView = 1;
        }
    }
    
    function createVideoDots() {
        if (!videoCarouselDots) return;
        
        const maxSlide = Math.ceil(totalVideoSlides / videoSlidesPerView);
        videoCarouselDots.innerHTML = '';
        
        for (let i = 0; i < Math.min(maxSlide, totalVideoSlides); i++) {
            const dot = document.createElement('div');
            dot.className = `video-dot ${i === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToVideoSlide(i));
            videoCarouselDots.appendChild(dot);
        }
    }
    
    function updateVideoCarouselPosition() {
        if (!videoCarouselTrack) return;
        
        const slideWidth = 100 / videoSlidesPerView;
        const translateX = -(currentVideoSlide * slideWidth);
        videoCarouselTrack.style.transform = `translateX(${translateX}%)`;
        
        // Actualizar dots
        const dots = videoCarouselDots?.querySelectorAll('.video-dot');
        dots?.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentVideoSlide);
        });
    }
    
    function goToVideoSlide(slideIndex) {
        const maxSlide = Math.min(totalVideoSlides - 1, Math.ceil(totalVideoSlides / videoSlidesPerView) - 1);
        currentVideoSlide = Math.max(0, Math.min(slideIndex, maxSlide));
        updateVideoCarouselPosition();
    }
    
    function nextVideoTestimonial() {
        const maxSlide = totalVideoSlides - 1;
        if (currentVideoSlide < maxSlide) {
            currentVideoSlide++;
        } else {
            currentVideoSlide = 0;
        }
        updateVideoCarouselPosition();
        restartVideoAutoplay();
    }
    
    function prevVideoTestimonial() {
        const maxSlide = totalVideoSlides - 1;
        if (currentVideoSlide > 0) {
            currentVideoSlide--;
        } else {
            currentVideoSlide = maxSlide;
        }
        updateVideoCarouselPosition();
        restartVideoAutoplay();
    }
    
    function startVideoAutoplay() {
        if (totalVideoSlides <= 1) return;
        
        videoAutoplayInterval = setInterval(() => {
            nextVideoTestimonial();
        }, 7000);
    }
    
    function stopVideoAutoplay() {
        if (videoAutoplayInterval) {
            clearInterval(videoAutoplayInterval);
            videoAutoplayInterval = null;
        }
    }
    
    function restartVideoAutoplay() {
        stopVideoAutoplay();
        startVideoAutoplay();
    }
    
    // Pausar autoplay en hover
    const videoCarouselContainer = document.querySelector('.video-carousel-container');
    if (videoCarouselContainer) {
        videoCarouselContainer.addEventListener('mouseenter', stopVideoAutoplay);
        videoCarouselContainer.addEventListener('mouseleave', startVideoAutoplay);
    }

    // Exponer funciones globalmente
    window.nextVideoTestimonial = nextVideoTestimonial;
    window.prevVideoTestimonial = prevVideoTestimonial;

    // Lazy loading de videos
    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const iframe = entry.target;
                const src = iframe.getAttribute('src');
                
                if (src && !src.includes('autoplay=1')) {
                    iframe.setAttribute('src', src);
                }
                
                videoObserver.unobserve(iframe);
            }
        });
    }, {
        rootMargin: '100px'
    });
    
    // Observar iframes
    const iframes = document.querySelectorAll('iframe');
    iframes.forEach(iframe => {
        videoObserver.observe(iframe);
    });
    
    // Intersection Observer para animaciones
    const observerOptions = {
        threshold: 0.2,
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
    const animatedElements = document.querySelectorAll('.video-testimonial-card');
    animatedElements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.15}s`;
        observer.observe(el);
    });
    
    // Inicializar carrusel
    initVideoCarousel();
    
    console.log('Sección de videos testimonios inicializada correctamente');
});
</script>