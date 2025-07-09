@extends('layouts.admin')

@section('title', 'Detalles de la Página')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">{{ $page->title }}</h2>
        <p class="text-gray-600 text-sm mt-1">Slug: /{{ $page->slug }}</p>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                @if($page->featured_image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $page->featured_image) }}" 
                         alt="{{ $page->title }}" 
                         class="w-full h-64 object-cover rounded-lg">
                </div>
                @endif
                
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between mb-3">
                        <span class="font-medium">Estado:</span>
                        @if($page->status)
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
                        <span>{{ $page->order }}</span>
                    </div>
                    
                    <div class="mt-4">
                        <h3 class="font-medium mb-2">SEO</h3>
                        <p class="text-sm text-gray-700"><strong>Meta Título:</strong> {{ $page->meta_title }}</p>
                        <p class="text-sm text-gray-700 mt-1"><strong>Meta Descripción:</strong> {{ $page->meta_description }}</p>
                        <p class="text-sm text-gray-700 mt-1"><strong>Keywords:</strong> {{ $page->meta_keywords }}</p>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Contenido de la Página</h3>
                <div class="prose max-w-none">
                    {!! $page->content !!}
                </div>
                
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('admin.pages.edit', $page) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fas fa-edit mr-2"></i> Editar Página
                    </a>
                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                                onclick="return confirm('¿Estás seguro de eliminar esta página?')">
                            <i class="fas fa-trash mr-2"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection