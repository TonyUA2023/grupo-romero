@extends('layouts.admin')

@section('title', $post->title)

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-start mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">{{ $post->title }}</h2>
            <div class="flex items-center mt-2">
                <span class="text-sm text-gray-600 mr-4">
                    <i class="fas fa-user mr-1"></i> {{ $post->author }}
                </span>
                @if($post->published_at)
                <span class="text-sm text-gray-600 mr-4">
                    <i class="fas fa-calendar mr-1"></i> {{ $post->published_at->format('d M Y') }}
                </span>
                @endif
                <span class="text-sm text-gray-600">
                    <i class="fas fa-eye mr-1"></i> {{ $post->views }} vistas
                </span>
            </div>
        </div>
        
        <div>
            @if($post->is_published)
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                Publicado
            </span>
            @else
            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                Borrador
            </span>
            @endif
        </div>
    </div>
    
    @if($post->featured_image)
    <div class="mb-6">
        <img src="{{ asset('storage/' . $post->featured_image) }}" 
             alt="{{ $post->title }}" 
             class="w-full h-96 object-cover rounded-lg">
    </div>
    @endif
    
    <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-2">Resumen</h3>
        <p class="text-gray-700">{{ $post->excerpt }}</p>
    </div>
    
    <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-2">Contenido</h3>
        <div class="prose max-w-none">
            {!! $post->content !!}
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
            <h4 class="text-md font-medium text-gray-900 mb-2">Categoría</h4>
            <p class="text-gray-700">{{ $post->category ?? 'Sin categoría' }}</p>
        </div>
        
        <div>
            <h4 class="text-md font-medium text-gray-900 mb-2">Etiquetas</h4>
            <div class="flex flex-wrap gap-2">
                @if($post->tags)
                    @foreach(json_decode($post->tags) as $tag)
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">
                            {{ $tag }}
                        </span>
                    @endforeach
                @else
                    <p class="text-gray-500">Sin etiquetas</p>
                @endif
            </div>
        </div>
        
        <div>
            <h4 class="text-md font-medium text-gray-900 mb-2">Slug</h4>
            <p class="text-gray-700">/{{ $post->slug }}</p>
        </div>
    </div>
    
    <div class="border-t border-gray-200 pt-4">
        <h4 class="text-lg font-medium text-gray-900 mb-3">SEO</h4>
        
        <div class="mb-3">
            <p class="text-sm font-medium text-gray-700">Meta Título:</p>
            <p class="text-gray-700">{{ $post->meta_title ?? 'No definido' }}</p>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700">Meta Descripción:</p>
            <p class="text-gray-700">{{ $post->meta_description ?? 'No definida' }}</p>
        </div>
    </div>
    
    <div class="flex justify-end mt-8">
        <a href="{{ route('admin.blog.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 mr-2">
            <i class="fas fa-arrow-left mr-2"></i> Volver
        </a>
        <a href="{{ route('admin.blog.edit', $post) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            <i class="fas fa-edit mr-2"></i> Editar Artículo
        </a>
    </div>
</div>
@endsection