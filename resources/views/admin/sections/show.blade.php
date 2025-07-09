@extends('layouts.admin')

@section('title', 'Detalles de la Sección')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">{{ $section->title ?? 'Sección sin título' }}</h2>
        <p class="text-gray-600 text-sm mt-1">Página: {{ $section->page->title }}</p>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                @if($section->image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $section->image) }}" 
                         alt="{{ $section->title ?? 'Imagen de sección' }}" 
                         class="w-full h-64 object-cover rounded-lg">
                </div>
                @endif
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Tipo:</span>
                        <span class="capitalize">{{ $section->type }}</span>
                    </div>
                    
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Estado:</span>
                        @if($section->is_active)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Activa
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Inactiva
                        </span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Orden:</span>
                        <span>{{ $section->order }}</span>
                    </div>
                    
                    @if($section->subtitle)
                    <div class="mt-4">
                        <h3 class="font-medium mb-2">Subtítulo</h3>
                        <p class="text-sm text-gray-700">{{ $section->subtitle }}</p>
                    </div>
                    @endif
                    
                    @if($section->data)
                    <div class="mt-4">
                        <h3 class="font-medium mb-2">Datos Adicionales</h3>
                        <pre class="text-xs bg-gray-100 p-2 rounded overflow-auto">{{ json_encode($section->data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Contenido</h3>
                <div class="prose max-w-none">
                    {!! $section->content !!}
                </div>
                
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('admin.sections.edit', $section) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i> Editar Sección
                    </a>
                    <form action="{{ route('admin.sections.destroy', $section) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                                onclick="return confirm('¿Estás seguro de eliminar esta sección?')">
                            <i class="fas fa-trash mr-2"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection