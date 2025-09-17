@extends('layouts.admin')

@section('title', 'Detalle del Producto')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">SKU: {{ $product->sku }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.catalog.products.edit', $product) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Editar
                    </a>
                    <form action="{{ route('admin.catalog.products.destroy', $product) }}" 
                          method="POST" 
                          class="inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                            <i class="fas fa-trash mr-2"></i>
                            Eliminar
                        </button>
                    </form>
                    <a href="{{ route('admin.catalog.products.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Images and Gallery -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Main Image -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Imagen Principal</h3>
                <div class="relative">
                    <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/400' }}" 
                         alt="{{ $product->name }}"
                         class="w-full rounded-lg shadow-sm"
                         id="mainImage">
                    
                    @if($product->sale_price)
                        <span class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                            -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                        </span>
                    @endif
                </div>
            </div>

            <!-- Model Image -->
            @if($product->model_image)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-user-friends mr-2 text-blue-500"></i>
                        Imagen con Modelo
                    </h3>
                    <div class="relative">
                        <img src="{{ $product->model_image_url }}" 
                             alt="{{ $product->name }} con modelo"
                             class="w-full rounded-lg shadow-sm cursor-pointer hover:opacity-90 transition"
                             onclick="changeMainImage('{{ $product->model_image_url }}')">
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Haz clic para ver como imagen principal</p>
                </div>
            @endif

            <!-- Image Gallery -->
            @if($product->images->count() > 0 || $product->featured_image)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Galería de Imágenes</h3>
                    <div class="grid grid-cols-3 gap-3">
                        @if($product->featured_image)
                            <img src="{{ asset('storage/' . $product->featured_image) }}" 
                                 alt="Imagen principal"
                                 class="w-full h-20 object-cover rounded cursor-pointer hover:opacity-80 transition"
                                 onclick="changeMainImage('{{ asset('storage/' . $product->featured_image) }}')">
                        @endif
                        @if($product->model_image)
                            <img src="{{ $product->model_image_url }}" 
                                 alt="Imagen con modelo"
                                 class="w-full h-20 object-cover rounded cursor-pointer hover:opacity-80 transition border-2 border-blue-200"
                                 onclick="changeMainImage('{{ $product->model_image_url }}')">
                        @endif
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                 alt="Imagen adicional"
                                 class="w-full h-20 object-cover rounded cursor-pointer hover:opacity-80 transition"
                                 onclick="changeMainImage('{{ asset('storage/' . $image->image_path) }}')">
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Status Badges -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Estado del Producto</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Estado:</span>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                        </span>
                    </div>
                    
                    @if($product->is_featured)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Destacado:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-star mr-1"></i> Sí
                            </span>
                        </div>
                    @endif
                    
                    @if($product->is_new)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Producto nuevo:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-tag mr-1"></i> Nuevo
                            </span>
                        </div>
                    @endif

                    @if($product->model_image)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Con modelo:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                                <i class="fas fa-user-friends mr-1"></i> Sí
                            </span>
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Orden:</span>
                        <span class="font-medium">{{ $product->order }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Product Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">URL (Slug)</label>
                        <p class="mt-1 text-gray-900">{{ $product->slug }}</p>
                    </div>
                    
                    @if($product->short_description)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Descripción Corta</label>
                            <p class="mt-1 text-gray-900">{{ $product->short_description }}</p>
                        </div>
                    @endif
                    
                    @if($product->description)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Descripción Completa</label>
                            <div class="mt-1 text-gray-900 prose max-w-none">
                                {!! nl2br(e($product->description)) !!}
                            </div>
                        </div>
                    @endif

                    @if($product->link)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Enlace Externo</label>
                            <p class="mt-1 text-gray-900">
                                <a href="{{ $product->link }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ $product->link }}
                                </a>
                            </p>
                        </div>
                    @endif

                    @if($product->video)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Video</label>
                            <div class="mt-1">
                                @if(preg_match('/youtube\.com|youtu\.be/', $product->video))
                                    <iframe width="100%" height="315" src="{{ $product->video }}" frameborder="0" allowfullscreen class="rounded-lg"></iframe>
                                @else
                                    <video width="100%" controls class="rounded-lg">
                                        <source src="{{ $product->video }}" type="video/mp4">
                                        Tu navegador no soporta el elemento de video.
                                    </video>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pricing Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Precios</h3>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Precio Regular</label>
                        <p class="mt-1 text-2xl font-bold text-gray-900">S/ {{ number_format($product->price, 2) }}</p>
                    </div>
                    
                    @if($product->sale_price)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Precio de Oferta</label>
                            <p class="mt-1 text-2xl font-bold text-red-600">S/ {{ number_format($product->sale_price, 2) }}</p>
                            <p class="text-sm text-green-600 mt-1">
                                Ahorro: S/ {{ number_format($product->price - $product->sale_price, 2) }} 
                                ({{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%)
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Category and Brand -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Categorización</h3>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Categoría</label>
                        <p class="mt-1 text-gray-900">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-folder mr-2"></i>{{ $product->category->name }}
                            </span>
                        </p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Marca</label>
                        <p class="mt-1 text-gray-900">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-tag mr-2"></i>{{ $product->brand->name }}
                            </span>
                        </p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Género</label>
                        <p class="mt-1 text-gray-900 capitalize">{{ $product->gender }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tipo</label>
                        <p class="mt-1 text-gray-900 capitalize">{{ $product->type }}</p>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detalles del Producto</h3>
                
                <div class="grid grid-cols-2 gap-6">
                    @if($product->frame_material)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Material de la Montura</label>
                            <p class="mt-1 text-gray-900">{{ $product->frame_material }}</p>
                        </div>
                    @endif
                    
                    @if($product->frame_color)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Color de la Montura</label>
                            <p class="mt-1 text-gray-900">{{ $product->frame_color }}</p>
                        </div>
                    @endif
                    
                    @if($product->lens_type)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tipo de Lente</label>
                            <p class="mt-1 text-gray-900">{{ $product->lens_type }}</p>
                        </div>
                    @endif
                    
                    @if($product->lens_color)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Color del Lente</label>
                            <p class="mt-1 text-gray-900">{{ $product->lens_color }}</p>
                        </div>
                    @endif
                    
                    @if($product->size)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Talla</label>
                            <p class="mt-1 text-gray-900">{{ $product->size }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Features -->
            @if($product->features->count() > 0)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Características del Producto</h3>
                    
                    <div class="space-y-3">
                        @foreach($product->features->sortBy('order') as $feature)
                            <div class="flex items-center py-2 border-b border-gray-100 last:border-0">
                                <span class="text-gray-600 flex-1">{{ $feature->name }}:</span>
                                <span class="text-gray-900 font-medium">{{ $feature->value }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- SEO Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información SEO</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Meta Título</label>
                        <p class="mt-1 text-gray-900">{{ $product->meta_title ?: 'No especificado' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Meta Descripción</label>
                        <p class="mt-1 text-gray-900">{{ $product->meta_description ?: 'No especificado' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Palabras Clave</label>
                        <p class="mt-1 text-gray-900">
                            @if($product->meta_keywords)
                                @foreach(explode(',', $product->meta_keywords) as $keyword)
                                    <span class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-medium text-gray-700 mr-2 mb-2">
                                        {{ trim($keyword) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500">No especificado</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Sistema</h3>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Fecha de Creación</label>
                        <p class="mt-1 text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Última Actualización</label>
                        <p class="mt-1 text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                ID del Producto: <span class="font-medium text-gray-900">#{{ $product->id }}</span>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.catalog.products.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Crear Nuevo Producto
                </a>
                <a href="{{ route('admin.catalog.products.edit', $product) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Editar Este Producto
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function changeMainImage(imageSrc) {
    document.getElementById('mainImage').src = imageSrc;
}
</script>
@endsection