@csrf

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Columna Izquierda -->
    <div class="md:col-span-2">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Título de la Página *
            </label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title', $page->title ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
            @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="slug">
                Slug (URL) *
            </label>
            <div class="flex items-center">
                <span class="bg-gray-200 text-gray-700 px-3 py-2 rounded-l">/</span>
                <input type="text" name="slug" id="slug" 
                       value="{{ old('slug', $page->slug ?? '') }}"
                       class="shadow appearance-none border rounded-r w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       required>
            </div>
            @error('slug')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="featured_image">
                Imagen Destacada
            </label>
            @if(isset($page) && $page->featured_image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $page->featured_image) }}" 
                         alt="Imagen actual" class="w-64 h-48 object-cover rounded-lg mb-2">
                </div>
            @endif
            <input type="file" name="featured_image" id="featured_image" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('featured_image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Columna Derecha -->
    <div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Estado
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1"
                       {{ old('status', $page->status ?? true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Página activa</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="order">
                Orden de Visualización
            </label>
            <input type="number" name="order" id="order" min="0"
                   value="{{ old('order', $page->order ?? 0) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('order')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="meta_title">
                Meta Título (SEO)
            </label>
            <input type="text" name="meta_title" id="meta_title" 
                   value="{{ old('meta_title', $page->meta_title ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('meta_title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="meta_description">
                Meta Descripción (SEO)
            </label>
            <textarea name="meta_description" id="meta_description" rows="3"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
            @error('meta_description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="meta_keywords">
                Meta Keywords (SEO)
            </label>
            <input type="text" name="meta_keywords" id="meta_keywords" 
                   value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('meta_keywords')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
        Contenido de la Página *
    </label>
    <textarea name="content" id="editor" rows="15"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>{{ old('content', $page->content ?? '') }}</textarea>
    @error('content')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.pages.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-3">
        Cancelar
    </a>
    <button type="submit" 
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        {{ isset($page) ? 'Actualizar Página' : 'Crear Página' }}
    </button>
</div>

@if(!isset($page))
    <script>
        // Auto-generar slug si está vacío
        document.getElementById('title').addEventListener('input', function() {
            if (!document.getElementById('slug').value) {
                const slug = this.value.toLowerCase()
                    .replace(/[^\w\s]/gi, '')
                    .replace(/\s+/g, '-');
                document.getElementById('slug').value = slug;
            }
        });
    </script>
@endif