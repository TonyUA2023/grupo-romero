{{-- ===== SECCIÓN EQUIPO PROFESIONAL - DISEÑO ELEGANTE CON FONDO ROJO ===== --}}
<section class="relative py-20 lg:py-24 bg-gradient-to-br from-red-600 via-red-700 to-red-800 overflow-hidden">
    
    {{-- Elementos decorativos elegantes --}}
    <div class="absolute top-0 right-0 w-80 h-80 bg-white/10 rounded-full blur-3xl opacity-30"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-600/20 rounded-full blur-2xl opacity-40"></div>
    <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
    
    {{-- Patrón de puntos decorativo --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 right-20 w-2 h-2 bg-white rounded-full"></div>
        <div class="absolute top-40 right-40 w-1 h-1 bg-white rounded-full"></div>
        <div class="absolute bottom-20 left-20 w-2 h-2 bg-white rounded-full"></div>
        <div class="absolute bottom-40 left-40 w-1 h-1 bg-white rounded-full"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado de la sección --}}
        <div class="text-center mb-16">
            {{-- Badge superior --}}
            <div class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full mb-6 border border-white/30">
                <svg class="w-4 h-4 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <span class="text-white text-sm font-semibold uppercase tracking-wide">Nuestro Equipo</span>
            </div>
            
            {{-- Título principal --}}
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Profesionales 
                <span class="relative inline-block">
                    <span class="bg-gradient-to-r from-blue-200 to-blue-100 bg-clip-text text-transparent">Expertos</span>
                    <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 to-blue-300 rounded-full"></div>
                </span>
            </h2>
            <p class="text-xl text-red-100 max-w-3xl mx-auto leading-relaxed">
                Un equipo altamente calificado comprometido con tu bienestar visual y dedicado a brindarte la mejor atención
            </p>
        </div>

        {{-- Grid de miembros del equipo --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($team as $index => $member)
            <div class="group team-card-animate" style="animation-delay: {{ $index * 0.15 }}s;">
                {{-- Card con borde elegante --}}
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-2xl hover:shadow-team-custom transition-all duration-500 border-2 border-white/20 hover:border-white/40 backdrop-blur-sm transform hover:-translate-y-2">
                    
                    {{-- Borde interior decorativo --}}
                    <div class="absolute inset-0 rounded-2xl border-2 border-gradient-team-{{ $index % 2 == 0 ? 'red' : 'blue' }} pointer-events-none"></div>
                    
                    {{-- Contenedor de imagen --}}
                    <div class="relative h-72 overflow-hidden bg-gray-50">
                        <img src="{{ $member->image ? asset('storage/' . $member->image) : 'https://via.placeholder.com/400x500' }}" 
                             alt="{{ $member->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        
                        {{-- Overlay sutil en hover --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-red-600/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        {{-- Indicador de especialista --}}
                        <div class="absolute top-4 right-4">
                            <div class="w-10 h-10 bg-{{ $index % 2 == 0 ? 'red' : 'blue' }}-600 rounded-full flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Información flotante en hover --}}
                        <div class="absolute bottom-4 left-4 right-4 transform translate-y-8 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <div class="bg-white/95 backdrop-blur-sm rounded-xl p-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                    <span class="text-green-600 text-xs font-semibold">Disponible para consultas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Información del miembro --}}
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $member->name }}</h3>
                        <p class="text-gray-600 font-medium mb-4">{{ $member->position }}</p>
                        
                        {{-- Especialidades como badges --}}
                        <div class="flex justify-center space-x-1 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-{{ $index % 2 == 0 ? 'red' : 'blue' }}-50 text-{{ $index % 2 == 0 ? 'red' : 'blue' }}-700 border border-{{ $index % 2 == 0 ? 'red' : 'blue' }}-200">
                                Especialista Visual
                            </span>
                        </div>
                        
                        {{-- Años de experiencia --}}
                        <div class="flex items-center justify-center text-gray-500 text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                            <span>Profesional Certificado</span>
                        </div>
                    </div>
                    
                    {{-- Efecto de shine en hover --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                        <div class="absolute top-0 -left-full h-full w-1/2 bg-gradient-to-r from-transparent via-white/10 to-transparent transform rotate-12 group-hover:team-shine-animation"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA Section elegante --}}
        <div class="mt-20 text-center">
            <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 lg:p-12 border border-white/20">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl lg:text-3xl font-bold text-white mb-4">
                    ¿Necesitas una Consulta Especializada?
                </h3>
                <p class="text-red-100 text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                    Nuestro equipo de profesionales está listo para brindarte la mejor atención personalizada. 
                    Agenda tu cita y recibe el cuidado visual que mereces.
                </p>
                
                {{-- Botones de acción --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contact" 
                       class="inline-flex items-center px-8 py-4 bg-white text-red-600 font-semibold rounded-xl hover:bg-gray-50 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl group">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Agendar Cita</span>
                        <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    
                    <a href="/servicios" 
                       class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-red-600 transition-all duration-300 group">
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

<style>
/* Animaciones específicas para esta sección */
@keyframes team-fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes team-shine {
    0% {
        transform: translateX(-100%) rotate(12deg);
    }
    100% {
        transform: translateX(300%) rotate(12deg);
    }
}

.team-card-animate {
    animation: team-fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}

.team-shine-animation {
    animation: team-shine 1.5s ease-out;
}

/* Sombra personalizada para las cards del equipo */
.shadow-team-custom {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}

/* Gradientes de borde personalizados */
.border-gradient-team-red {
    background: linear-gradient(to bottom right, rgba(239, 68, 68, 0.3), transparent, rgba(59, 130, 246, 0.3));
}

.border-gradient-team-blue {
    background: linear-gradient(to bottom right, rgba(59, 130, 246, 0.3), transparent, rgba(239, 68, 68, 0.3));
}

/* Mejora del contraste en texto sobre fondo rojo */
.text-red-100 {
    color: rgba(254, 226, 226, 0.95);
}

/* Efectos específicos para esta sección */
.team-card-animate:hover {
    transform: translateY(-8px) scale(1.02);
}

/* Animación de pulso personalizada */
@keyframes team-pulse {
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
    animation: team-pulse 2s infinite;
}
</style>

<script>
// JavaScript específico para la sección de equipo
(function() {
    'use strict';
    
    function initTeamSection() {
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
                    
                    // Activar efecto shine después de que aparezca el elemento
                    setTimeout(() => {
                        const shineDiv = entry.target.querySelector('.group-hover\\:team-shine-animation');
                        if (shineDiv) {
                            shineDiv.style.animation = 'team-shine 1.5s ease-out';
                        }
                    }, 500);
                }
            });
        }, observerOptions);

        // Observar elementos con animación
        const animatedElements = document.querySelectorAll('.team-card-animate');
        animatedElements.forEach(el => {
            observer.observe(el);
        });

        // Efecto parallax sutil para elementos decorativos (solo en esta sección)
        const teamSection = document.querySelector('section[class*="from-red-600"]');
        if (teamSection) {
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const decorativeElements = teamSection.querySelectorAll('.absolute[class*="bg-white"]');
                
                decorativeElements.forEach((el, index) => {
                    const rate = scrolled * -0.3 * (index + 1);
                    el.style.transform = `translateY(${rate}px)`;
                });
            });
        }

        // Smooth hover effects específicos para cards de equipo
        const teamCards = document.querySelectorAll('.team-card-animate .group');
        teamCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        console.log('Sección de equipo inicializada correctamente');
    }

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTeamSection);
    } else {
        initTeamSection();
    }
})();
</script>