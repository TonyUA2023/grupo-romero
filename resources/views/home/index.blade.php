@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Salud Visual de Calidad')
@section('description', 'Expertos en salud visual con tecnología de última generación. Exámenes completos, lentes de alta calidad y atención personalizada.')

@section('content')
<style>
    /* Animaciones personalizadas */
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

    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
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

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fade-in-scale {
        animation: fadeInScale 0.8s ease-out forwards;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out forwards;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out forwards;
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    /* Delays para animaciones en cascada */
    .animation-delay-200 { animation-delay: 0.2s; }
    .animation-delay-400 { animation-delay: 0.4s; }
    .animation-delay-600 { animation-delay: 0.6s; }
    .animation-delay-800 { animation-delay: 0.8s; }

    /* Efectos de hover mejorados */
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    /* Glassmorphism effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Gradient text */
    .gradient-text {
        background: linear-gradient(135deg, #3B82F6 0%, #10B981 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Parallax effect */
    .parallax-bg {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    /* Counter animation */
    .counter {
        opacity: 0;
    }
    .counter.visible {
        opacity: 1;
        transition: opacity 0.5s ease;
    }

    /* Scroll reveal elements */
    .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .scroll-reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Image zoom effect */
    .image-zoom {
        overflow: hidden;
    }
    .image-zoom img {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .image-zoom:hover img {
        transform: scale(1.1);
    }

    /* Elegant border animation */
    .border-animate {
        position: relative;
        overflow: hidden;
    }
    .border-animate::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.3), transparent);
        transition: left 0.5s;
    }
    .border-animate:hover::before {
        left: 100%;
    }
</style>

<!-- Hero Section Mejorado -->
<section class="relative min-h-screen overflow-hidden">
    <!-- Imagen de fondo con efecto parallax -->
    @if($heroSection && $heroSection->image)
        <div class="absolute inset-0 z-0 parallax-bg" style="background-image: url('{{ asset('storage/' . $heroSection->image) }}');">
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/50"></div>
        </div>
    @else
        <div class="absolute inset-0 z-0 parallax-bg" style="background-image: url('{{ asset('images/hero-optica.jpg') }}');">
            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/50"></div>
        </div>
    @endif

    <!-- Partículas flotantes decorativas -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-20 left-10 w-20 h-20 bg-blue-500/10 rounded-full animate-float"></div>
        <div class="absolute bottom-20 right-20 w-32 h-32 bg-emerald-500/10 rounded-full animate-float animation-delay-400"></div>
        <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-purple-500/10 rounded-full animate-float animation-delay-800"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center min-h-screen ">
            <div class="text-left text-white space-y-8 max-w-lg lg:max-w-xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-light leading-tight animate-fade-in-up">
                    {{ $heroSection->title ?? 'Descubre la temporada' }}
                    <span class="block font-normal md:text-2xl lg:text-3xl xl:text-4xl mt-10 animate-fade-in-up animation-delay-200">
                        {{ $heroSection->subtitle ?? 'más nueva' }}
                    </span>
                </h1>
                <p class="text-lg md:text-xl lg:text-2xl font-light max-w-md animate-fade-in-up animation-delay-400">
                    {{ $heroSection->content ?? 'Monturas elegantes para cada estilo' }}
                </p>
                <div class="pt-8 animate-fade-in-up animation-delay-800">
                    <a href="#descubre" class="inline-flex items-center text-white/80 hover:text-white transition-colors duration-300 font-light text-sm uppercase tracking-wider group">
                        Comenzar con test de estilo
                        <i class="fas fa-arrow-right ml-3 text-xs transform group-hover:translate-x-2 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Indicador de scroll animado -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-8 h-12 border-2 border-white/50 rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white/50 rounded-full mt-2 animate-float"></div>
        </div>
    </div>
</section>

<!-- Benefits Bar Mejorado -->
<section class="bg-gradient-to-r from-gray-50 to-white py-16 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center group hover-lift scroll-reveal">
                <div class="w-16 h-16 mx-auto bg-gradient-to-br from-blue-50 to-blue-100 rounded-full flex items-center justify-center mb-4 group-hover:from-blue-100 group-hover:to-blue-200 transition-all duration-300 shadow-lg">
                    <i class="fas fa-shipping-fast text-blue-600 text-xl transform group-hover:scale-110 transition-transform"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Envío gratuito</h3>
                <p class="text-gray-600 text-sm font-light">En compras superiores a S/200</p>
            </div>
            
            <div class="text-center group hover-lift scroll-reveal animation-delay-200">
                <div class="w-16 h-16 mx-auto bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-full flex items-center justify-center mb-4 group-hover:from-emerald-100 group-hover:to-emerald-200 transition-all duration-300 shadow-lg">
                    <i class="fas fa-undo text-emerald-600 text-xl transform group-hover:rotate-180 transition-transform"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Devoluciones</h3>
                <p class="text-gray-600 text-sm font-light">30 días para cambios gratuitos</p>
            </div>
            
            <div class="text-center group hover-lift scroll-reveal animation-delay-400">
                <div class="w-16 h-16 mx-auto bg-gradient-to-br from-purple-50 to-purple-100 rounded-full flex items-center justify-center mb-4 group-hover:from-purple-100 group-hover:to-purple-200 transition-all duration-300 shadow-lg">
                    <i class="fas fa-eye text-purple-600 text-xl transform group-hover:scale-110 transition-transform"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Exámenes</h3>
                <p class="text-gray-600 text-sm font-light">Evaluaciones visuales completas</p>
            </div>
            
            <div class="text-center group hover-lift scroll-reveal animation-delay-600">
                <div class="w-16 h-16 mx-auto bg-gradient-to-br from-amber-50 to-amber-100 rounded-full flex items-center justify-center mb-4 group-hover:from-amber-100 group-hover:to-amber-200 transition-all duration-300 shadow-lg">
                    <i class="fas fa-award text-amber-600 text-xl transform group-hover:scale-110 transition-transform"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Garantía</h3>
                <p class="text-gray-600 text-sm font-light">Calidad garantizada por 2 años</p>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Cards Mejorada -->
<section class="pt-16 px-4 md:px-20 pb-20">
    <div class="flex flex-col md:flex-row md:space-x-6 space-y-12 md:space-y-0 justify-center items-start">
        @foreach($cardsSections as $i => $section)
            <div 
                class="rounded-3xl overflow-hidden shadow-2xl bg-cover bg-center w-full md:w-1/3 flex flex-col justify-between min-h-[50rem] hover-lift scroll-reveal image-zoom
                {{ $i == 1 ? 'md:mt-28' : 'md:mt-0' }}"
                style="background-image: url('{{ $section->image ? asset('storage/'.$section->image) : asset('images/card-default.jpg') }}');"
            >
                <div class="p-8 flex-1 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                    <h2 class="text-white text-3xl font-extrabold mb-6 drop-shadow-lg animate-slide-in-left">{{ $section->title }}</h2>
                    @if($section->subtitle)
                        <button class="bg-white text-gray-900 font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 animate-slide-in-right">
                            {{ $section->subtitle }}
                        </button>
                    @else
                        <button class="bg-white text-gray-900 font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 animate-slide-in-right">
                            Ver más
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>


<!-- Services Section Mejorado -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-20 scroll-reveal">
            <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                Nuestros <span class="gradient-text">Servicios</span>
            </h2>
            <div class="w-16 h-px bg-gradient-to-r from-blue-600 to-emerald-600 mx-auto"></div>
        </div>

        <!-- Services -->
        <div class="space-y-0">
            @foreach($servicesSections as $section)
                <div class="group scroll-reveal">
                    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[400px] hover-lift rounded-2xl overflow-hidden shadow-lg">
                        @if($loop->iteration % 2 == 1)
                            <!-- Imagen a la izquierda -->
                            <div class="relative overflow-hidden bg-gray-100 image-zoom">
                                <img src="{{ $section->image ? asset('storage/' . $section->image) : 'ruta/a/imagen/por_defecto.png' }}"
                                     alt="{{ $section->title }}"
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/20 to-transparent group-hover:from-black/30 transition-all duration-300"></div>
                            </div>
                            <div class="flex flex-col justify-center px-12 py-16 bg-white">
                                <h3 class="text-3xl font-light text-gray-900 mb-6 animate-slide-in-right">
                                    {{ $section->title }}
                                </h3>
                                <p class="text-gray-600 font-light text-lg leading-relaxed mb-8 animate-slide-in-right animation-delay-200">
                                    {{ $section->subtitle }}
                                </p>
                                <div class="flex items-center justify-between animate-slide-in-right animation-delay-400">
                                    @if($section->price)
                                        <span class="text-sm text-blue-600 font-light uppercase tracking-wider">
                                            {{ $section->price }}
                                        </span>
                                    @endif
                                    <button class="text-gray-900 hover:text-blue-600 font-light text-sm uppercase tracking-wider transition-colors duration-300 group/btn">
                                        {{ $section->button_text ?? 'Ver más' }} 
                                        <i class="fas fa-arrow-right ml-2 transform group-hover/btn:translate-x-2 transition-transform"></i>
                                    </button>
                                </div>
                            </div>
                        @else
                            <!-- Imagen a la derecha -->
                            <div class="flex flex-col justify-center px-12 py-16 bg-gradient-to-br from-gray-50 to-white order-2 lg:order-1">
                                <h3 class="text-3xl font-light text-gray-900 mb-6 animate-slide-in-left">
                                    {{ $section->title }}
                                </h3>
                                <p class="text-gray-600 font-light text-lg leading-relaxed mb-8 animate-slide-in-left animation-delay-200">
                                    {{ $section->subtitle }}
                                </p>
                                <div class="flex items-center justify-between animate-slide-in-left animation-delay-400">
                                    @if($section->price)
                                        <span class="text-sm text-emerald-600 font-light uppercase tracking-wider">
                                            {{ $section->price }}
                                        </span>
                                    @endif
                                    <button class="text-gray-900 hover:text-emerald-600 font-light text-sm uppercase tracking-wider transition-colors duration-300 group/btn">
                                        {{ $section->button_text ?? 'Ver más' }} 
                                        <i class="fas fa-arrow-right ml-2 transform group-hover/btn:translate-x-2 transition-transform"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="relative overflow-hidden bg-gray-100 order-1 lg:order-2 image-zoom">
                                <img src="{{ $section->image ? asset('storage/' . $section->image) : 'ruta/a/imagen/por_defecto.png' }}"
                                     alt="{{ $section->title }}"
                                     class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-l from-black/20 to-transparent group-hover:from-black/30 transition-all duration-300"></div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Nueva Sección: Nuestro Equipo -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                Nuestro <span class="gradient-text">Equipo</span>
            </h2>
            <p class="text-xl text-gray-600 font-light max-w-2xl mx-auto">
                Profesionales comprometidos con tu salud visual
            </p>
            <div class="w-16 h-px bg-gradient-to-r from-blue-600 to-emerald-600 mx-auto mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($team as $i => $member)
            <div class="group hover-lift scroll-reveal">
                <div class="relative overflow-hidden rounded-2xl shadow-lg">
                    <div class="image-zoom">
                        <img src="https://via.placeholder.com/400x500" alt="Dr. Juan Pérez" class="w-full h-96 object-cover">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            <p class="text-sm font-light mb-2">Especialista en optometría pediátrica con más de 10 años de experiencia</p>
                            <div class="flex space-x-4 mt-4">
                                <a href="#" class="text-white/80 hover:text-white transition-colors"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 text-center">
                    <h3 class="text-2xl font-light text-gray-900 mb-1">{{ $member->name}} </h3>
                    <p class="text-gray-600 font-light">{{ $member->position}}</p>
                </div>
            </div>
            @endforeach
           
        </div>
    </div>
</section>

<!-- Nueva Sección: Nuestro Centro -->
<section class="py-24 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="scroll-reveal">
                <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                    Nuestro Centro de <span class="gradient-text">Atención</span>
                </h2>
                <p class="text-lg text-gray-600 font-light mb-8 leading-relaxed">
                    Contamos con instalaciones modernas y equipamiento de última generación para brindarte 
                    la mejor atención en salud visual. Nuestro centro está diseñado pensando en tu comodidad 
                    y bienestar.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-blue-200 transition-colors">
                            <i class="fas fa-microscope text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-medium text-gray-900 mb-1">Tecnología Avanzada</h3>
                            <p class="text-gray-600 font-light text-sm">Equipos de última generación para diagnósticos precisos</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-emerald-200 transition-colors">
                            <i class="fas fa-couch text-emerald-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-medium text-gray-900 mb-1">Ambiente Confortable</h3>
                            <p class="text-gray-600 font-light text-sm">Espacios diseñados para tu comodidad y tranquilidad</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start group">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-purple-200 transition-colors">
                            <i class="fas fa-clock text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-medium text-gray-900 mb-1">Horario Flexible</h3>
                            <p class="text-gray-600 font-light text-sm">Atención de lunes a sábado con horario extendido</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="#contacto" class="inline-flex items-center bg-blue-600 text-white px-8 py-4 font-light text-sm uppercase tracking-wider hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 group">
                        Agenda tu cita
                        <i class="fas fa-calendar-alt ml-3 transform group-hover:rotate-12 transition-transform"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 scroll-reveal animation-delay-200">
                <div class="space-y-4">
                    <div class="rounded-2xl overflow-hidden shadow-lg hover-lift image-zoom">
                        <img src="https://via.placeholder.com/300x400" alt="Sala de espera" class="w-full h-48 object-cover">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-lg hover-lift image-zoom">
                        <img src="https://via.placeholder.com/300x300" alt="Consultorio" class="w-full h-64 object-cover">
                    </div>
                </div>
                <div class="space-y-4 mt-8">
                    <div class="rounded-2xl overflow-hidden shadow-lg hover-lift image-zoom">
                        <img src="https://via.placeholder.com/300x300" alt="Equipamiento" class="w-full h-64 object-cover">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-lg hover-lift image-zoom">
                        <img src="https://via.placeholder.com/300x400" alt="Área de lentes" class="w-full h-48 object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section Mejorado -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16 scroll-reveal">
            <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                Últimas <span class="gradient-text">Publicaciones</span>
            </h2>
            <p class="text-xl text-gray-600 font-light max-w-2xl mx-auto">
                Consejos y noticias sobre salud visual de nuestros especialistas
            </p>
            <div class="w-16 h-px bg-gradient-to-r from-blue-600 to-emerald-600 mx-auto mt-6"></div>
        </div>

        <!-- Blog Grid Mejorado -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            @if($latestPosts->count() > 0)
                <!-- Post Destacado -->
                @php $featuredPost = $latestPosts->first(); @endphp
                <article class="group bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 flex flex-col h-full hover-lift scroll-reveal">
                    <div class="relative overflow-hidden h-80 w-full image-zoom">
                        <img src="{{ $featuredPost->featured_image ? asset('storage/' . $featuredPost->featured_image) : 'https://via.placeholder.com/1000x400' }}" 
                             alt="{{ $featuredPost->title }}" 
                             class="w-full h-full object-cover object-center">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent group-hover:from-black/60 transition-all duration-300"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-3 py-1 rounded-full text-xs font-light uppercase tracking-wider shadow-lg">
                                Destacado
                            </span>
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-1">
                        <div class="flex items-center mb-4">
                            <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-700 px-3 py-1 rounded-full text-xs font-light uppercase tracking-wider">
                                {{ $featuredPost->category ?? 'Sin categoría' }}
                            </span>
                            <span class="text-gray-400 text-sm ml-4">{{ $featuredPost->published_at->format('d/m/Y') }}</span>
                        </div>
                        <h3 class="text-2xl font-light text-gray-900 mb-4 group-hover:text-blue-600 transition-colors duration-300">
                            {{ $featuredPost->title }}
                        </h3>
                        <p class="text-gray-600 font-light leading-relaxed mb-6">
                            {{ $featuredPost->excerpt }}
                        </p>
                        <div class="flex items-center justify-between mt-auto">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-md">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="text-sm text-gray-600 ml-3 font-light">{{ $featuredPost->author }}</span>
                            </div>
                            <a href="{{ route('blogs.show', $featuredPost->slug) }}" class="text-blue-600 hover:text-blue-800 font-light text-sm uppercase tracking-wider transition-colors duration-300 group/link">
                                Leer más <i class="fas fa-arrow-right ml-2 transform group-hover/link:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- Posts secundarios -->
                <div class="flex flex-col space-y-6 scroll-reveal animation-delay-200">
                    @foreach($latestPosts->skip(1) as $post)
                        <article class="group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex hover-lift">
                            <div class="relative overflow-hidden w-40 h-40 flex-shrink-0 image-zoom">
                                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : 'https://via.placeholder.com/400x400' }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-full object-cover object-center">
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center mb-2">
                                    <span class="bg-gradient-to-r from-emerald-100 to-emerald-200 text-emerald-700 px-2 py-1 rounded-full text-xs font-light uppercase tracking-wider">
                                        {{ $post->category ?? 'Sin categoría' }}
                                    </span>
                                    <span class="text-gray-400 text-xs ml-3">{{ $post->published_at->format('d/m/Y') }}</span>
                                </div>
                                <h4 class="text-lg font-light text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors duration-300">
                                    {{ $post->title }}
                                </h4>
                                <p class="text-gray-600 font-light text-sm leading-relaxed mb-2">
                                    {{ $post->excerpt }}
                                </p>
                                <a href="{{ route('blogs.show', $post->slug) }}" class="text-emerald-600 hover:text-emerald-800 font-light text-xs uppercase tracking-wider transition-colors duration-300 mt-auto group/link">
                                    Leer más <i class="fas fa-arrow-right ml-1 transform group-hover/link:translate-x-2 transition-transform"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 font-light col-span-2">No hay publicaciones disponibles.</p>
            @endif
        </div>

        <!-- CTA Button -->
        <div class="text-center scroll-reveal">
            <a href="{{ route('blogs.index') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-10 py-4 font-light text-sm uppercase tracking-wider hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 rounded-lg shadow-lg">
                Ver todos los artículos
            </a>
        </div>
    </div>
</section>

<!-- Nueva Sección: Testimonios -->
<section class="py-24 bg-gradient-to-br from-gray-50 via-white to-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16 scroll-reveal">
            <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                Lo que dicen nuestros <span class="gradient-text">pacientes</span>
            </h2>
            <div class="w-16 h-px bg-gradient-to-r from-blue-600 to-emerald-600 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonio 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift scroll-reveal">
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-400"></i>
                    @endfor
                </div>
                <p class="text-gray-600 font-light mb-6 italic">
                    "Excelente atención y profesionalismo. El Dr. Pérez fue muy detallado en mi examen visual 
                    y me ayudó a elegir los lentes perfectos para mi estilo de vida."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        MR
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">María Rodríguez</h4>
                        <p class="text-gray-500 text-sm">Paciente desde 2020</p>
                    </div>
                </div>
            </div>

            <!-- Testimonio 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift scroll-reveal animation-delay-200">
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-400"></i>
                    @endfor
                </div>
                <p class="text-gray-600 font-light mb-6 italic">
                    "La tecnología que utilizan es impresionante. Detectaron un problema que otros no habían 
                    visto. Muy agradecido por su dedicación."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                        JL
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Jorge López</h4>
                        <p class="text-gray-500 text-sm">Paciente desde 2019</p>
                    </div>
                </div>
            </div>

            <!-- Testimonio 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg hover-lift scroll-reveal animation-delay-400">
                <div class="flex mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star text-yellow-400"></i>
                    @endfor
                </div>
                <p class="text-gray-600 font-light mb-6 italic">
                    "Mi hijo necesitaba lentes y temía que no quisiera usarlos. El equipo fue increíble 
                    ayudándolo a elegir unos que le encantaron."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                        AS
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900">Ana Silva</h4>
                        <p class="text-gray-500 text-sm">Paciente desde 2021</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section Mejorado -->
<section class="py-24 bg-gradient-to-r from-blue-600 via-blue-700 to-emerald-600 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute -top-20 -right-20 w-80 h-80 bg-white rounded-full animate-float"></div>
        <div class="absolute bottom-10 left-10 w-60 h-60 bg-white rounded-full animate-float animation-delay-400"></div>
    </div>
    
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center relative z-10 scroll-reveal">
        <h2 class="text-4xl lg:text-5xl font-light text-white mb-8 animate-fade-in-up">
            ¿No estás seguro de tu estilo?
        </h2>
        <p class="text-xl text-white/90 font-light mb-12 max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
            Nuestro test de estilo personalizado te ayudará a encontrar la montura perfecta para tu rostro y personalidad
        </p>
        <button class="bg-white text-blue-700 px-12 py-4 font-medium text-sm uppercase tracking-wider hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 rounded-lg shadow-2xl animate-fade-in-up animation-delay-400">
            Comenzar Test de Estilo
        </button>
    </div>
</section>
<script>
// Intersection Observer para animaciones al scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            
            // Si es un contador, iniciar la animación
            if (entry.target.classList.contains('counter')) {
                animateCounter(entry.target);
            }
        }
    });
}, observerOptions);

// Observar todos los elementos con clase scroll-reveal
document.querySelectorAll('.scroll-reveal').forEach(el => {
    observer.observe(el);
});

// Función para animar contadores
function animateCounter(counter) {
    const target = parseInt(counter.getAttribute('data-target'));
    const duration = 2000; // 2 segundos
    const step = target / (duration / 16); // 60 FPS
    let current = 0;
    
    const updateCounter = () => {
        current += step;
        if (current < target) {
            counter.textContent = Math.floor(current);
            requestAnimationFrame(updateCounter);
        } else {
            counter.textContent = target;
            // Para el porcentaje, agregar el símbolo %
            if (counter.getAttribute('data-target') === '98') {
                counter.textContent = target + '%';
            }
        }
    };
    
    updateCounter();
}

// Parallax effect para el hero
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.parallax-bg');
    if (parallax) {
        parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});

// Smooth scroll para links internos
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
</script>
@endsection
