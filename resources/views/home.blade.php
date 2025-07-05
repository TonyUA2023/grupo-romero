@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Expertos en Salud Visual')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1559563362-c667ba5f5480?ixlib=rb-4.0.3" 
                 alt="Clínica Optométrica" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/70 to-cyan-900/50"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center"
             x-data="{ show: false }"
             x-init="setTimeout(() => show = true, 100)">
            <h1 x-show="show" 
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform translate-y-10"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="text-5xl md:text-7xl font-bold text-white mb-6">
                Tu visión, <span class="text-cyan-300">nuestra prioridad</span>
            </h1>
            <p x-show="show" 
               x-transition:enter="transition ease-out duration-1000 delay-300"
               x-transition:enter-start="opacity-0 transform translate-y-10"
               x-transition:enter-end="opacity-100 transform translate-y-0"
               class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto">
                Cuidamos tu salud visual con tecnología de vanguardia y un equipo de profesionales altamente calificados
            </p>
            <div x-show="show" 
                 x-transition:enter="transition ease-out duration-1000 delay-600"
                 x-transition:enter-start="opacity-0 transform translate-y-10"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/51999999999?text=Hola,%20me%20gustaría%20agendar%20una%20cita" 
                   target="_blank"
                   class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-2xl">
                    Agenda tu cita
                </a>
                <a href="{{ route('services') }}" 
                   class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold text-lg hover:bg-white hover:text-blue-600 transform hover:scale-105 transition-all duration-300">
                    Nuestros servicios
                </a>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white" x-data="{ inView: false }" x-intersect="inView = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 x-show="inView"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 transform translate-y-10"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    ¿Por qué elegirnos?
                </h2>
                <p x-show="inView"
                   x-transition:enter="transition ease-out duration-1000 delay-300"
                   x-transition:enter-start="opacity-0"
                   x-transition:enter-end="opacity-100"
                   class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Combinamos experiencia, tecnología y calidez humana para cuidar tu salud visual
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-500"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="group relative p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4 group-hover:text-white transition-colors duration-300">
                            Profesionales Certificados
                        </h3>
                        <p class="text-gray-600 group-hover:text-white/90 transition-colors duration-300">
                            Nuestro equipo cuenta con las más altas certificaciones y experiencia en el cuidado de la salud visual.
                        </p>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-700"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="group relative p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4 group-hover:text-white transition-colors duration-300">
                            Tecnología Avanzada
                        </h3>
                        <p class="text-gray-600 group-hover:text-white/90 transition-colors duration-300">
                            Equipos de última generación para diagnósticos precisos y tratamientos efectivos.
                        </p>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-900"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="group relative p-8 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl hover:shadow-2xl transition-all duration-300">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center mb-6 group-hover:bg-white/20 transition-colors duration-300">
                            <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-4 group-hover:text-white transition-colors duration-300">
                            Atención Personalizada
                        </h3>
                        <p class="text-gray-600 group-hover:text-white/90 transition-colors duration-300">
                            Dedicamos el tiempo necesario para entender tus necesidades y ofrecerte el mejor cuidado.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview Section -->
    <section class="py-20 bg-gray-50" x-data="{ inView: false }" x-intersect="inView = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 x-show="inView"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 transform translate-y-10"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Nuestros servicios
                </h2>
                <p x-show="inView"
                   x-transition:enter="transition ease-out duration-1000 delay-300"
                   x-transition:enter-start="opacity-0"
                   x-transition:enter-end="opacity-100"
                   class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Ofrecemos una amplia gama de servicios para el cuidado integral de tu visión
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Service Card 1 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-500"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-12 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1574482620811-1aa16ffe3c82?ixlib=rb-4.0.3" 
                             alt="Examen Visual" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Examen Visual Completo</h3>
                        <p class="text-gray-600">Evaluación integral de tu salud visual con tecnología de punta</p>
                    </div>
                </div>
                
                <!-- Service Card 2 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-700"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-12 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1577401239170-897942555fb3?ixlib=rb-4.0.3" 
                             alt="Lentes" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Lentes Premium</h3>
                        <p class="text-gray-600">Amplia variedad de monturas y lentes de las mejores marcas</p>
                    </div>
                </div>
                
                <!-- Service Card 3 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-900"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-12 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1559058789-672da06263d8?ixlib=rb-4.0.3" 
                             alt="Lentes de Contacto" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Lentes de Contacto</h3>
                        <p class="text-gray-600">Adaptación personalizada y seguimiento continuo</p>
                    </div>
                </div>
                
                <!-- Service Card 4 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-1100"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-12 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1582669119020-7c0401d2b1c8?ixlib=rb-4.0.3" 
                             alt="Terapia Visual" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Terapia Visual</h3>
                        <p class="text-gray-600">Tratamientos especializados para mejorar tu rendimiento visual</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('services') }}" 
                   class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-semibold rounded-full hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                    Ver todos los servicios
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white" x-data="{ inView: false }" x-intersect="inView = true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 x-show="inView"
                    x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 transform translate-y-10"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Lo que dicen nuestros pacientes
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-500"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl">
                    <div class="flex mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-4">
                        "Excelente atención y profesionalismo. El equipo médico es muy dedicado y los resultados han sido increíbles. ¡Totalmente recomendado!"
                    </p>
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name=Maria+Garcia&background=3b82f6&color=fff" 
                             alt="Maria Garcia" 
                             class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">María García</h4>
                            <p class="text-sm text-gray-600">Paciente desde 2020</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-700"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl">
                    <div class="flex mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-4">
                        "La tecnología que utilizan es de primera. Me realizaron un examen completo y detectaron problemas que otros no habían visto."
                    </p>
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name=Carlos+Lopez&background=3b82f6&color=fff" 
                             alt="Carlos Lopez" 
                             class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">Carlos López</h4>
                            <p class="text-sm text-gray-600">Paciente desde 2021</p>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div x-show="inView"
                     x-transition:enter="transition ease-out duration-1000 delay-900"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     class="bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl">
                    <div class="flex mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-4">
                        "Mi familia y yo somos pacientes regulares. La atención es personalizada y siempre nos sentimos muy bien cuidados."
                    </p>
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name=Ana+Martinez&background=3b82f6&color=fff" 
                             alt="Ana Martinez" 
                             class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">Ana Martínez</h4>
                            <p class="text-sm text-gray-600">Paciente desde 2019</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-br from-blue-600 to-cyan-500">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                ¿Listo para cuidar tu visión?
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Agenda tu cita hoy mismo y descubre la diferencia de un cuidado visual de excelencia
            </p>
            <a href="https://wa.me/51999999999?text=Hola,%20me%20gustaría%20agendar%20una%20cita" 
               target="_blank"
               class="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-2xl">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Contactar por WhatsApp
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Add Intersection Observer polyfill if needed
    if (!('IntersectionObserver' in window)) {
        document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=IntersectionObserver"><\/script>');
    }
</script>
@endpush