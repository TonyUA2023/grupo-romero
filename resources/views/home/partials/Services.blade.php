{{-- ===== SECCIÓN SERVICIOS - ESTILO CORPORATIVO LAURENT ===== --}}
<section id="servicios" class="py-16 lg:py-24 bg-white relative overflow-hidden">
    
    {{-- Elementos decorativos sutiles (Colores Corporativos) --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-60 -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-50 rounded-full blur-3xl opacity-60 translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        {{-- Encabezado de la sección --}}
        <div class="text-center mb-20">
            {{-- Badge superior --}}
            <div class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-full mb-4 border border-blue-100">
                <span class="flex h-2 w-2 relative mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
                <span class="text-primary text-xs font-bold uppercase tracking-widest">Excelencia Médica</span>
            </div>
            
            {{-- Título principal --}}
            <h2 class="text-4xl md:text-5xl font-bold text-dark mb-6">
                Servicios <span class="text-primary relative inline-block">
                    Especializados
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-accent opacity-40" viewBox="0 0 100 10" preserveAspectRatio="none">
                        <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="3" fill="none" />
                    </svg>
                </span>
            </h2>
            <p class="text-lg text-dark/70 max-w-2xl mx-auto font-light">
                Combinamos experiencia clínica con tecnología de última generación para garantizar tu salud visual integral.
            </p>
        </div>

        {{-- Grid de servicios --}}
        <div class="space-y-20">
            @foreach($servicesSections as $index => $section)
            <div class="group animate-on-scroll opacity-0 translate-y-8 transition-all duration-700 ease-out">
                {{-- Layout alternado --}}
                <div class="flex flex-col {{ $index % 2 == 1 ? 'lg:flex-row-reverse' : 'lg:flex-row' }} gap-8 lg:gap-16 items-center">
                    
                    {{-- Imagen del servicio --}}
                    <div class="w-full lg:w-1/2 relative">
                        <div class="relative rounded-2xl overflow-hidden shadow-xl aspect-[4/3] group-hover:shadow-2xl transition-all duration-500">
                            <img src="{{ $section->image ? asset('storage/' . $section->image) : 'https://via.placeholder.com/800x600' }}"
                                 alt="{{ $section->title }}"
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                            
                            {{-- Overlay Gradiente --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/30 to-transparent opacity-60"></div>
                            
                            {{-- Badge de número --}}
                            <div class="absolute top-6 left-6">
                                <div class="w-12 h-12 bg-white/90 backdrop-blur text-primary rounded-xl flex items-center justify-center font-bold text-xl shadow-lg border border-white">
                                    {{ sprintf('%02d', $index + 1) }}
                                </div>
                            </div>
                            
                            {{-- Indicador Premium (Si aplica) --}}
                            @if($section->price)
                                <div class="absolute top-6 right-6">
                                    <div class="bg-accent text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-lg tracking-wide">
                                        PREMIUM
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Elemento decorativo detrás --}}
                        <div class="absolute -z-10 top-10 {{ $index % 2 == 1 ? '-right-10' : '-left-10' }} w-full h-full border-2 border-primary/10 rounded-2xl"></div>
                    </div>
                    
                    {{-- Contenido del servicio --}}
                    <div class="w-full lg:w-1/2">
                        <h3 class="text-3xl font-bold text-dark mb-4 group-hover:text-primary transition-colors duration-300">
                            {{ $section->title }}
                        </h3>
                        
                        <p class="text-dark/70 text-lg mb-8 leading-relaxed">
                            {{ $section->subtitle }}
                        </p>
                        
                        {{-- Precio (Diseño Elevado) --}}
                        @if($section->price)
                            <div class="flex items-center gap-4 mb-8 p-4 bg-light rounded-xl border border-gray-100">
                                <div class="bg-white p-3 rounded-full shadow-sm text-primary">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-dark/50 uppercase tracking-wider font-semibold">Inversión desde</p>
                                    <p class="text-2xl font-bold text-accent">{{ $section->price }}</p>
                                </div>
                            </div>
                        @endif
                        
                        {{-- Características (Lista limpia) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 mb-8">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-primary"></i>
                                <span class="text-sm text-dark/80 font-medium">Atención personalizada</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-primary"></i>
                                <span class="text-sm text-dark/80 font-medium">Tecnología avanzada</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-primary"></i>
                                <span class="text-sm text-dark/80 font-medium">Especialistas certificados</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-check-circle text-primary"></i>
                                <span class="text-sm text-dark/80 font-medium">Garantía de satisfacción</span>
                            </div>
                        </div>
                        
                        {{-- Botones de acción --}}
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="/contacto?servicio={{ urlencode($section->title) }}" 
                               class="inline-flex justify-center items-center px-8 py-3 bg-primary text-white font-semibold rounded-full hover:bg-primary-dark transition-all duration-300 shadow-lg hover:shadow-primary/30 transform hover:-translate-y-1">
                                <span>Agendar Cita</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                            
                            <a href="/servicios/{{ Str::slug($section->title) }}" 
                               class="inline-flex justify-center items-center px-8 py-3 border-2 border-dark/10 text-dark font-semibold rounded-full hover:border-primary hover:text-primary transition-all duration-300 bg-transparent">
                                <span>Más detalles</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Separador sutil entre items (excepto el último) --}}
            @if(!$loop->last)
                <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent max-w-4xl mx-auto"></div>
            @endif
            
            @endforeach
        </div>

        {{-- CTA final elegante --}}
        <div class="mt-24 relative rounded-3xl overflow-hidden">
            <div class="absolute inset-0 bg-primary"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark to-primary opacity-90"></div>
            {{-- Patrón de fondo --}}
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
            
            <div class="relative z-10 p-10 md:p-16 text-center">
                <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">¿Necesitas una consulta especializada?</h3>
                <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">
                    Nuestro equipo médico está listo para brindarte el mejor diagnóstico y tratamiento. Tu visión es nuestra prioridad.
                </p>
                <a href="/contacto" 
                   class="inline-flex items-center px-8 py-4 bg-white text-primary font-bold rounded-full hover:bg-gray-100 transition-all duration-300 shadow-xl hover:shadow-white/20 transform hover:scale-105">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>Reservar mi Consulta Ahora</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- JavaScript para animación simple al hacer scroll --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-8');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>