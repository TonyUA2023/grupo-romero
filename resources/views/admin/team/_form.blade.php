@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Columna Izquierda -->
    <div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nombre Completo *
            </label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $teamMember->name ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                Cargo / Posición *
            </label>
            <input type="text" name="position" id="position" 
                   value="{{ old('position', $teamMember->position ?? '') }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   required>
            @error('position')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="specialties">
                Especialidades
            </label>
            <input type="text" name="specialties" id="specialties" 
                   value="{{ old('specialties', $teamMember->specialties ?? '') }}"
                   placeholder="Oftalmología, Contactología, etc."
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('specialties')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="education">
                Formación Académica
            </label>
            <textarea name="education" id="education" rows="3"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('education', $teamMember->education ?? '') }}</textarea>
            @error('education')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- Columna Derecha -->
    <div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                Foto del Miembro
            </label>
            @if(isset($teamMember) && $teamMember->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $teamMember->image) }}" 
                         alt="Foto actual" class="w-32 h-32 object-cover rounded-lg mb-2">
                </div>
            @endif
            <input type="file" name="image" id="image" 
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Estado
            </label>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', $teamMember->is_active ?? true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Miembro activo</span>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="order">
                Orden de Visualización
            </label>
            <input type="number" name="order" id="order" min="0"
                   value="{{ old('order', $teamMember->order ?? 0) }}"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('order')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">
                Enlaces a Redes Sociales
            </label>
            <div id="socialLinksContainer">
                @php
                    $socialLinks = [];
                    if (isset($teamMember) && $teamMember->social_links) {
                        $decoded = json_decode($teamMember->social_links, true);
                        $socialLinks = is_array($decoded) ? $decoded : [];
                    }
                    
                    $socialPlatforms = [
                        'facebook' => 'Facebook',
                        'instagram' => 'Instagram',
                        'linkedin' => 'LinkedIn',
                        'twitter' => 'Twitter',
                        'youtube' => 'YouTube',
                        'whatsapp' => 'WhatsApp',
                    ];
                    $index = 0;
                @endphp
                
                @if(count($socialLinks) > 0)
                    @foreach($socialLinks as $platform => $url)
                    <div class="flex items-center mb-2">
                        <select name="social_links[{{ $index }}][platform]" 
                                class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                            <option value="">Seleccionar plataforma</option>
                            @foreach($socialPlatforms as $key => $label)
                                <option value="{{ $key }}" {{ $platform == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <input type="url" name="social_links[{{ $index }}][url]" 
                               value="{{ $url }}" 
                               placeholder="URL"
                               class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                        <button type="button" class="remove-social-link text-red-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    @php $index++; @endphp
                    @endforeach
                @endif
                
                <!-- Campo vacío para agregar nuevo -->
                <div class="flex items-center mb-2" id="newSocialLink">
                    <select name="social_links[{{ $index }}][platform]" 
                            class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                        <option value="">Seleccionar plataforma</option>
                        @foreach($socialPlatforms as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="url" name="social_links[{{ $index }}][url]" 
                           placeholder="URL"
                           class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <button type="button" id="addSocialLink" class="mt-2 bg-gray-200 text-gray-700 px-3 py-1 rounded text-sm hover:bg-gray-300">
                <i class="fas fa-plus mr-1"></i> Añadir otro
            </button>
        </div>
    </div>
</div>

<div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="bio">
        Biografía *
    </label>
    <textarea name="bio" id="editor" rows="10"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>{{ old('bio', $teamMember->bio ?? '') }}</textarea>
    @error('bio')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-end mt-6">
    <a href="{{ route('admin.team.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-3">
        Cancelar
    </a>
    <button type="submit" 
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        {{ isset($teamMember) ? 'Actualizar Miembro' : 'Crear Miembro' }}
    </button>
</div>

<script>
    // Contador para nuevos campos
    let socialLinkIndex = {{ count($socialLinks) }};
    
    document.getElementById('addSocialLink').addEventListener('click', function() {
        socialLinkIndex++;
        const container = document.getElementById('socialLinksContainer');
        const newSocialLink = document.getElementById('newSocialLink');
        
        const div = document.createElement('div');
        div.className = 'flex items-center mb-2';
        div.innerHTML = `
            <select name="social_links[${socialLinkIndex}][platform]" 
                    class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                <option value="">Seleccionar plataforma</option>
                @foreach($socialPlatforms as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
            <input type="url" name="social_links[${socialLinkIndex}][url]" 
                   placeholder="URL"
                   class="shadow appearance-none border rounded w-2/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
            <button type="button" class="remove-social-link text-red-500">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        container.insertBefore(div, newSocialLink);
    });

    // Event delegation para botones de eliminar
    document.getElementById('socialLinksContainer').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-social-link') || 
            e.target.parentElement.classList.contains('remove-social-link')) {
            const div = e.target.closest('div');
            if (div && div.id !== 'newSocialLink') {
                div.remove();
            }
        }
    });
</script>