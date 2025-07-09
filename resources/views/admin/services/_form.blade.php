@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Columna Izquierda -->
    <div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nombre del Servicio *
            </label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $service->name ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
                Slug (URL) *
            </label>
            <input type="text" name="slug" id="slug" 
                   value="{{ old('slug', $service->slug ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
            @error('slug')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="short_description">
                Descripción Corta *
            </label>
            <textarea name="short_description" id="short_description" rows="2"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      required>{{ old('short_description', $service->short_description ?? '') }}</textarea>
            @error('short_description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                Precio (S/) *
            </label>
            <input type="number" name="price" id="price" step="0.01" min="0"
                   value="{{ old('price', $service->price ?? '0') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
            @error('price')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                Duración (ej: 60 minutos)
            </label>
            <input type="text" name="duration" id="duration" 
                   value="{{ old('duration', $service->duration ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('duration')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Columna Derecha -->
    <div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                Imagen Destacada
            </label>
            @if(isset($service) && $service->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $service->image) }}" 
                         alt="Imagen actual" class="w-32 h-32 object-cover rounded-lg mb-2">
                </div>
            @endif
            <input type="file" name="image" id="image" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="icon">
                Ícono (Font Awesome)
            </label>
            <input type="text" name="icon" id="icon" 
                   value="{{ old('icon', $service->icon ?? '') }}"
                   placeholder="fas fa-glasses"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('icon')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1">
                Ejemplos: fas fa-glasses, fas fa-eye, fas fa-user-md
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Destacado
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="featured" value="1"
                           {{ old('featured', $service->featured ?? false) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Marcar como destacado</span>
                </label>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Estado
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Activo</span>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="order">
                Orden de Visualización
            </label>
            <input type="number" name="order" id="order" min="0"
                   value="{{ old('order', $service->order ?? 0) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('order')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
        Descripción Completa *
    </label>
    <textarea name="description" id="editor" rows="10"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>{{ old('description', $service->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.services.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-3">
        Cancelar
    </a>
    <button type="submit" 
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        {{ isset($service) ? 'Actualizar Servicio' : 'Crear Servicio' }}
    </button>
</div>

@if(isset($service))
    <script>
        // Auto-generar slug si está vacío
        document.getElementById('name').addEventListener('input', function() {
            if (!document.getElementById('slug').value) {
                const slug = this.value.toLowerCase()
                    .replace(/[^\w\s]/gi, '')
                    .replace(/\s+/g, '-');
                document.getElementById('slug').value = slug;
            }
        });
    </script>
@endif