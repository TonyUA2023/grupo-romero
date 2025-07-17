@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Salud Visual de Calidad')

@section('description', 'Expertos en salud visual con tecnología de última generación. Exámenes completos, lentes de alta calidad y atención personalizada.')

@section('content')
<section>
    <section class="relative w-screen h-[90vh] bg-black flex flex-col justify-center items-center overflow-hidden">
        <!-- Imagen centrada -->
        <img src="{{ asset('imagenes/Portada1.jpg') }}"
            alt="Servicios de Optometría"
            class="w-screen h-auto max-h-[90vh] block">

        <!-- Gradiente para contraste -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent z-10"></div>

        <!-- Contenido visible sin animación -->
        <div class="absolute top-0 left-0 right-0 z-20 text-center px-6 pt-12 lg:pt-20">
            <h1 class="text-4xl lg:text-6xl font-light text-white mb-6 drop-shadow-md transition duration-700">
                Servicios Optométricos Profesionales
            </h1>
            <p class="text-lg lg:text-xl text-white font-light mb-10 drop-shadow-sm transition duration-700 delay-200">
                Tecnología avanzada y atención personalizada para cuidar tu visión.
            </p>
            <a href="#servicios"
            class="inline-block bg-blue-600 text-white px-10 py-4 rounded-xl text-sm uppercase tracking-wider hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-lg">
                Explorar Servicios
            </a>
        </div>
    </section>


<!-- Main Content - Secciones de Servicios -->
<main>
    <!-- Estilos CSS adicionales -->
    <style>
        .service-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .zigzag-pattern {
            background-image: linear-gradient(45deg, transparent 40%, rgba(102, 126, 234, 0.1) 50%, transparent 60%);
        }
        
        .gradient-overlay {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>

        <!-- Header de Servicios -->
    <section class="relative w-full overflow-hidden bg-gradient-to-b from-blue-900 to-blue-700 py-20">
        <!-- Capa oscura para contraste -->
        <div class="absolute inset-0 bg-black opacity-20"></div>

        <!-- Contenedor centrado y responsivo -->
        <div class="relative w-full max-w-7xl mx-auto px-6 lg:px-12 text-center">
            <div class="floating-element">
                <h1 class="text-4xl lg:text-6xl font-light text-white mb-6">
                    Nuestros <span class="font-semibold">Servicios</span>
                </h1>
                <p class="text-lg text-white opacity-90 font-light max-w-2xl mx-auto">
                    Tecnología avanzada y atención personalizada para cuidar tu salud visual
                </p>
            </div>
        </div>
    </section>

    <!-- Servicio 1: Exámenes Completos de la Vista -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <!-- Contenedor de imagen con altura fija y overflow oculto -->
                    <div class="bg-gray-100 rounded-3xl h-96 overflow-hidden group relative">
                        <img src="{{ asset('imagenes/Examen1.jpg') }}"
                            alt="Examen completo de la vista"
                            class="w-full h-full object-cover transform transition duration-500 ease-in-out group-hover:scale-105 rounded-3xl">
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="inline-flex items-center px-4 py-2 bg-blue-50 rounded-full mb-6">
                        <span class="text-blue-600 font-medium text-sm">01</span>
                        <span class="ml-2 text-blue-600 font-medium text-sm">DIAGNÓSTICO</span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                        Exámenes Completos de la Vista
                    </h2>
                    <p class="text-xl text-gray-600 font-light mb-8 leading-relaxed">
                        Evaluación integral de tu salud visual con equipos de última generación. Detectamos problemas refractivos, glaucoma, cataratas y otras patologías oculares en sus primeras etapas.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-2 h-2 bg-blue-600 rounded-full mt-3 mr-4"></div>
                            <p class="text-gray-700">Pruebas de agudeza visual y refracción</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-2 h-2 bg-blue-600 rounded-full mt-3 mr-4"></div>
                            <p class="text-gray-700">Examen del fondo de ojo</p>
                        </div>
                        <div class="flex items-start">
                            <div class="w-2 h-2 bg-blue-600 rounded-full mt-3 mr-4"></div>
                            <p class="text-gray-700">Medición de presión intraocular</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<!-- Servicio 2: Lentes de Contacto -->
<section class="py-20 bg-gray-50 zigzag-pattern">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 bg-purple-50 rounded-full mb-6">
                <span class="text-purple-600 font-medium text-sm">02</span>
                <span class="ml-2 text-purple-600 font-medium text-sm">ADAPTACIÓN</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                Lentes de Contacto
            </h2>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Tarjeta 1 -->
            <div class="service-card bg-white rounded-3xl p-8 shadow-lg">
                <div class="bg-gray-100 rounded-2xl h-48 overflow-hidden mb-6">
                    <img src="{{ asset('imagenes/Lente1.jpg') }}" alt="Lentes blandos" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Lentes Blandos</h3>
                <p class="text-gray-600 mb-4">Comodidad excepcional para uso diario. Ideales para principiantes y deportistas.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• Diarios desechables</li>
                    <li>• Mensuales premium</li>
                    <li>• Para astigmatismo</li>
                </ul>
            </div>

            <!-- Tarjeta 2 -->
            <div class="service-card bg-white rounded-3xl p-8 shadow-lg">
                <div class="bg-gray-100 rounded-2xl h-48 overflow-hidden mb-6">
                    <img src="{{ asset('imagenes/Lente2.jpg') }}" alt="Lentes rígidos" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Lentes Rígidos</h3>
                <p class="text-gray-600 mb-4">Máxima calidad visual y durabilidad. Perfectos para correcciones complejas.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• Corrección de queratocono</li>
                    <li>• Astigmatismo irregular</li>
                    <li>• Terapia refractiva</li>
                </ul>
            </div>

            <!-- Tarjeta 3 -->
            <div class="service-card bg-white rounded-3xl p-8 shadow-lg">
                <div class="bg-gray-100 rounded-2xl h-48 overflow-hidden mb-6">
                    <img src="{{ asset('imagenes/Lente3.jpg') }}" alt="Lentes especiales" class="w-full h-full object-cover">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Lentes Especiales</h3>
                <p class="text-gray-600 mb-4">Soluciones avanzadas para necesidades específicas y patologías oculares.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li>• Orto-K (uso nocturno)</li>
                    <li>• Lentes esclerales</li>
                    <li>• Multifocales</li>
                </ul>
            </div>
        </div>
    </div>
</section>


   <!-- Servicio 3: Monturas y Lentes Oftálmicos -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-pink-50 to-purple-50 opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="inline-flex items-center px-4 py-2 bg-pink-50 rounded-full mb-6">
                    <span class="text-pink-600 font-medium text-sm">03</span>
                    <span class="ml-2 text-pink-600 font-medium text-sm">ESTILO</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                    Monturas y Lentes Oftálmicos
                </h2>
                <p class="text-xl text-gray-600 font-light mb-8 leading-relaxed">
                    Amplia selección de monturas de diseñador y lentes de alta tecnología. Combinamos estilo, comodidad y funcionalidad para brindarte la mejor experiencia visual.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <h4 class="font-semibold text-gray-900 mb-3">Monturas Premium</h4>
                        <p class="text-sm text-gray-600">Marcas exclusivas y diseños únicos para cada personalidad</p>
                    </div>
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <h4 class="font-semibold text-gray-900 mb-3">Lentes Especializados</h4>
                        <p class="text-sm text-gray-600">Antirreflejo, filtro azul, progresivos y más</p>
                    </div>
                </div>
            </div>

            <!-- Imagen con efecto zoom -->
            <div class="lg:pl-8">
                <div class="rounded-3xl h-96 overflow-hidden group">
                    <img src="{{ asset('imagenes/Monturas.jpg') }}"
                         alt="Monturas y Lentes"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
            </div>

        </div>
    </div>
</section>


    <!-- Servicio 4: Lentes de Sol -->
<section class="py-20 bg-gradient-to-r from-yellow-400 via-orange-500 to-red-500 relative">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 glass-effect rounded-full mb-6">
                <span class="text-white font-medium text-sm">04</span>
                <span class="ml-2 text-white font-medium text-sm">PROTECCIÓN</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-light text-white mb-6">
                Lentes de Sol
            </h2>
            <p class="text-xl text-white opacity-90 font-light max-w-2xl mx-auto">
                Protección UV completa con estilo. Colección exclusiva de lentes de sol para cada ocasión.
            </p>
        </div>

        <div class="grid lg:grid-cols-4 gap-6">
            <!-- Tarjeta 1: Deportivos -->
            <div class="glass-effect rounded-2xl p-6 text-center">
                <div class="overflow-hidden rounded-xl mb-4 h-32">
                    <img src="{{ asset('imagenes/Lentes-deportivos.png') }}" 
                         alt="Lentes Deportivos"
                         class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Deportivos</h3>
                <p class="text-white opacity-80 text-sm">Resistentes y ligeros para actividades al aire libre</p>
            </div>

            <!-- Tarjeta 2: Elegantes -->
            <div class="glass-effect rounded-2xl p-6 text-center">
                <div class="overflow-hidden rounded-xl mb-4 h-32">
                    <img src="{{ asset('imagenes/Lentes-elegantes.webp') }}" 
                         alt="Lentes Elegantes"
                         class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Elegantes</h3>
                <p class="text-white opacity-80 text-sm">Diseños sofisticados para ocasiones especiales</p>
            </div>

            <!-- Tarjeta 3: Polarizados -->
            <div class="glass-effect rounded-2xl p-6 text-center">
                <div class="overflow-hidden rounded-xl mb-4 h-32">
                    <img src="{{ asset('imagenes/Lentes-polarizados.png') }}" 
                         alt="Lentes Polarizados"
                         class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Polarizados</h3>
                <p class="text-white opacity-80 text-sm">Reducen reflejos y mejoran la claridad visual</p>
            </div>

            <!-- Tarjeta 4: Graduados -->
            <div class="glass-effect rounded-2xl p-6 text-center">
                <div class="overflow-hidden rounded-xl mb-4 h-32">
                    <img src="{{ asset('imagenes/Lentes-graduados.webp') }}" 
                         alt="Lentes Graduados"
                         class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-lg font-semibold text-white mb-2">Graduados</h3>
                <p class="text-white opacity-80 text-sm">Corrección visual con protección solar</p>
            </div>
        </div>
    </div>
</section>

   <!-- Servicio 5: Terapia Visual -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Imagen con zoom -->
            <div>
                <div class="bg-gradient-to-br from-green-100 to-blue-100 rounded-3xl h-96 overflow-hidden flex items-center justify-center">
                    <img src="{{ asset('imagenes/Terapia-visual.jpg') }}"
                         alt="Terapia Visual"
                         class="w-full h-full object-cover transform hover:scale-105 transition duration-500">
                </div>
            </div>

            <!-- Contenido textual -->
            <div>
                <div class="inline-flex items-center px-4 py-2 bg-green-50 rounded-full mb-6">
                    <span class="text-green-600 font-medium text-sm">05</span>
                    <span class="ml-2 text-green-600 font-medium text-sm">REHABILITACIÓN</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                    Terapia Visual
                </h2>
                <p class="text-xl text-gray-600 font-light mb-8 leading-relaxed">
                    Programa especializado para mejorar las habilidades visuales y el procesamiento de información visual. Ideal para niños con dificultades de aprendizaje y adultos con problemas de coordinación visual.
                </p>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-green-600 font-semibold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Evaluación Completa</h4>
                            <p class="text-gray-600">Análisis detallado de habilidades visuales y perceptuales</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-green-600 font-semibold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Plan Personalizado</h4>
                            <p class="text-gray-600">Ejercicios específicos adaptados a cada necesidad</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1">
                            <span class="text-green-600 font-semibold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-2">Seguimiento Continuo</h4>
                            <p class="text-gray-600">Monitoreo del progreso y ajustes en el tratamiento</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

     <!-- Servicio 6: Consulta Pediátrica -->
<section class="py-20 bg-gradient-to-br from-pink-50 via-purple-50 to-indigo-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 bg-pink-100 rounded-full mb-6">
                <span class="text-pink-600 font-medium text-sm">06</span>
                <span class="ml-2 text-pink-600 font-medium text-sm">PEDIÁTRICA</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-6">
                Consulta Pediátrica
            </h2>
            <p class="text-xl text-gray-600 font-light max-w-2xl mx-auto">
                Especialistas en salud visual infantil con técnicas adaptadas para hacer que la consulta sea una experiencia positiva.
            </p>
        </div>
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Tarjeta 1: Ambiente Amigable -->
            <div class="bg-white rounded-3xl p-8 shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="overflow-hidden rounded-2xl h-48 mb-6">
                    <img src="{{ asset('imagenes/Consulta-infantil-ambiente.jpg') }}"
                         alt="Ambiente amigable para niños"
                         class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Ambiente Amigable</h3>
                <p class="text-gray-600">
                    Consultorios especialmente diseñados para niños con colores alegres y juguetes educativos.
                </p>
            </div>

            <!-- Tarjeta 2: Técnicas Especializadas -->
            <div class="bg-white rounded-3xl p-8 shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="overflow-hidden rounded-2xl h-48 mb-6">
                    <img src="{{ asset('imagenes/tecnicas-vision-ninos.jpg') }}"
                         alt="Técnicas visuales adaptadas"
                         class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Técnicas Especializadas</h3>
                <p class="text-gray-600">
                    Métodos de examen adaptados para cada edad, desde bebés hasta adolescentes, sin causar estrés.
                </p>
            </div>

            <!-- Tarjeta 3: Seguimiento Integral -->
            <div class="bg-white rounded-3xl p-8 shadow-lg transform hover:scale-105 transition-transform duration-300">
                <div class="overflow-hidden rounded-2xl h-48 mb-6">
                    <img src="{{ asset('imagenes/seguimiento-visual-pediatrico.jpg') }}"
                         alt="Seguimiento visual pediátrico"
                         class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Seguimiento Integral</h3>
                <p class="text-gray-600">
                    Control periódico del desarrollo visual y detección temprana de problemas de aprendizaje.
                </p>
            </div>
        </div>
    </div>
</section>

    <!-- Servicio 7: Cirugía Refractiva Premium -->
    <section class="py-20 bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-purple-800/20 to-pink-800/20"></div>
            <div class="absolute top-20 left-20 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-pink-500/10 rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-6 py-3 glass-effect rounded-full mb-8">
                    <span class="text-gold-400 font-bold text-sm">07</span>
                    <span class="ml-3 text-gold-400 font-bold text-sm tracking-wider">PREMIUM EXCLUSIVE</span>
                </div>
                <h2 class="text-5xl lg:text-7xl font-light text-white mb-8 tracking-tight">
                    Cirugía Refractiva <span class="font-bold bg-gradient-to-r from-gold-400 to-yellow-300 bg-clip-text text-transparent">Premium</span>
                </h2>
                <p class="text-xl text-white/90 font-light max-w-3xl mx-auto leading-relaxed">
                    Tecnología láser de última generación para liberarte de los lentes para siempre. 
                    Procedimientos mínimamente invasivos con resultados extraordinarios.
                </p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-16 items-center mb-16">
                <div class="space-y-8">
                    <div class="glass-effect rounded-3xl p-8 border border-white/10">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-white mb-2">LASIK Femtosegundo</h3>
                                <p class="text-white/70">Precisión microscópica sin bisturí</p>
                            </div>
                        </div>
                        <p class="text-white/80 leading-relaxed">
                            Tecnología de femtosegundo que crea un flap corneal perfecto, garantizando una recuperación rápida y resultados superiores.
                        </p>
                    </div>
                    
                    <div class="glass-effect rounded-3xl p-8 border border-white/10">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-white mb-2">PRK Avanzado</h3>
                                <p class="text-white/70">Seguridad máxima para córneas delgadas</p>
                            </div>
                        </div>
                        <p class="text-white/80 leading-relaxed">
                            Procedimiento de superficie que preserva la integridad corneal, ideal para pacientes con córneas delgadas o irregulares.
                        </p>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="glass-effect rounded-3xl p-12 text-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-gold-400 to-yellow-500 rounded-full flex items-center justify-center mx-auto mb-8">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </div>
                        <h4 class="text-3xl font-bold text-white mb-4">Garantía de por Vida</h4>
                        <p class="text-white/80 text-lg">
                            Respaldamos nuestros procedimientos con garantía completa y seguimiento vitalicio
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <button class="bg-gradient-to-r from-gold-400 to-yellow-500 text-black px-12 py-4 rounded-full font-bold text-lg uppercase tracking-wider hover:from-gold-500 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                    Evaluación Gratuita Premium
                </button>
            </div>
        </div>
    </section>

    <!-- Servicio 8: Programa VIP Executive -->
    <section class="py-20 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-amber-50 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/2 bg-gradient-to-tr from-purple-50 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div>
                    <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-amber-100 to-yellow-100 rounded-full mb-8">
                        <div class="w-3 h-3 bg-amber-500 rounded-full mr-3"></div>
                        <span class="text-amber-700 font-bold text-sm tracking-wider">08 • VIP EXECUTIVE</span>
                    </div>
                    <h2 class="text-5xl lg:text-6xl font-light text-gray-900 mb-8 leading-tight">
                        Programa <span class="font-bold bg-gradient-to-r from-amber-600 to-yellow-600 bg-clip-text text-transparent">VIP Executive</span>
                    </h2>
                    <p class="text-xl text-gray-600 font-light mb-10 leading-relaxed">
                        Servicio exclusivo para ejecutivos y profesionales que valoran su tiempo. 
                        Atención personalizada con horarios flexibles y servicios premium.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-yellow-500 rounded-2xl flex items-center justify-center mr-6 mt-1">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Citas Priority</h4>
                                <p class="text-gray-600">Horarios exclusivos temprano en la mañana o después de horas laborales</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center mr-6 mt-1">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Concierge Personal</h4>
                                <p class="text-gray-600">Asistente dedicado para coordinar todos tus servicios y necesidades</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center mr-6 mt-1">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-semibold text-gray-900 mb-2">Servicios Corporativos</h4>
                                <p class="text-gray-600">Evaluaciones en tu oficina para ti y tu equipo ejecutivo</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-12 text-white shadow-2xl">
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-gold-400 to-amber-500 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Membresía Anual</h3>
                            <div class="text-4xl font-bold text-gold-400 mb-2">$2,499</div>
                            <p class="text-gray-300">Acceso completo a todos los servicios premium</p>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Exámenes ilimitados</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Descuentos exclusivos en productos</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Atención prioritaria 24/7</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Servicios domiciliarios</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicio 9: Centro de Investigación y Desarrollo -->
    <section class="py-20 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-10 left-10 w-64 h-64 bg-blue-200/20 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-20 w-48 h-48 bg-purple-200/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-1/3 w-56 h-56 bg-indigo-200/20 rounded-full blur-3xl"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center px-6 py-3 bg-white/60 backdrop-blur-sm rounded-full mb-8 border border-white/20">
                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-blue-700 font-bold text-sm tracking-wider">09 • INNOVATION LAB</span>
                </div>
                <h2 class="text-5xl lg:text-7xl font-light text-gray-900 mb-8 leading-tight">
                    Centro de <span class="font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Investigación</span>
                </h2>
                <p class="text-xl text-gray-600 font-light max-w-3xl mx-auto leading-relaxed">
                    Pioneros en investigación oftalmológica avanzada. Desarrollamos las tecnologías del futuro 
                    para la salud visual y ofrecemos acceso exclusivo a tratamientos experimentales.
                </p>
            </div>
            
            <div class="grid lg:grid-cols-3 gap-8 mb-16">
                <div class="group">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl h-56 flex items-center justify-center mb-6 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Terapia Génica</h3>
                        <p class="text-gray-600 mb-6">
                            Tratamientos revolucionarios para enfermedades hereditarias de la retina mediante 
                            terapia génica de última generación.
                        </p>
                        <div class="flex items-center text-blue-600 font-semibold">
                            <span class="mr-2">En ensayos clínicos</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="group">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl h-56 flex items-center justify-center mb-6 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">IA Diagnóstica</h3>
                        <p class="text-gray-600 mb-6">
                            Inteligencia artificial avanzada para detección temprana de enfermedades oculares 
                            con precisión superior al 99%.
                        </p>
                        <div class="flex items-center text-purple-600 font-semibold">
                            <span class="mr-2">Disponible ahora</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="group">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 border border-white/20 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                        <div class="bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl h-56 flex items-center justify-center mb-6 group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Bioingeniería</h3>
                        <p class="text-gray-600 mb-6">
                            Desarrollo de implantes biónicos y prótesis retinianas para restaurar la visión 
                            en casos de ceguera total.
                        </p>
                        <div class="flex items-center text-emerald-600 font-semibold">
                            <span class="mr-2">Fase experimental</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-gray-900 to-blue-900 rounded-3xl p-12 text-white text-center">
                <div class="max-w-3xl mx-auto">
                    <h3 class="text-3xl font-bold mb-6">¿Interesado en participar en nuestros estudios?</h3>
                    <p class="text-xl text-white/90 mb-8">
                        Únete a la vanguardia de la medicina oftalmológica y accede a tratamientos exclusivos 
                        antes que estén disponibles comercialmente.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-white text-gray-900 px-8 py-4 rounded-full font-bold hover:bg-gray-100 transition-colors duration-300">
                            Solicitar Información
                        </button>
                        <button class="border-2 border-white text-white px-8 py-4 rounded-full font-bold hover:bg-white hover:text-gray-900 transition-colors duration-300">
                            Evaluar Elegibilidad
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Contacto Final -->
    <section class="py-20 bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-4xl lg:text-5xl font-light text-white mb-8">
                Tu Visión es Nuestro Compromiso
            </h2>
            <p class="text-xl text-white/90 font-light mb-12 max-w-2xl mx-auto">
                Agenda tu cita y descubre por qué somos la elección preferida de miles de pacientes
            </p>
            <button class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-12 py-4 rounded-full font-bold text-lg uppercase tracking-wider hover:from-blue-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 shadow-2xl">
                Reservar Cita Ahora
            </button>
        </div>
    </section>
</section>

@endsection