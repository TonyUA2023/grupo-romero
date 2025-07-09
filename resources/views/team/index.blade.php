@extends('layouts.app')

@section('title', 'Nuestro Equipo - GRC Clínica Optométrica')

@section('content')
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nuestro Equipo</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Profesionales dedicados al cuidado de tu visión</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($teamMembers as $member)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="relative h-80">
                    @if($member->image)
                    <img src="{{ asset('storage/' . $member->image) }}" 
                         alt="{{ $member->name }}" 
                         class="w-full h-full object-cover">
                    @else
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-full flex items-center justify-center text-gray-500">
                        <i class="fas fa-user text-6xl"></i>
                    </div>
                    @endif
                    
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                        <h3 class="text-white text-2xl font-bold">{{ $member->name }}</h3>
                        <p class="text-blue-300">{{ $member->position }}</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Especialidades</h4>
                    <p class="text-gray-600 mb-4">{{ $member->specialties }}</p>
                    
                    <h4 class="text-lg font-semibold text-gray-800 mb-3">Formación</h4>
                    <p class="text-gray-600">{{ $member->education }}</p>
                    
                    @if($member->social_links)
                    <div class="flex space-x-4 mt-4">
                        @foreach(json_decode($member->social_links, true) as $platform => $link)
                        @if($link)
                        <a href="{{ $link }}" target="_blank" class="text-gray-600 hover:text-blue-600">
                            <i class="fab fa-{{ $platform }} text-xl"></i>
                        </a>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection