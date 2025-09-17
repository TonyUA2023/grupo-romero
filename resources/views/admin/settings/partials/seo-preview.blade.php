@php
    // Obtener valores actuales de SEO
    $metaTitle = '';
    $metaDescription = '';
    $siteName = '';
    
    foreach($settings as $setting) {
        if ($setting->key === 'meta_title') {
            $metaTitle = $setting->value;
        } elseif ($setting->key === 'meta_description') {
            $metaDescription = $setting->value;
        }
    }
    
    // Intentar obtener el nombre del sitio del grupo general
    $generalSettings = \App\Models\Setting::where('group', 'general')->get();
    foreach($generalSettings as $setting) {
        if ($setting->key === 'site_name') {
            $siteName = $setting->value;
            break;
        }
    }
    
    $previewTitle = $metaTitle ?: $siteName ?: 'Título de tu página';
    $previewDescription = $metaDescription ?: 'La descripción de tu página aparecerá aquí. Es importante para el SEO y para atraer visitantes desde los motores de búsqueda.';
@endphp

<div class="mt-8 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6">
    <h4 class="text-lg font-medium text-gray-900 mb-4">
        <i class="fas fa-eye mr-2 text-gray-400"></i>
        Vista Previa en Buscadores
    </h4>
    
    <!-- Google Search Preview -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="space-y-2">
            <!-- URL -->
            <div class="flex items-center text-sm">
                <span class="text-gray-600">{{ request()->getHost() }}</span>
                <svg class="w-4 h-4 mx-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-600">inicio</span>
            </div>
            
            <!-- Title -->
            <h3 class="text-xl text-blue-700 hover:underline cursor-pointer leading-tight">
                <span id="preview-title">{{ $previewTitle }}</span>
            </h3>
            
            <!-- Description -->
            <p class="text-sm text-gray-600 leading-relaxed">
                <span id="preview-description">{{ $previewDescription }}</span>
            </p>
        </div>
    </div>

    <!-- Character Counter Info -->
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-gray-700">Título SEO</span>
                <span class="text-xs text-gray-500">
                    <span id="seo-title-length">{{ strlen($metaTitle) }}</span> / 60 caracteres
                </span>
            </div>
            <div class="mt-2 text-xs text-gray-500">
                @if(strlen($metaTitle) < 30)
                    <span class="text-amber-600">⚠️ Muy corto - intenta usar más palabras clave</span>
                @elseif(strlen($metaTitle) <= 60)
                    <span class="text-green-600">✓ Longitud óptima</span>
                @else
                    <span class="text-red-600">⚠️ Demasiado largo - será truncado</span>
                @endif
            </div>
        </div>
        
        <div class="bg-white rounded-lg p-4 border border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-gray-700">Meta Descripción</span>
                <span class="text-xs text-gray-500">
                    <span id="seo-desc-length">{{ strlen($metaDescription) }}</span> / 160 caracteres
                </span>
            </div>
            <div class="mt-2 text-xs text-gray-500">
                @if(strlen($metaDescription) < 120)
                    <span class="text-amber-600">⚠️ Muy corta - aprovecha el espacio disponible</span>
                @elseif(strlen($metaDescription) <= 160)
                    <span class="text-green-600">✓ Longitud óptima</span>
                @else
                    <span class="text-red-600">⚠️ Demasiado larga - será truncada</span>
                @endif
            </div>
        </div>
    </div>

    <!-- SEO Tips -->
    <div class="mt-4 bg-blue-50 rounded-lg p-4">
        <h5 class="text-sm font-medium text-blue-900 mb-2">
            <i class="fas fa-lightbulb mr-2"></i>
            Consejos SEO
        </h5>
        <ul class="text-xs text-blue-700 space-y-1">
            <li>• Incluye palabras clave relevantes en el título y descripción</li>
            <li>• El título debe ser único y descriptivo (50-60 caracteres)</li>
            <li>• La descripción debe invitar al clic (150-160 caracteres)</li>
            <li>• Evita duplicar contenido entre páginas</li>
        </ul>
    </div>
</div>

<script>
    // Update SEO preview in real-time
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('meta_title');
        const descInput = document.getElementById('meta_description');
        
        if (titleInput) {
            titleInput.addEventListener('input', function() {
                const preview = document.getElementById('preview-title');
                const counter = document.getElementById('seo-title-length');
                
                if (preview) {
                    preview.textContent = this.value || '{{ $siteName ?: "Título de tu página" }}';
                }
                if (counter) {
                    counter.textContent = this.value.length;
                }
            });
        }
        
        if (descInput) {
            descInput.addEventListener('input', function() {
                const preview = document.getElementById('preview-description');
                const counter = document.getElementById('seo-desc-length');
                
                if (preview) {
                    preview.textContent = this.value || 'La descripción de tu página aparecerá aquí. Es importante para el SEO y para atraer visitantes desde los motores de búsqueda.';
                }
                if (counter) {
                    counter.textContent = this.value.length;
                }
            });
        }
    });
</script>