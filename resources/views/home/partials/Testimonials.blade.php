{{-- Sección de Testimonios Rediseñada --}}
<section class="w-full py-16 lg:py-24 bg-gradient-to-br from-purple-900 via-blue-900 to-teal-900 text-white overflow-hidden relative">
    
    {{-- Elementos decorativos de fondo mejorados --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-purple-500/30 to-blue-500/20 rounded-full blur-3xl animate-float-slow"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-gradient-to-tl from-blue-500/20 to-teal-500/30 rounded-full blur-2xl animate-float-reverse"></div>
    <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-gradient-to-r from-teal-500/10 to-purple-500/10 rounded-full blur-xl transform -translate-x-1/2 -translate-y-1/2"></div>
    
    {{-- Patrón de estrellas decorativas --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 right-32 w-2 h-2 bg-white rounded-full animate-pulse"></div>
        <div class="absolute top-40 right-64 w-1 h-1 bg-yellow-300 rounded-full animate-pulse delay-100"></div>
        <div class="absolute bottom-32 left-32 w-3 h-3 bg-white rounded-full animate-pulse delay-200"></div>
        <div class="absolute bottom-56 left-64 w-1.5 h-1.5 bg-blue-300 rounded-full animate-pulse delay-300"></div>
        <div class="absolute top-60 left-20 w-2 h-2 bg-purple-300 rounded-full animate-pulse delay-75"></div>
        <div class="absolute top-80 right-20 w-1 h-1 bg-teal-300 rounded-full animate-pulse delay-150"></div>
    </div>
    
    <div class="w-full px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado espectacular --}}
        <div class="text-center mb-16 lg:mb-20 testimonials-header-animate">
            {{-- Badge superior elegante --}}
            <div class="inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-lg rounded-full mb-8 shadow-2xl border border-white/20 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400/20 to-blue-400/20 rounded-full animate-pulse-gentle"></div>
                <svg class="w-6 h-6 text-yellow-400 mr-3 relative z-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                <span class="text-white font-bold uppercase tracking-wider text-sm relative z-10">Testimonios Reales</span>
            </div>
            
            {{-- Título principal impactante --}}
            <h2 class="text-4xl md:text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                <span class="bg-gradient-to-r from-white via-blue-100 to-purple-100 bg-clip-text text-transparent">
                    Experiencias
                </span>
                <br>
                <span class="text-white relative">
                    Extraordinarias
                    <div class="absolute -bottom-3 left-0 right-0 h-1 bg-gradient-to-r from-purple-400 via-blue-400 to-teal-400 rounded-full transform scale-x-0 animate-scale-x"></div>
                </span>
            </h2>
            
            <p class="text-xl lg:text-2xl text-white/80 max-w-4xl mx-auto leading-relaxed mb-8">
                La satisfacción de nuestros pacientes es nuestra mejor carta de presentación. Descubre lo que dicen sobre nosotros.
            </p>
        </div>

        @if($testimonials->count() > 0)
            {{-- Contenedor del carrusel de testimonios --}}
            <div class="relative w-full">
                
                {{-- Grid para desktop (lg y superiores) --}}
                <div class="hidden lg:grid lg:grid-cols-3 gap-8 xl:gap-10 max-w-7xl mx-auto">
                    @foreach($testimonials->take(3) as $index => $testimonial)
                        <div class="testimonial-card group" style="animation-delay: {{ $index * 0.2 }}s;">
                            <div class="bg-white/10 backdrop-blur-lg p-8 h-full rounded-3xl border border-white/20 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 hover:bg-white/15">
                                {{-- Estrellas de calificación --}}
                                <div class="flex mb-6 justify-center">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-6 h-6 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-500' }} mx-1 transform hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    @endfor
                                </div>
                                
                                {{-- Comillas decorativas --}}
                                <div class="text-center mb-6">
                                    <svg class="w-12 h-12 text-white/30 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
                                    </svg>
                                </div>
                                
                                {{-- Contenido del testimonio --}}
                                <blockquote class="text-white/90 mb-8 text-lg leading-relaxed text-center italic font-light">
                                    "{{ $testimonial->content }}"
                                </blockquote>
                                
                                {{-- Información del autor --}}
                                <div class="flex items-center justify-center mt-auto pt-6 border-t border-white/20">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                             alt="{{ $testimonial->name }}" 
                                             class="w-16 h-16 rounded-full object-cover mr-4 border-3 border-white/40 shadow-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center mr-4 border-3 border-white/40 shadow-lg">
                                            <span class="text-white font-bold text-xl">{{ substr($testimonial->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="text-center">
                                        <h4 class="text-white font-semibold text-lg">{{ $testimonial->name }}</h4>
                                        <p class="text-white/70 text-sm font-medium">{{ $testimonial->position ?? 'Paciente Satisfecho' }}</p>
                                    </div>
                                </div>
                                
                                {{-- Efecto de brillo en hover --}}
                                <div class="absolute inset-0 bg-gradient-to-tr from-white/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Carrusel para tablets y móviles --}}
                <div class="lg:hidden relative">
                    
                    {{-- Contenedor del carrusel --}}
                    <div class="testimonial-carousel-container relative overflow-hidden">
                        <div class="testimonial-carousel-track flex transition-transform duration-700 ease-out" id="testimonialTrack">
                            @foreach($testimonials as $index => $testimonial)
                                <div class="testimonial-carousel-slide flex-none w-full sm:w-4/5 md:w-3/5 px-4">
                                    <div class="testimonial-card">
                                        <div class="bg-white/10 backdrop-blur-lg p-8 h-full rounded-3xl border border-white/20 shadow-2xl">
                                            {{-- Estrellas de calificación --}}
                                            <div class="flex mb-6 justify-center">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg class="w-5 h-5 {{ $i < $testimonial->rating ? 'text-yellow-400' : 'text-gray-500' }} mx-0.5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                    </svg>
                                                @endfor
                                            </div>
                                            
                                            {{-- Comillas decorativas --}}
                                            <div class="text-center mb-6">
                                                <svg class="w-10 h-10 text-white/30 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
                                                </svg>
                                            </div>
                                            
                                            {{-- Contenido del testimonio --}}
                                            <blockquote class="text-white/90 mb-8 text-base sm:text-lg leading-relaxed text-center italic font-light min-h-[120px] flex items-center">
                                                "{{ $testimonial->content }}"
                                            </blockquote>
                                            
                                            {{-- Información del autor --}}
                                            <div class="flex items-center justify-center pt-6 border-t border-white/20">
                                                @if($testimonial->image)
                                                    <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                                         alt="{{ $testimonial->name }}" 
                                                         class="w-14 h-14 rounded-full object-cover mr-4 border-2 border-white/40 shadow-lg">
                                                @else
                                                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center mr-4 border-2 border-white/40 shadow-lg">
                                                        <span class="text-white font-bold text-lg">{{ substr($testimonial->name, 0, 1) }}</span>
                                                    </div>
                                                @endif
                                                
                                                <div class="text-center">
                                                    <h4 class="text-white font-semibold">{{ $testimonial->name }}</h4>
                                                    <p class="text-white/70 text-sm font-medium">{{ $testimonial->position ?? 'Paciente Satisfecho' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Navegación del carrusel --}}
                    <button class="testimonial-carousel-btn testimonial-prev absolute left-2 top-1/2 -translate-y-1/2 z-20 w-14 h-14 bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/30 rounded-full flex items-center justify-center transition-all duration-300 group shadow-xl" onclick="prevTestimonial()">
                        <svg class="w-6 h-6 text-white group-hover:text-white transform group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    
                    <button class="testimonial-carousel-btn testimonial-next absolute right-2 top-1/2 -translate-y-1/2 z-20 w-14 h-14 bg-white/10 hover:bg-white/20 backdrop-blur-lg border border-white/30 rounded-full flex items-center justify-center transition-all duration-300 group shadow-xl" onclick="nextTestimonial()">
                        <svg class="w-6 h-6 text-white group-hover:text-white transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    {{-- Indicadores del carrusel --}}
                    <div class="flex justify-center mt-10 space-x-3" id="testimonialDots">
                        {{-- Los dots se generan dinámicamente con JavaScript --}}
                    </div>
                </div>

                {{-- Mostrar más testimonios (solo desktop) --}}
                @if($testimonials->count() > 3)
                    <div class="hidden lg:flex justify-center mt-16">
                        <button class="inline-flex items-center px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-lg text-white font-semibold rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:scale-105 border border-white/20">
                            <span>Ver Más Testimonios</span>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        @else
            {{-- Estado vacío elegante --}}
            <div class="text-center py-20 lg:py-32">
                <div class="max-w-lg mx-auto">
                    <svg class="w-24 h-24 text-white/30 mx-auto mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-2xl font-bold text-white mb-4">Próximamente</h3>
                    <p class="text-white/70 text-lg leading-relaxed">
                        Estamos recopilando las experiencias extraordinarias de nuestros pacientes para compartirlas contigo.
                    </p>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- Estilos CSS --}}
<style>
/* Animaciones personalizadas */
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(180deg); }
}

@keyframes float-reverse {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(30px) rotate(-180deg); }
}

@keyframes scale-x {
    from { transform: scaleX(0); }
    to { transform: scaleX(1); }
}

@keyframes pulse-gentle {
    0%, 100% { transform: scale(1); opacity: 0.2; }
    50% { transform: scale(1.1); opacity: 0.4; }
}

@keyframes testimonial-fade-in-up {
    from { opacity: 0; transform: translateY(60px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Aplicar animaciones */
.animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
.animate-float-reverse { animation: float-reverse 10s ease-in-out infinite; }
.animate-scale-x { animation: scale-x 1s ease-out 0.5s forwards; }
.animate-pulse-gentle { animation: pulse-gentle 3s ease-in-out infinite; }

.testimonials-header-animate { animation: testimonial-fade-in-up 1s ease-out forwards; }
.testimonial-card { 
    animation: testimonial-fade-in-up 0.8s ease-out forwards; 
    opacity: 0;
}

/* Carrusel de testimonios */
.testimonial-carousel-container {
    position: relative;
    width: 100%;
}

.testimonial-carousel-track {
    display: flex;
    transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.testimonial-carousel-slide {
    flex: 0 0 auto;
}

/* Navegación del carrusel */
.testimonial-carousel-btn {
    transition: all 0.3s ease;
    backdrop-filter: blur(20px);
}

.testimonial-carousel-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

/* Dots del carrusel */
.testimonial-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.3);
    cursor: pointer;
    transition: all 0.4s ease;
    border: 2px solid transparent;
}

.testimonial-dot.active {
    background-color: white;
    transform: scale(1.3);
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
}

.testimonial-dot:hover {
    background-color: rgba(255, 255, 255, 0.6);
    transform: scale(1.1);
}

/* Efectos especiales */
.testimonial-card .bg-white\/10 {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.testimonial-card:hover .bg-white\/10 {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .testimonial-carousel-slide {
        width: 100% !important;
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
}

@media (min-width: 641px) and (max-width: 768px) {
    .testimonial-carousel-slide {
        width: 80% !important;
    }
}

@media (min-width: 769px) and (max-width: 1023px) {
    .testimonial-carousel-slide {
        width: 60% !important;
    }
}

/* Mejoras visuales adicionales */
.border-3 {
    border-width: 3px;
}

.shadow-3xl {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}

/* Glassmorphism effect */
.backdrop-blur-lg {
    backdrop-filter: blur(16px);
}
</style>

{{-- JavaScript mejorado --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Iniciando sección de testimonios...');
    
    // Variables del carrusel de testimonios
    let currentTestimonialSlide = 0;
    let totalTestimonialSlides = 0;
    let testimonialSlidesPerView = 1;
    let testimonialAutoplayInterval;
    let testimonialTrack;
    let testimonialDots;
    
    // Inicializar carrusel de testimonios
    function initTestimonialCarousel() {
        testimonialTrack = document.getElementById('testimonialTrack');
        testimonialDots = document.getElementById('testimonialDots');
        
        if (!testimonialTrack) return;
        
        const slides = testimonialTrack.querySelectorAll('.testimonial-carousel-slide');
        totalTestimonialSlides = slides.length;
        
        if (totalTestimonialSlides === 0) return;
        
        // Calcular slides por vista según el ancho de pantalla
        updateTestimonialSlidesPerView();
        
        // Crear dots
        createTestimonialDots();
        
        // Configurar autoplay
        startTestimonialAutoplay();
        
        // Event listeners para resize
        window.addEventListener('resize', () => {
            updateTestimonialSlidesPerView();
            updateTestimonialCarouselPosition();
        });
        
        console.log(`Carrusel de testimonios inicializado: ${totalTestimonialSlides} slides`);
    }
    
    function updateTestimonialSlidesPerView() {
        const width = window.innerWidth;
        if (width < 640) {
            testimonialSlidesPerView = 1;
        } else if (width < 768) {
            testimonialSlidesPerView = 1.25; // Mostrar parte del siguiente
        } else if (width < 1024) {
            testimonialSlidesPerView = 1.67; // Mostrar más del siguiente
        } else {
            testimonialSlidesPerView = 1; // En desktop no se usa carrusel
        }
    }
    
    function createTestimonialDots() {
        if (!testimonialDots) return;
        
        const maxSlide = Math.ceil(totalTestimonialSlides / testimonialSlidesPerView);
        testimonialDots.innerHTML = '';
        
        for (let i = 0; i < Math.min(maxSlide, totalTestimonialSlides); i++) {
            const dot = document.createElement('div');
            dot.className = `testimonial-dot ${i === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToTestimonialSlide(i));
            testimonialDots.appendChild(dot);
        }
    }
    
    function updateTestimonialCarouselPosition() {
        if (!testimonialTrack) return;
        
        const slideWidth = 100 / testimonialSlidesPerView;
        const translateX = -(currentTestimonialSlide * slideWidth);
        testimonialTrack.style.transform = `translateX(${translateX}%)`;
        
        // Actualizar dots
        const dots = testimonialDots?.querySelectorAll('.testimonial-dot');
        dots?.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentTestimonialSlide);
        });
    }
    
    function goToTestimonialSlide(slideIndex) {
        const maxSlide = Math.min(totalTestimonialSlides - 1, Math.ceil(totalTestimonialSlides / testimonialSlidesPerView) - 1);
        currentTestimonialSlide = Math.max(0, Math.min(slideIndex, maxSlide));
        updateTestimonialCarouselPosition();
    }
    
    function nextTestimonial() {
        const maxSlide = totalTestimonialSlides - 1;
        if (currentTestimonialSlide < maxSlide) {
            currentTestimonialSlide++;
        } else {
            currentTestimonialSlide = 0; // Loop al inicio
        }
        updateTestimonialCarouselPosition();
        restartTestimonialAutoplay();
    }
    
    function prevTestimonial() {
        const maxSlide = totalTestimonialSlides - 1;
        if (currentTestimonialSlide > 0) {
            currentTestimonialSlide--;
        } else {
            currentTestimonialSlide = maxSlide; // Loop al final
        }
        updateTestimonialCarouselPosition();
        restartTestimonialAutoplay();
    }
    
    function startTestimonialAutoplay() {
        if (totalTestimonialSlides <= 1) return; // No autoplay si hay 1 o menos slides
        
        testimonialAutoplayInterval = setInterval(() => {
            nextTestimonial();
        }, 6000); // Cambiar cada 6 segundos
    }
    
    function stopTestimonialAutoplay() {
        if (testimonialAutoplayInterval) {
            clearInterval(testimonialAutoplayInterval);
            testimonialAutoplayInterval = null;
        }
    }
    
    function restartTestimonialAutoplay() {
        stopTestimonialAutoplay();
        startTestimonialAutoplay();
    }
    
    // Pausar autoplay en hover
    const testimonialCarouselContainer = document.querySelector('.testimonial-carousel-container');
    if (testimonialCarouselContainer) {
        testimonialCarouselContainer.addEventListener('mouseenter', stopTestimonialAutoplay);
        testimonialCarouselContainer.addEventListener('mouseleave', startTestimonialAutoplay);
    }

    // Exponer funciones globalmente para los botones
    window.nextTestimonial = nextTestimonial;
    window.prevTestimonial = prevTestimonial;
    window.goToTestimonial = goToTestimonialSlide;

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
    const animatedElements = document.querySelectorAll('.testimonial-card');
    animatedElements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.2}s`;
        observer.observe(el);
    });
    
    // Inicializar carrusel
    initTestimonialCarousel();
    
    console.log('Sección de testimonios inicializada correctamente');
});
</script>