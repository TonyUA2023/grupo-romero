@extends('layouts.admin')

@section('title', 'Editar Ítem de Galería')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Editar Ítem de Galería</h2>
    
    <form action="{{ route('admin.gallery.update', $galleryItem) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
                @if($galleryItem->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $galleryItem->image) }}" alt="{{ $galleryItem->title }}" class="h-48 w-full object-cover rounded">
                    <a href="{{ asset('storage/' . $galleryItem->image) }}" target="_blank" class="text-sm text-blue-600 mt-1 block">Ver imagen actual</a>
                </div>
                @endif
                <input type="file" name="image" id="image" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $galleryItem->title) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Categoría *</label>
                <input type="text" name="category" id="category" value="{{ old('category', $galleryItem->category) }}" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       list="categories" required>
                <datalist id="categories">
                    @foreach($categories as $category)
                        <option value="{{ $category }}">
                    @endforeach
                </datalist>
            </div>
            
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="description" id="description" rows="3" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $galleryItem->description) }}</textarea>
            </div>
            
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
                <input type="number" name="order" id="order" value="{{ old('order', $galleryItem->order) }}" min="0" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            
            <div>
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1" 
                           {{ old('is_active', $galleryItem->is_active) ? 'checked' : '' }} 
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Activo</label>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Actualizar Ítem
            </button>
        </div>
    </form>
</div>
@endsection