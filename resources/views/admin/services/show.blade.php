@extends('layouts.admin')

@section('title', 'Detalles del Servicio')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">{{ $service->name }}</h2>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" 
                     alt="{{ $service->name }}" 
                     class="w-full h-64 object-cover rounded-lg mb-4">
                @endif
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Precio:</span>
                        <span class="text-blue-600 font-bold">S/ {{ number_format($service->price, 2) }}</span>
                    </div>
                    
                    @if($service->duration)
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Duración:</span>
                        <span>{{ $service->duration }}</span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Estado:</span>
                        @if($service->is_active)
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
                        <span class="font-medium">Destacado:</span>
                        @if($service->featured)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Sí
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            No
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-800 mb-2">Descripción Corta</h3>
                <p class="text-gray-600 mb-6">{{ $service->short_description }}</p>
                
                <h3 class="text-lg font-medium text-gray-800 mb-2">Descripción Completa</h3>
                <div class="prose max-w-none">
                    {!! $service->description !!}
                </div>
                
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('admin.services.edit', $service) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i> Editar Servicio
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                                onclick="return confirm('¿Estás seguro de eliminar este servicio?')">
                            <i class="fas fa-trash mr-2"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection