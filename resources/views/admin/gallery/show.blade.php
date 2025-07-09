@extends('layouts.admin')

@section('title', $galleryItem->title)

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Detalle del Ítem de Galería</h2>
    
    <div class="mb-6">
        <img src="{{ asset('storage/' . $galleryItem->image) }}" 
             alt="{{ $galleryItem->title }}" 
             class="w-full h-96 object-cover rounded-lg">
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Título</h3>
            <p class="text-gray-700">{{ $galleryItem->title }}</p>
        </div>
        
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Categoría</h3>
            <p class="text-gray-700">{{ $galleryItem->category }}</p>
        </div>
        
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Estado</h3>
            @if($galleryItem->is_active)
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Activo
                </span>
            @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Inactivo
                </span>
            @endif
        </div>
        
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Orden</h3>
            <p class="text-gray-700">{{ $galleryItem->order }}</p>
        </div>
    </div>
    
    <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-2">Descripción</h3>
        <p class="text-gray-700">{{ $galleryItem->description ?? 'Sin descripción' }}</p>
    </div>
    
    <div class="flex justify-end">
        <a href="{{ route('admin.gallery.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 mr-2">
            Volver
        </a>
        <a href="{{ route('admin.gallery.edit', $galleryItem) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Editar
        </a>
    </div>
</div>
@endsection