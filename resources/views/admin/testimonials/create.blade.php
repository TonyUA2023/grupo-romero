@extends('layouts.admin')

@section('title', 'Crear Testimonio')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Crear Nuevo Testimonio</h2>
    
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
        </div>
        
        <div class="mb-4">
            <label for="position" class="block text-sm font-medium text-gray-700">Cargo</label>
            <input type="text" name="position" id="position" value="{{ old('position') }}" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
        
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
            <textarea name="content" id="content" rows="4" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('content') }}</textarea>
        </div>
        
        <div class="mb-4">
            <label for="rating" class="block text-sm font-medium text-gray-700">Valoración (1-5)</label>
            <select name="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                <option value="">Seleccione una valoración</option>
                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Imagen</label>
            <input type="file" name="image" id="image" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
        
        <div class="mb-4">
            <label for="order" class="block text-sm font-medium text-gray-700">Orden</label>
            <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
        
        <div class="mb-4">
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" 
                       {{ old('is_active', true) ? 'checked' : '' }} 
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <label for="is_active" class="ml-2 text-sm text-gray-700">Activo</label>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar Testimonio
            </button>
        </div>
    </form>
</div>
@endsection