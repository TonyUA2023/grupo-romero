@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Salud Visual de Calidad')
@section('description', 'Expertos en salud visual con tecnología de última generación. Exámenes completos, lentes de alta calidad y atención personalizada.')

@section('content')


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