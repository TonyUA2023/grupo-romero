@extends('layouts.app')

@section('title', 'GRC Clínica Optométrica - Salud Visual de Calidad')
@section('description', 'Expertos en salud visual con tecnología de última generación. Exámenes completos, lentes de alta calidad y atención personalizada.')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 text-white">
    <!-- ... contenido hero ... -->
</section>

<!-- Servicios Destacados -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Servicios Destacados</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Soluciones avanzadas para todas tus necesidades visuales</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredServices as $service)  <!-- Cambiado a featuredServices -->
            <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                @if($service->image)
                <div class="h-64 overflow-hidden">
                    <img src="{{ asset('storage/' . $service->image) }}" 
                         alt="{{ $service->name }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $service->short_description }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="text-blue-600 font-semibold hover:text-blue-800 flex items-center">
                        Conocer más <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Resto del contenido... -->
@endsection