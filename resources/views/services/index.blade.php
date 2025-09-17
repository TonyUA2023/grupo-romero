@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Servicios Profesionales')
@section('description', 'Expertos en salud visual con tecnología de última generación. Exámenes completos y atención personalizada.')

@section('content')
<section>
    <!-- Hero Section Creativo -->
    <section class="relative min-h-screen bg-gradient-to-br from-violet-900 via-purple-900 to-indigo-900 flex items-center justify-center overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <!-- Floating Orbs -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-20 left-1/2 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
            
            <!-- Grid Pattern -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        </div>

        <!-- Imagen de fondo con overlay -->
        <img src="{{ asset('imagenes/Portada1.jpg') }}"
            alt="Servicios de Optometría"
            class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-overlay">

        <!-- Contenido centrado -->
        <div class="relative z-10 text-center px-6 max-w-6xl mx-auto">
            <!-- Badge animado -->
            <div class="inline-flex items-center px-6 py-2 bg-white/10 backdrop-blur-md rounded-full text-cyan-300 text-sm font-medium mb-8 animate-fade-in">
                <span class="relative flex h-3 w-3 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
                </span>
                Tecnología de Vanguardia
            </div>

            <h1 class="text-6xl lg:text-8xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mb-6 animate-fade-in-up tracking-tight">
                SERVICIOS
            </h1>
            <p class="text-3xl lg:text-5xl font-light text-white mb-8 animate-fade-in-up animation-delay-200">
                PROFESIONALES
            </p>
            
            <!-- Línea decorativa con gradiente -->
            <div class="w-32 h-1 bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400 mx-auto mb-8 animate-scale-x rounded-full"></div>
            
            <p class="text-xl lg:text-2xl text-gray-200 font-light tracking-wide mb-12 animate-fade-in-up animation-delay-400">
                Excelencia en cuidado visual con <span class="text-cyan-400 font-medium">tecnología avanzada</span>
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up animation-delay-600">
                <a href="#servicios" class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-medium rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/25">
                    <span class="relative z-10">Explorar Servicios</span>
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                <a href="/contacto" class="group inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-md text-white font-medium rounded-full border border-white/20 hover:bg-white/20 hover:border-white/30 transition-all duration-300">
                    <span>Agendar Cita</span>
                    <svg class="w-5 h-5 ml-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Scroll indicator mejorado -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-white/50 rounded-full flex items-start justify-center p-1">
                <div class="w-1 h-2 bg-gradient-to-b from-cyan-400 to-purple-400 rounded-full animate-scroll-down"></div>
            </div>
            <p class="text-white/50 text-xs mt-2 font-light">Desliza</p>
        </div>
    </section>

    <!-- Estilos CSS adicionales -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        
        .animate-blob {
            animation: blob 10s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .animation-delay-200 { animation-delay: 200ms; }
        .animation-delay-400 { animation-delay: 400ms; }
        .animation-delay-600 { animation-delay: 600ms; }

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

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes scale-x {
            from { transform: scaleX(0); }
            to { transform: scaleX(1); }
        }

        @keyframes scroll-down {
            0% { transform: translateY(0); opacity: 0; }
            50% { opacity: 1; }
            100% { transform: translateY(6px); opacity: 0; }
        }

        .animate-fade-in-up {
            animation: fade-in-up 1s ease-out forwards;
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out forwards;
        }

        .animate-scale-x {
            animation: scale-x 1s ease-out forwards;
        }

        .animate-scroll-down {
            animation: scroll-down 2s infinite;
        }

        /* Service Cards Enhanced */
        .service-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .service-image-container {
            position: relative;
            overflow: hidden;
        }
        
        .service-image-container:hover .overlay {
            opacity: 1;
        }
        
        .service-image-container:hover img {
            transform: scale(1.1);
        }
        
        .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.9), rgba(139, 92, 246, 0.9));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .service-number {
            font-size: 150px;
            font-weight: 900;
            position: absolute;
            top: -60px;
            right: -20px;
            z-index: 0;
            background: linear-gradient(135deg, #06B6D4, #8B5CF6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.1;
        }
        
        .service-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 8px 24px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            z-index: 10;
            border-radius: 50px;
        }

        @media (max-width: 768px) {
            .service-number {
                font-size: 100px;
                top: -30px;
            }
        }

        /* Reveal animation */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal-on-scroll.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <!-- Servicios Dinámicos con diseño colorido -->
    <div id="servicios">
    @foreach($services as $index => $service)
        @php
            $serviceNumber = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
            
            // Paletas de colores para cada servicio
            $colorSchemes = [
                ['from' => 'from-cyan-500', 'to' => 'to-blue-600', 'bg' => 'bg-gradient-to-br from-cyan-50 to-blue-50', 'badge' => 'bg-cyan-500', 'hover' => 'hover:shadow-cyan-500/20'],
                ['from' => 'from-purple-500', 'to' => 'to-pink-600', 'bg' => 'bg-gradient-to-br from-purple-50 to-pink-50', 'badge' => 'bg-purple-500', 'hover' => 'hover:shadow-purple-500/20'],
                ['from' => 'from-emerald-500', 'to' => 'to-teal-600', 'bg' => 'bg-gradient-to-br from-emerald-50 to-teal-50', 'badge' => 'bg-emerald-500', 'hover' => 'hover:shadow-emerald-500/20'],
                ['from' => 'from-orange-500', 'to' => 'to-red-600', 'bg' => 'bg-gradient-to-br from-orange-50 to-red-50', 'badge' => 'bg-orange-500', 'hover' => 'hover:shadow-orange-500/20'],
                ['from' => 'from-indigo-500', 'to' => 'to-purple-600', 'bg' => 'bg-gradient-to-br from-indigo-50 to-purple-50', 'badge' => 'bg-indigo-500', 'hover' => 'hover:shadow-indigo-500/20'],
                ['from' => 'from-pink-500', 'to' => 'to-rose-600', 'bg' => 'bg-gradient-to-br from-pink-50 to-rose-50', 'badge' => 'bg-pink-500', 'hover' => 'hover:shadow-pink-500/20'],
            ];
            
            $colorScheme = $colorSchemes[$index % count($colorSchemes)];
            $isEven = $index % 2 === 1;
            
            // Formatear el título con salto de línea
            $titleParts = explode(' ', $service->name);
            $halfLength = ceil(count($titleParts) / 2);
            $firstLine = implode(' ', array_slice($titleParts, 0, $halfLength));
            $secondLine = implode(' ', array_slice($titleParts, $halfLength));
        @endphp

        <section class="service-card py-24 lg:py-32 reveal-on-scroll {{ $colorScheme['bg'] }}">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    @if($isEven)
                        <!-- Imagen a la izquierda en servicios pares -->
                        <div class="order-2 lg:order-1 service-image-container relative group">
                            <div class="service-badge {{ $colorScheme['badge'] }} text-white shadow-lg">
                                <i class="fas fa-star mr-2"></i>SERVICIO {{ $serviceNumber }}
                            </div>
                            <div class="rounded-3xl overflow-hidden shadow-2xl {{ $colorScheme['hover'] }} transition-all duration-500 group-hover:shadow-3xl">
                                <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('imagenes/default-service.jpg') }}"
                                    alt="{{ $service->name }}"
                                    class="w-full h-[500px] lg:h-[600px] object-cover transition-transform duration-700">
                                <div class="overlay">
                                    <a href=/contacto?servicio={{ urlencode($service->name) }}" 
                                       class="group relative px-8 py-4 bg-white text-gray-900 font-semibold rounded-full overflow-hidden transition-all duration-300 hover:scale-105">
                                        <span class="relative z-10">Reservar Cita</span>
                                        <svg class="w-5 h-5 ml-2 inline-block group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Contenido a la derecha -->
                        <div class="order-1 lg:order-2 relative">
                            <span class="service-number">{{ $serviceNumber }}</span>
                            <h2 class="text-4xl lg:text-6xl font-bold mb-6 relative z-10">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }}">
                                    {{ $firstLine }}
                                </span>
                                <br>
                                <span class="text-gray-800">{{ $secondLine }}</span>
                            </h2>
                            <div class="w-20 h-1 bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }} mb-6 rounded-full"></div>
                            <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-8">
                                {{ $service->short_description }}
                            </p>
                            
                            @if($service->description)
                                <div class="space-y-3 mb-8">
                                    @php
                                        $features = array_filter(array_map('trim', explode("\n", $service->description)));
                                    @endphp
                                    @foreach($features as $feature)
                                        <div class="flex items-start">
                                            <div class="w-6 h-6 rounded-full bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }} flex items-center justify-center flex-shrink-0 mt-1">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <p class="ml-4 text-gray-600">{{ $feature }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($service->price || $service->duration)
                                <div class="flex flex-wrap gap-6 mt-8">
                                    @if($service->price)
                                        <div class="bg-white/50 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-md">
                                            <p class="text-sm text-gray-600">Inversión</p>
                                            <p class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }}">
                                                S/{{ $service->price }}
                                            </p>
                                        </div>
                                    @endif
                                    @if($service->duration)
                                        <div class="bg-white/50 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-md">
                                            <p class="text-sm text-gray-600">Duración</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $service->duration }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- CTA Button -->
                            <div class="mt-10">
                                <a href="contacto?servicio={{ urlencode($service->name) }}" 
                                   class="group inline-flex items-center px-8 py-4 bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }} text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                    <span>Más información</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Contenido a la izquierda en servicios impares -->
                        <div class="relative">
                            <span class="service-number">{{ $serviceNumber }}</span>
                            <h2 class="text-4xl lg:text-6xl font-bold mb-6 relative z-10">
                                <span class="text-transparent bg-clip-text bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }}">
                                    {{ $firstLine }}
                                </span>
                                <br>
                                <span class="text-gray-800">{{ $secondLine }}</span>
                            </h2>
                            <div class="w-20 h-1 bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }} mb-6 rounded-full"></div>
                            <p class="text-lg lg:text-xl text-gray-700 leading-relaxed mb-8">
                                {{ $service->short_description }}
                            </p>
                            
                            @if($service->description)
                                <div class="space-y-3 mb-8">
                                    @php
                                        $features = array_filter(array_map('trim', explode("\n", $service->description)));
                                    @endphp
                                    @foreach($features as $feature)
                                        <div class="flex items-start">
                                            <div class="w-6 h-6 rounded-full bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }} flex items-center justify-center flex-shrink-0 mt-1">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <p class="ml-4 text-gray-600">{{ $feature }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($service->price || $service->duration)
                                <div class="flex flex-wrap gap-6 mt-8">
                                    @if($service->price)
                                        <div class="bg-white/50 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-md">
                                            <p class="text-sm text-gray-600">Inversión</p>
                                            <p class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }}">
                                                {{ $service->price }}
                                            </p>
                                        </div>
                                    @endif
                                    @if($service->duration)
                                        <div class="bg-white/50 backdrop-blur-sm rounded-2xl px-6 py-3 shadow-md">
                                            <p class="text-sm text-gray-600">Duración</p>
                                            <p class="text-2xl font-bold text-gray-800">{{ $service->duration }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- CTA Button -->
                            <div class="mt-10">
                                <a href="/contacto?servicio={{ urlencode($service->name) }}" 
                                   class="group inline-flex items-center px-8 py-4 bg-gradient-to-r {{ $colorScheme['from'] }} {{ $colorScheme['to'] }} text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                    <span>Más información</span>
                                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- Imagen a la derecha -->
                        <div class="service-image-container relative group">
                            <div class="service-badge {{ $colorScheme['badge'] }} text-white shadow-lg">
                                <i class="fas fa-star mr-2"></i>SERVICIO {{ $serviceNumber }}
                            </div>
                            <div class="rounded-3xl overflow-hidden shadow-2xl {{ $colorScheme['hover'] }} transition-all duration-500 group-hover:shadow-3xl">
                                <img src="{{ $service->image ? asset('storage/' . $service->image) : asset('imagenes/default-service.jpg') }}"
                                    alt="{{ $service->name }}"
                                    class="w-full h-[500px] lg:h-[600px] object-cover transition-transform duration-700">
                                <div class="overlay">
                                    <a href="/contacto?servicio={{ urlencode($service->name) }}" 
                                       class="group relative px-8 py-4 bg-white text-gray-900 font-semibold rounded-full overflow-hidden transition-all duration-300 hover:scale-105">
                                        <span class="relative z-10">Reservar Cita</span>
                                        <svg class="w-5 h-5 ml-2 inline-block group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach
    </div>

    <!-- Call to Action Final Mejorado -->
    <section class="relative py-32 bg-gradient-to-br from-purple-900 via-indigo-900 to-purple-900 overflow-hidden">
        <!-- Elementos de fondo animados -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center px-6 py-2 bg-white/10 backdrop-blur-md rounded-full text-cyan-300 text-sm font-medium mb-8">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 1.414L10.586 9.5H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                </svg>
                Atención Personalizada
            </div>

            <h2 class="text-5xl lg:text-7xl font-bold text-white mb-6">
                ¿Listo para mejorar tu
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 via-purple-400 to-pink-400">
                    visión?
                </span>
            </h2>
            
            <p class="text-xl text-gray-200 mb-12 max-w-3xl mx-auto font-light">
                Experiencia profesional y atención personalizada para el cuidado integral de tu salud visual. 
                Agenda tu cita hoy y descubre la diferencia.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="contacto?tipo=cita" 
                   class="group relative inline-flex items-center px-10 py-5 bg-gradient-to-r from-cyan-500 to-purple-600 text-white font-semibold text-lg rounded-full overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/25">
                    <span class="relative z-10">Reservar Cita Ahora</span>
                    <svg class="w-6 h-6 ml-3 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="contacto?tipo=consulta" 
                   class="group inline-flex items-center px-10 py-5 bg-white/10 backdrop-blur-md text-white font-semibold text-lg rounded-full border-2 border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300">
                    <span>Consulta Rápida</span>
                    <svg class="w-6 h-6 ml-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </a>
            </div>

            <!-- Información de contacto -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-white">
                <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-sm mb-1">Llámanos</p>
                    <p class="font-semibold text-lg">+51 923 323 517</p>
                </div>
                
                <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-sm mb-1">Email</p>
                    <p class="font-semibold text-lg">info@grclinica.com</p>
                </div>
                
                <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                    <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-sm mb-1">Ubicación</p>
                    <p class="font-semibold text-lg">Lima, Perú</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Script para animación de scroll mejorado -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll para el botón del hero
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

            // Intersection Observer para animaciones
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            });

            document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
                observer.observe(el);
            });

            // Parallax effect en scroll
            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.absolute.inset-0');
                if (parallax) {
                    const speed = scrolled * -0.5;
                    parallax.style.transform = `translateY(${speed}px)`;
                }
            });
        });
    </script>
</section>

@endsection