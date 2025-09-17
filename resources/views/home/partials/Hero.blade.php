{{-- ===== HERO SECTION CAROUSEL - DINÁMICO Y ELEGANTE (ALPINE.JS v3) ===== --}}
@if(isset($heroSections) && $heroSections->count() > 0)
<section 
    x-data="{ 
        activeSlide: 1, 
        slides: {{ $heroSections->count() }},
        intervalTime: 8000, // 8 segundos por slide
        autoplay: null,
        progress: 0,
        
        startAutoplay() {
            // Reinicia y comienza la barra de progreso
            this.progress = 0;
            setTimeout(() => { this.progress = 100; }, 50); // Pequeño delay para que la transición CSS se active

            // Inicia el intervalo para cambiar de slide
            this.autoplay = setInterval(() => {
                this.nextSlide();
            }, this.intervalTime);
        },
        stopAutoplay() {
            clearInterval(this.autoplay);
            this.autoplay = null;
        },
        // Cambia al siguiente slide y reinicia el autoplay
        nextSlide() {
            this.activeSlide = this.activeSlide === this.slides ? 1 : this.activeSlide + 1;
            this.resetAutoplay();
        },
        // Cambia al slide anterior y reinicia el autoplay
        prevSlide() {
            this.activeSlide = this.activeSlide === 1 ? this.slides : this.activeSlide - 1;
            this.resetAutoplay();
        },
        // Selecciona un slide específico y reinicia el autoplay
        selectSlide(index) {
            this.activeSlide = index;
            this.resetAutoplay();
        },
        // Función para limpiar el intervalo y reiniciarlo
        resetAutoplay() {
            this.stopAutoplay();
            this.startAutoplay();
        }
    }"
    x-init="startAutoplay()"
    @mouseenter="stopAutoplay()"
    @mouseleave="if (!autoplay) startAutoplay()"
    class="relative h-[75vh] min-h-[450px] max-h-[650px] w-full overflow-hidden text-white flex items-center">

    <!-- Contenedor de Imágenes de Fondo (Slides) -->
    <div class="absolute inset-0 z-0">
        @foreach($heroSections as $index => $section)
            <div x-show="activeSlide === {{ $index + 1 }}" 
                 x-transition:enter="transition ease-in-out duration-1000" 
                 x-transition:enter-start="opacity-0 scale-105" 
                 x-transition:enter-end="opacity-100 scale-100" 
                 x-transition:leave="transition ease-in-out duration-700" 
                 x-transition:leave-start="opacity-100 scale-100" 
                 x-transition:leave-end="opacity-0 scale-105"
                 class="absolute inset-0"
                 style="display: none;"> {{-- Evita el flash de contenido al cargar --}}
                <img src="{{ asset('storage/' . $section->image) }}"
                     alt="{{ $section->title ?? 'Cuidado visual profesional' }}"
                     class="w-full h-full object-cover"
                     loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
            </div>
        @endforeach
    </div>

    <!-- Overlay de Degradado para Legibilidad -->
    <div class="absolute inset-0 z-10 bg-gradient-to-r from-black/60 via-black/40 to-transparent"></div>

    <!-- Contenedor de Contenido -->
    <div class="relative z-20 container mx-auto px-6 lg:px-8 w-full">
        <div class="max-w-xl text-left min-h-[280px] relative">
            @foreach($heroSections as $index => $section)
                <div x-show="activeSlide === {{ $index + 1 }}" 
                     x-transition:enter="transition ease-out duration-1000 delay-200"
                     x-transition:enter-start="opacity-0 transform translate-y-5"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     x-transition:leave="transition ease-in duration-300 absolute"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="w-full"
                     style="display: none;">
                    
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl md:text-6xl">
                        {{ $section->title ?? 'Visión que define tu estilo' }}
                    </h1>
                    
                    <p class="mt-6 text-lg leading-8 text-gray-200">
                        {{ $section->subtitle ?? 'Salud visual y últimas tendencias en monturas.' }}
                    </p>
                    
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ $section->data['link'] ?? '#' }}"
                           class="rounded-md bg-[#B91C1C] px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#991B1B] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#B91C1C] transition-colors duration-300">
                           {{ $section->data['button_text'] ?? 'Agendar una Cita' }}
                        </a>
                        @if(isset($section->data['secondary_link']) && isset($section->data['secondary_button_text']))
                        <a href="{{ $section->data['secondary_link'] }}" class="text-sm font-semibold leading-6 text-white hover:text-gray-300 transition-colors duration-300">
                            {{ $section->data['secondary_button_text'] }} <span aria-hidden="true">→</span>
                        </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Controles y Barra de Progreso -->
    <div class="absolute bottom-0 left-0 w-full z-30">
        <div class="container mx-auto px-6 lg:px-8 flex justify-between items-center py-4">
            <!-- Paginación (Dots) -->
            <div class="flex space-x-3">
                @foreach($heroSections as $index => $section)
                    <button @click="selectSlide({{ $index + 1 }})" 
                            class="h-2 w-6 rounded-full transition-colors" 
                            :class="activeSlide === {{ $index + 1 }} ? 'bg-white' : 'bg-white/40 hover:bg-white/70'"></button>
                @endforeach
            </div>

            <!-- Controles de Navegación -->
            <div class="flex items-center space-x-2">
                <button @click="prevSlide()" aria-label="Anterior" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button @click="nextSlide()" aria-label="Siguiente" class="p-2 rounded-full bg-white/10 hover:bg-white/20 transition-colors backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>
        
        <!-- Barra de Progreso de Autoplay -->
        <div class="w-full h-1 bg-white/20">
            <div class="h-1 bg-[#B91C1C]" 
                 :style="`transition: width ${intervalTime}ms linear; width: ${progress}%`">
            </div>
        </div>
    </div>

</section>
@else
{{-- Fallback por si no hay hero sections definidas --}}
<section class="relative h-96 bg-gray-800 flex items-center justify-center text-white">
    <div class="text-center">
        <h1 class="text-4xl font-bold">Bienvenido a Grupo Romero</h1>
        <p class="mt-4 text-lg">Configura la sección principal desde el panel de administración.</p>
    </div>
</section>
@endif