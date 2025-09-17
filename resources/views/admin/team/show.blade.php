@extends('layouts.admin')

@section('title', 'Detalles del Miembro')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">{{ $teamMember->name }}</h2>
        <p class="text-gray-600 text-sm mt-1">{{ $teamMember->position }}</p>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                @if($teamMember->image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $teamMember->image) }}" 
                         alt="{{ $teamMember->name }}" 
                         class="w-full h-64 object-cover rounded-lg">
                </div>
                @endif
                
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($teamMember->specialties)
                    <div class="mb-4">
                        <h3 class="font-medium mb-2">Especialidades</h3>
                        <p class="text-sm text-gray-700">{{ $teamMember->specialties }}</p>
                    </div>
                    @endif
                    
                    @if($teamMember->education)
                    <div class="mb-4">
                        <h3 class="font-medium mb-2">Formación Académica</h3>
                        <p class="text-sm text-gray-700">{{ $teamMember->education }}</p>
                    </div>
                    @endif
                    
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Estado:</span>
                        @if($teamMember->is_active)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Activo
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Inactivo
                        </span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="font-medium">Orden:</span>
                        <span>{{ $teamMember->order }}</span>
                    </div>
                    
                    @if($teamMember->social_links)
                    @php
                        $socialLinks = json_decode($teamMember->social_links, true);
                    @endphp
                    @if(is_array($socialLinks) && count($socialLinks) > 0)
                    <div class="mt-4">
                        <h3 class="font-medium mb-2">Redes Sociales</h3>
                        <div class="flex space-x-3">
                            @foreach($socialLinks as $platform => $url)
                            <a href="{{ $url }}" target="_blank" class="text-blue-500 hover:text-blue-700">
                                <i class="fab fa-{{ $platform }} text-lg"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
            
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Biografía</h3>
                <div class="prose max-w-none">
                    {!! $teamMember->bio !!}
                </div>
                
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('admin.team.edit', $teamMember) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i> Editar Miembro
                    </a>
                    <form action="{{ route('admin.team.destroy', $teamMember) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                                onclick="return confirm('¿Estás seguro de eliminar este miembro?')">
                            <i class="fas fa-trash mr-2"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection