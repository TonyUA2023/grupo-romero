@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Salud Visual de Calidad')
@section('description', 'Expertos en salud visual con tecnología de última generación. Exámenes completos, lentes de alta calidad y atención personalizada.')

@section('content')
<!-- Hero Section -->
<!-- Hero Section -->
<section class="relative min-h-screen overflow-hidden">
    <!-- Imagen de fondo dinámica -->
    @if($heroSection && $heroSection->image)
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $heroSection->image) }}" alt="{{ $heroSection->title ?? 'Hero' }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    @else
        <!-- Imagen de respaldo si no hay imagen cargada -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-optica.jpg') }}" alt="Óptica elegante" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    @endif

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-center min-h-screen py-20">
            <div class="text-center text-white space-y-8 max-w-4xl">
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-light leading-tight">
                    {{ $heroSection->title ?? 'Descubre la temporada' }}
                    <span class="block font-normal md:text-2xl lg:text-3xl xl:text-4xl mt-10">{{ $heroSection->subtitle ?? 'más nueva' }}</span>
                </h1>
                <p class="text-lg md:text-xl lg:text-2xl font-light max-w-2xl mx-auto">
                    {{ $heroSection->content ?? 'Monturas elegantes para cada estilo' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-8">
                    <button class="bg-blue-600 text-white px-8 py-4 font-light text-sm uppercase tracking-wider hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                        Ver Mujeres
                    </button>
                    <button class="border border-white text-white px-8 py-4 font-light text-sm uppercase tracking-wider hover:bg-white hover:text-black transition-all duration-300">
                        Ver Hombres
                    </button>
                </div>
                <div class="pt-8">
                    <a href="#descubre" class="inline-flex items-center text-white/80 hover:text-white transition-colors duration-300 font-light text-sm uppercase tracking-wider">
                        Comenzar con test de estilo
                        <i class="fas fa-arrow-right ml-3 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Bar -->
<section class="bg-white py-16 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                    <i class="fas fa-shipping-fast text-blue-600 text-xl"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Envío gratuito</h3>
                <p class="text-gray-600 text-sm font-light">En compras superiores a S/200</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                    <i class="fas fa-undo text-blue-600 text-xl"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Devoluciones</h3>
                <p class="text-gray-600 text-sm font-light">30 días para cambios gratuitos</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                    <i class="fas fa-eye text-blue-600 text-xl"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Exámenes</h3>
                <p class="text-gray-600 text-sm font-light">Evaluaciones visuales completas</p>
            </div>
            
            <div class="text-center group">
                <div class="w-16 h-16 mx-auto bg-blue-50 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-100 transition-colors duration-300">
                    <i class="fas fa-award text-blue-600 text-xl"></i>
                </div>
                <h3 class="font-light text-gray-900 mb-2 uppercase tracking-wider text-sm">Garantía</h3>
                <p class="text-gray-600 text-sm font-light">Calidad garantizada por 2 años</p>
            </div>
        </div>
    </div>
</section>


<section class="pt-20 pb-24 px-20 bg-gray-50">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-5xl font-extrabold text-gray-900 mb-12 text-center">Servicios Optométricos Profesionales</h1>
        <p class="max-w-3xl mx-auto text-center text-gray-700 text-lg font-light mb-16">
            En GRC Clínica Optométrica, combinamos experiencia y tecnología para ofrecerte servicios integrales que cuidan y mejoran tu salud visual.
        </p>

        <div class="space-y-20">
            <!-- Servicio 1 -->
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 rounded-3xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/services/examen-visual.jpg') }}" alt="Examen Visual Completo" class="w-full h-[360px] object-cover">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Examen Visual Completo</h2>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Evaluamos tu agudeza visual y salud ocular con equipos de última generación para detectar cualquier anomalía y ofrecerte un diagnóstico preciso y personalizado.
                    </p>
                    <a href="#contacto" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition text-lg shadow-lg">
                        Agenda tu cita
                    </a>
                </div>
            </div>

            <!-- Servicio 2 -->
            <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                <div class="lg:w-1/2 rounded-3xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/services/terapia-visual.jpg') }}" alt="Terapia Visual" class="w-full h-[360px] object-cover">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Terapia Visual</h2>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Tratamientos personalizados para mejorar la coordinación ocular, percepción visual y corregir problemas funcionales, ayudándote a recuperar la calidad de visión.
                    </p>
                    <a href="#contacto" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition text-lg shadow-lg">
                        Más información
                    </a>
                </div>
            </div>

            <!-- Servicio 3 -->
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 rounded-3xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/services/lentes-contacto.jpg') }}" alt="Adaptación de Lentes de Contacto" class="w-full h-[360px] object-cover">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Adaptación de Lentes de Contacto</h2>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Asesoramos y evaluamos para la correcta elección y uso de lentes de contacto, garantizando comodidad, seguridad y salud ocular.
                    </p>
                    <a href="#contacto" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition text-lg shadow-lg">
                        Consulta con un especialista
                    </a>
                </div>
            </div>

            <!-- Servicio 4 -->
            <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                <div class="lg:w-1/2 rounded-3xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/services/baja-vision.jpg') }}" alt="Atención en Baja Visión" class="w-full h-[360px] object-cover">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Atención en Baja Visión</h2>
                    <p class="text-gray-700 text-lg leading-relaxed mb-6">
                        Soluciones y dispositivos especializados para personas con baja visión, mejorando su calidad de vida y autonomía visual.
                    </p>
                    <a href="#contacto" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-blue-700 transition text-lg shadow-lg">
                        Conoce más
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contacto rápido -->
<section id="contacto" class="bg-white py-20 px-20">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 mb-6">¿Quieres agendar una cita o tienes dudas?</h2>
        <p class="text-gray-700 mb-10 max-w-2xl mx-auto font-light text-lg">
            Contáctanos y uno de nuestros especialistas te atenderá con gusto.
        </p>
        <a href="tel:+51987654321" class="inline-block bg-blue-600 text-white px-12 py-5 rounded-xl font-semibold text-xl hover:bg-blue-700 transition shadow-lg">
            Llámanos al +51 987 654 321
        </a>
    </div>
</section>


<section class="pt-16 px-4 md:px-20">
    <div class="flex flex-col md:flex-row md:space-x-6 space-y-12 md:space-y-0 justify-center items-start">
        @foreach($cardsSections as $i => $section)
            <div 
                class="rounded-3xl overflow-hidden shadow-xl bg-cover bg-center w-full md:w-1/3 flex flex-col justify-between min-h-[50rem]
                {{ $i == 1 ? 'md:mt-28' : 'md:mt-0' }}"
                style="background-image: url('{{ $section->image ? asset('storage/'.$section->image) : asset('images/card-default.jpg') }}');"
            >
                <div class="p-8 flex-1 flex flex-col justify-end bg-gradient-to-t from-black/70 to-transparent">
                    <h2 class="text-white text-3xl font-extrabold mb-6 drop-shadow-lg">{{ $section->title }}</h2>
                    @if($section->subtitle)
                        <button class="bg-white text-gray-900 font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-gray-100 transition text-lg">
                            {{ $section->subtitle }}
                        </button>
                    @else
                        <button class="bg-white text-gray-900 font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-gray-100 transition text-lg">
                            Ver más
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>




<!-- CTA Section -->
<section class="py-24 bg-white">
    <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
        <h2 class="text-4xl lg:text-5xl font-light text-gray-900 mb-8">
            ¿No estás seguro de tu estilo?
        </h2>
        <p class="text-xl text-gray-600 font-light mb-12 max-w-2xl mx-auto">
            Nuestro test de estilo personalizado te ayudará a encontrar la montura perfecta para tu rostro y personalidad
        </p>
        <button class="bg-blue-600 text-white px-12 py-4 font-light text-sm uppercase tracking-wider hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
            Comenzar Test de Estilo
        </button>
    </div>
</section>

@endsection