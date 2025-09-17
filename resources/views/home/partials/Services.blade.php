{{-- ===== SECCIÓN SERVICIOS REDISEÑADA - ESTILO CORPORATIVO ÓPTICA ===== --}}
<section id="servicios" class="py-16 lg:py-20 bg-gradient-to-b from-gray-50 via-white to-red-50/30 relative overflow-hidden">
    
    {{-- Elementos decorativos sutiles --}}
    <div class="absolute -top-20 -right-20 w-40 h-40 bg-red-100 rounded-full opacity-30 -z-10"></div>
    <div class="absolute -bottom-20 -left-20 w-32 h-32 bg-blue-100 rounded-full opacity-30 -z-10"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado de la sección --}}
        <div class="text-center mb-16">
            {{-- Badge superior --}}
            <div class="inline-flex items-center px-4 py-2 bg-red-50 rounded-full mb-6">
                <svg class="w-4 h-4 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 8.172V5L8 4z"></path>
                </svg>
                <span class="text-red-600 text-sm font-semibold uppercase tracking-wide">Nuestros Servicios</span>
            </div>
            
            {{-- Título principal --}}
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                Servicios <span class="text-red-600">Especializados</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Cuidamos tu salud visual con tecnología avanzada y atención personalizada
            </p>
            
            {{-- Línea decorativa --}}
            <div class="w-20 h-1 bg-red-600 mx-auto rounded-full mt-6"></div>
        </div>

        {{-- Grid de servicios --}}
        <div class="space-y-16">
            @foreach($servicesSections as $index => $section)
            <div class="group animate-fade-in-up" style="animation-delay: {{ $index * 0.2 }}s;">
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-500 border border-gray-100">
                    
                    {{-- Layout alternado --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 {{ $index % 2 == 1 ? 'lg:grid-flow-col-dense' : '' }}">
                        
                        {{-- Imagen del servicio --}}
                        <div class="relative h-[350px] lg:h-[450px] overflow-hidden bg-gray-50 {{ $index % 2 == 1 ? 'lg:col-start-2' : '' }}">
                            <img src="{{ $section->image ? asset('storage/' . $section->image) : 'https://via.placeholder.com/800x600' }}"
                                 alt="{{ $section->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            {{-- Overlay sutil --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600/20 via-transparent to-transparent"></div>
                            
                            {{-- Badge de número --}}
                            <div class="absolute top-6 {{ $index % 2 == 0 ? 'left-6' : 'right-6' }}">
                                <div class="w-12 h-12 bg-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                                    {{ sprintf('%02d', $index + 1) }}
                                </div>
                            </div>
                            
                            {{-- Indicador de servicio premium si tiene precio --}}
                            @if($section->price)
                                <div class="absolute bottom-6 {{ $index % 2 == 0 ? 'left-6' : 'right-6' }}">
                                    <div class="bg-amber-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        <span>Premium</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Contenido del servicio --}}
                        <div class="flex flex-col justify-center p-8 lg:p-12 {{ $index % 2 == 1 ? 'lg:col-start-1' : '' }}">
                            
                            {{-- Título del servicio --}}
                            <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                                {{ $section->title }}
                            </h3>
                            
                            {{-- Descripción --}}
                            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                                {{ $section->subtitle }}
                            </p>
                            
                            {{-- Precio si existe --}}
                            @if($section->price)
                                <div class="bg-gray-50 rounded-xl p-4 mb-6">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-sm text-gray-500 uppercase tracking-wide">Precio desde</span>
                                            <div class="flex items-baseline space-x-2">
                                                <span class="text-3xl font-bold text-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600">
                                                    {{ $section->price }}
                                                </span>
                                                <span class="text-gray-500">por consulta</span>
                                            </div>
                                        </div>
                                        <div class="text-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600 opacity-20">
                                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            {{-- Características del servicio --}}
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Atención personalizada</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Tecnología avanzada</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Profesionales expertos</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-sm text-gray-600">Resultados garantizados</span>
                                </div>
                            </div>
                            
                            {{-- Botones de acción --}}
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="/contacto?servicio={{ urlencode($section->title) }}" 
                                   class="flex-1 bg-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600 hover:bg-{{ $index % 2 == 0 ? 'red' : 'blue' }}-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-{{ $index % 2 == 0 ? 'red' : 'blue' }}-300 group inline-flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Agendar Cita</span>
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                                
                                <button class="border-2 border-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600 text-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600 hover:bg-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600 hover:text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-{{ $index % 2 == 0 ? 'red' : 'blue' }}-300 group inline-flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Más información</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA final elegante --}}
        <div class="text-center mt-20 bg-gray-50 rounded-2xl p-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-2xl mb-6">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">¿No encuentras el servicio que buscas?</h3>
            <p class="text-gray-600 text-lg mb-6 max-w-2xl mx-auto">
                Nuestro equipo de especialistas está aquí para ayudarte. Contáctanos para recibir una consulta personalizada.
            </p>
            <a href="/contacto" 
               class="inline-flex items-center px-8 py-4 bg-gray-900 text-white font-semibold rounded-xl hover:bg-gray-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl group">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span>Contáctanos para más información</span>
                <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Estilos CSS adicionales --}}
<style>
/* Animaciones personalizadas */
@keyframes fade-in-up {
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
    animation: fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}

/* Efectos hover mejorados */
.group:hover .group-hover\:scale-105 {
    transform: scale(1.05);
}

.group:hover .group-hover\:translate-x-1 {
    transform: translateX(0.25rem);
}

/* Sombras personalizadas para los cards */
.shadow-custom {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.shadow-custom-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Transición suave para las imágenes */
img {
    transition: transform 0.7s ease;
}

/* Efectos de gradiente en hover para los botones */
.btn-hover-gradient {
    background: linear-gradient(45deg, #dc2626, #2563eb);
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}
</style>

{{-- JavaScript para animaciones en scroll --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    // Observar todos los elementos con animación
    const animatedElements = document.querySelectorAll('.animate-fade-in-up');
    animatedElements.forEach(el => {
        observer.observe(el);
    });

    // Smooth scroll para enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    console.log('Sección de servicios inicializada correctamente');
});
</script>