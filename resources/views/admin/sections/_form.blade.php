@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Columna Izquierda -->
    <div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="page_id">
                Página *
            </label>
            <select name="page_id" id="page_id" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Seleccione una página</option>
                @foreach($pages as $page)
                    <option value="{{ $page->id }}"
                        {{ old('page_id', $section->page_id ?? '') == $page->id ? 'selected' : '' }}>
                        {{ $page->title }}
                    </option>
                @endforeach
            </select>
            @error('page_id')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                Tipo de Sección *
            </label>
            <select name="type" id="type" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Seleccione un tipo</option>
                @foreach($sectionTypes as $key => $label)
                    <option value="{{ $key }}"
                        {{ old('type', $section->type ?? '') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('type')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Título
            </label>
            <input type="text" name="title" id="title" 
                   value="{{ old('title', $section->title ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="subtitle">
                Subtítulo
            </label>
            <input type="text" name="subtitle" id="subtitle" 
                   value="{{ old('subtitle', $section->subtitle ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('subtitle')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                Imagen
            </label>
            @if(isset($section) && $section->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $section->image) }}" 
                         alt="Imagen actual" class="w-32 h-32 object-cover rounded-lg mb-2">
                </div>
            @endif
            <input type="file" name="image" id="image" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('image')
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
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Sección activa</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="order">
                Orden de Visualización
            </label>
            <input type="number" name="order" id="order" min="0"
                   value="{{ old('order', $section->order ?? 0) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('order')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <!-- Campo para datos adicionales (dependiendo del tipo de sección) -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="data">
                Datos Adicionales (JSON)
            </label>
            <textarea name="data" id="data" rows="5"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('data', $section?->data ? json_encode($section->data) : '') }}
</textarea>
            @error('data')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
            <p class="text-xs text-gray-500 mt-1">
                Formato JSON. Ejemplo para features: [{"icon":"fas fa-glasses","title":"Título","description":"Descripción"}]
            </p>
        </div>
    </div>
</div>

<div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
        Contenido
    </label>
    <textarea name="content" id="editor" rows="10"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('content', $section->content ?? '') }}</textarea>
    @error('content')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.sections.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-3">
        Cancelar
    </a>
    <button type="submit" 
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        {{ isset($section) ? 'Actualizar Sección' : 'Crear Sección' }}
    </button>
</div>