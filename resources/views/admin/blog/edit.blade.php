@extends('layouts.admin')

@section('title', 'Editar Artículo')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Editar Artículo</h2>
    
    <form action="{{ route('admin.blog.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Columna Izquierda -->
            <div>
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Título *</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
                
                <div class="mb-4">
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug *</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
                
                <div class="mb-4">
                    <label for="excerpt" class="block text-sm font-medium text-gray-700">Resumen *</label>
                    <textarea name="excerpt" id="excerpt" rows="3" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('excerpt', $post->excerpt) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Máximo 300 caracteres</p>
                </div>
                
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Contenido *</label>
                    <textarea name="content" id="content" rows="10" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 editor" required>{{ old('content', $post->content) }}</textarea>
                </div>
            </div>
            
            <!-- Columna Derecha -->
            <div>
                <div class="mb-4">
                    <label for="featured_image" class="block text-sm font-medium text-gray-700">Imagen Destacada</label>
                    @if($post->featured_image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="h-48 w-full object-cover rounded">
                        <a href="{{ asset('storage/' . $post->featured_image) }}" target="_blank" class="text-sm text-blue-600 mt-1 block">Ver imagen actual</a>
                    </div>
                    @endif
                    <input type="file" name="featured_image" id="featured_image" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                    <input type="text" name="category" id="category" value="{{ old('category', $post->category) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                           list="categories">
                    <datalist id="categories">
                        @foreach($categories as $category)
                            <option value="{{ $category }}">
                        @endforeach
                    </datalist>
                </div>
                
                <div class="mb-4">
                    <label for="tags" class="block text-sm font-medium text-gray-700">Etiquetas</label>
                    <input type="text" name="tags" id="tags" value="{{ old('tags', $post->tags ? implode(', ', $post->tags) : '') }}" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <p class="mt-1 text-sm text-gray-500">Separadas por comas</p>
                </div>
                
                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-700">Autor *</label>
                    <input type="text" name="author" id="author" value="{{ old('author', $post->author) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>
                
                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" 
                               {{ old('is_published', $post->is_published) ? 'checked' : '' }} 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <label for="is_published" class="ml-2 text-sm text-gray-700">Publicado</label>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="published_at" class="block text-sm font-medium text-gray-700">Fecha de Publicación</label>
                    <input type="datetime-local" name="published_at" id="published_at" 
                           value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>
                
                <div class="border-t border-gray-200 pt-4 mb-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">SEO</h3>
                    
                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Título</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <p class="mt-1 text-sm text-gray-500">Máximo 60 caracteres</p>
                    </div>
                    
                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Descripción</label>
                        <textarea name="meta_description" id="meta_description" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('meta_description', $post->meta_description) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Máximo 160 caracteres</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                <i class="fas fa-save mr-2"></i> Actualizar Artículo
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Inicializar editor WYSIWYG
    ClassicEditor
        .create(document.querySelector('.editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
@endsection