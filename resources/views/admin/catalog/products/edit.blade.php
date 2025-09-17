@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-semibold text-gray-800">Editar Producto</h2>
                <a href="{{ route('admin.catalog.products.index') }}" 
                   class="text-gray-600 hover:text-gray-900 transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Volver
                </a>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.catalog.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nombre del Producto <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $product->name) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                                    Slug (URL) <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="slug" 
                                       id="slug" 
                                       value="{{ old('slug', $product->slug) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('slug') border-red-500 @enderror"
                                       required>
                                @error('slug')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">
                                    SKU <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="sku" 
                                       id="sku" 
                                       value="{{ old('sku', $product->sku) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sku') border-red-500 @enderror"
                                       required>
                                @error('sku')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Descripción Corta
                                </label>
                                <textarea name="short_description" 
                                          id="short_description" 
                                          rows="3"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('short_description') border-red-500 @enderror"
                                          maxlength="500">{{ old('short_description', $product->short_description) }}</textarea>
                                @error('short_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Descripción Completa
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          rows="6"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="link" class="block text-sm font-medium text-gray-700 mb-1">
                                    Enlace Externo
                                </label>
                                <input type="url" 
                                       name="link" 
                                       id="link" 
                                       value="{{ old('link', $product->link) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('link') border-red-500 @enderror"
                                       placeholder="Ej: https://www.youtube.com/watch?v=VIDEO_ID">
                                @error('link')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Precios</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Precio Regular <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">S/</span>
                                    <input type="number" 
                                           name="price" 
                                           id="price" 
                                           value="{{ old('price', $product->price) }}"
                                           step="0.01"
                                           min="0"
                                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                                           required>
                                </div>
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Precio de Oferta
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">S/</span>
                                    <input type="number" 
                                           name="sale_price" 
                                           id="sale_price" 
                                           value="{{ old('sale_price', $product->sale_price) }}"
                                           step="0.01"
                                           min="0"
                                           class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sale_price') border-red-500 @enderror">
                                </div>
                                @error('sale_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Images and Video -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Imágenes y Video</h3>
                        
                        <div class="space-y-4">
                            <!-- Featured Image -->
                            <div>
                                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">
                                    Imagen Principal
                                </label>
                                
                                @if($product->featured_image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $product->featured_image) }}" 
                                             alt="Imagen principal actual" 
                                             class="w-32 h-24 object-cover rounded-lg">
                                        <p class="text-sm text-gray-500 mt-1">Imagen principal actual</p>
                                    </div>
                                @endif
                                
                                <input type="file" 
                                       name="featured_image" 
                                       id="featured_image"
                                       accept="image/*"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('featured_image') border-red-500 @enderror">
                                <p class="mt-1 text-sm text-gray-500">Selecciona una nueva imagen para reemplazar la actual (máx. 2MB)</p>
                                @error('featured_image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Model Image -->
                            <div>
                                <label for="model_image" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-user-friends mr-1 text-blue-500"></i>
                                    Imagen con Modelo
                                </label>
                                
                                @if($product->model_image)
                                    <div class="mb-3">
                                        <img src="{{ $product->model_image_url }}" 
                                             alt="Imagen del modelo actual" 
                                             class="w-32 h-24 object-cover rounded-lg">
                                        <p class="text-sm text-gray-500 mt-1">Imagen actual con modelo</p>
                                    </div>
                                @endif
                                
                                <input type="file" 
                                       name="model_image" 
                                       id="model_image"
                                       accept="image/*"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('model_image') border-red-500 @enderror">
                                <p class="mt-1 text-sm text-gray-500">Selecciona una nueva imagen con modelo para reemplazar la actual (máx. 2MB)</p>
                                @error('model_image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Video -->
                            <div>
                                <label for="video" class="block text-sm font-medium text-gray-700 mb-1">
                                    Video
                                </label>
                                
                                @if($product->video)
                                    <div class="mb-3">
                                        <video width="320" height="180" controls class="rounded-lg">
                                            <source src="{{ asset('storage/' . $product->video) }}" type="video/mp4">
                                            Tu navegador no soporta el elemento de video.
                                        </video>
                                        <p class="text-sm text-gray-500 mt-1">Video actual</p>
                                    </div>
                                @endif
                                
                                <input type="file" 
                                       name="video" 
                                       id="video"
                                       accept="video/mp4,video/mpeg,video/quicktime"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('video') border-red-500 @enderror">
                                <p class="mt-1 text-sm text-gray-500">Selecciona un nuevo video para reemplazar el actual (máx. 100MB, formatos: MP4, MPEG, QuickTime)</p>
                                @error('video')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Additional Images -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Imágenes Adicionales
                                </label>
                                
                                @if($product->images->count() > 0)
                                    <div class="grid grid-cols-3 gap-3 mb-3">
                                        @foreach($product->images as $image)
                                            <div class="relative group" id="image-{{ $image->id }}">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                     alt="Imagen adicional" 
                                                     class="w-full h-24 object-cover rounded-lg">
                                                <button type="button" 
                                                        onclick="deleteImage({{ $image->id }})"
                                                        class="absolute top-2 right-2 bg-red-600 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <input type="file" 
                                       name="images[]" 
                                       id="images"
                                       accept="image/*"
                                       multiple
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <p class="mt-1 text-sm text-gray-500">Puedes seleccionar múltiples imágenes para agregar (máx. 2MB cada una)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Categories & Brand -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Categorización</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Categoría <span class="text-red-500">*</span>
                                </label>
                                <select name="category_id" 
                                        id="category_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror"
                                        required>
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="brand_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Marca <span class="text-red-500">*</span>
                                </label>
                                <select name="brand_id" 
                                        id="brand_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('brand_id') border-red-500 @enderror"
                                        required>
                                    <option value="">Seleccionar marca</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
                                    Género <span class="text-red-500">*</span>
                                </label>
                                <select name="gender" 
                                        id="gender"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gender') border-red-500 @enderror"
                                        required>
                                    <option value="unisex" {{ old('gender', $product->gender) == 'unisex' ? 'selected' : '' }}>Unisex</option>
                                    <option value="hombre" {{ old('gender', $product->gender) == 'hombre' ? 'selected' : '' }}>Hombre</option>
                                    <option value="mujer" {{ old('gender', $product->gender) == 'mujer' ? 'selected' : '' }}>Mujer</option>
                                    <option value="niño" {{ old('gender', $product->gender) == 'niño' ? 'selected' : '' }}>Niño</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tipo <span class="text-red-500">*</span>
                                </label>
                                <select name="type" 
                                        id="type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror"
                                        required>
                                    <option value="oftalmico" {{ old('type', $product->type) == 'oftalmico' ? 'selected' : '' }}>Oftálmico</option>
                                    <option value="sol" {{ old('type', $product->type) == 'sol' ? 'selected' : '' }}>Sol</option>
                                    <option value="ambos" {{ old('type', $product->type) == 'ambos' ? 'selected' : '' }}>Ambos</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Detalles del Producto</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="frame_material" class="block text-sm font-medium text-gray-700 mb-1">
                                    Material de la Montura
                                </label>
                                <input type="text" 
                                       name="frame_material" 
                                       id="frame_material" 
                                       value="{{ old('frame_material', $product->frame_material) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('frame_material') border-red-500 @enderror"
                                       placeholder="Ej: Metal, Acetato, TR90">
                                @error('frame_material')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="frame_color" class="block text-sm font-medium text-gray-700 mb-1">
                                    Color de la Montura
                                </label>
                                <input type="text" 
                                       name="frame_color" 
                                       id="frame_color" 
                                       value="{{ old('frame_color', $product->frame_color) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('frame_color') border-red-500 @enderror"
                                       placeholder="Ej: Negro, Carey, Dorado">
                                @error('frame_color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="lens_type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Tipo de Lente
                                </label>
                                <input type="text" 
                                       name="lens_type" 
                                       id="lens_type" 
                                       value="{{ old('lens_type', $product->lens_type) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('lens_type') border-red-500 @enderror"
                                       placeholder="Ej: Polarizado, Fotocromático">
                                @error('lens_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="lens_color" class="block text-sm font-medium text-gray-700 mb-1">
                                    Color del Lente
                                </label>
                                <input type="text" 
                                       name="lens_color" 
                                       id="lens_color" 
                                       value="{{ old('lens_color', $product->lens_color) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('lens_color') border-red-500 @enderror"
                                       placeholder="Ej: Gris, Verde, Azul">
                                @error('lens_color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="size" class="block text-sm font-medium text-gray-700 mb-1">
                                    Talla
                                </label>
                                <input type="text" 
                                       name="size" 
                                       id="size" 
                                       value="{{ old('size', $product->size) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('size') border-red-500 @enderror"
                                       placeholder="Ej: S, M, L o medidas específicas">
                                @error('size')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status & Settings -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Estado y Configuración</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       id="is_active" 
                                       value="1"
                                       {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                    Producto activo
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_featured" 
                                       id="is_featured" 
                                       value="1"
                                       {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_featured" class="ml-2 block text-sm text-gray-700">
                                    Producto destacado
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" 
                                       name="is_new" 
                                       id="is_new" 
                                       value="1"
                                       {{ old('is_new', $product->is_new) ? 'checked' : '' }}
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="is_new" class="ml-2 block text-sm text-gray-700">
                                    Marcar como nuevo
                                </label>
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-1">
                                    Orden de visualización
                                </label>
                                <input type="number" 
                                       name="order" 
                                       id="order" 
                                       value="{{ old('order', $product->order) }}"
                                       min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('order') border-red-500 @enderror">
                                @error('order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Product Features -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Características del Producto</h3>
                        
                        <!-- Existing Features -->
                        @if($product->features->count() > 0)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Características existentes:</p>
                                <div id="existing-features" class="space-y-3">
                                    @foreach($product->features as $feature)
                                        <div class="feature-item flex gap-2" id="feature-{{ $feature->id }}">
                                            <input type="text" 
                                                   name="existing_features[{{ $feature->id }}][name]" 
                                                   value="{{ $feature->name }}"
                                                   placeholder="Nombre"
                                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <input type="text" 
                                                   name="existing_features[{{ $feature->id }}][value]" 
                                                   value="{{ $feature->value }}"
                                                   placeholder="Valor"
                                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <button type="button" onclick="deleteFeature({{ $feature->id }})" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- New Features -->
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Agregar nuevas características:</p>
                            <div id="features-container" class="space-y-3">
                                <div class="feature-item flex gap-2">
                                    <input type="text" 
                                           name="features[0][name]" 
                                           placeholder="Nombre"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <input type="text" 
                                           name="features[0][value]" 
                                           placeholder="Valor"
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <button type="button" onclick="removeNewFeature(this)" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <button type="button" onclick="addFeature()" class="mt-3 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-plus mr-1"></i> Agregar característica
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Section -->
            <div class="bg-gray-50 rounded-lg p-6 mt-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Optimización SEO</h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">
                            Meta Título
                        </label>
                        <input type="text" 
                               name="meta_title" 
                               id="meta_title" 
                               value="{{ old('meta_title', $product->meta_title) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('meta_title') border-red-500 @enderror"
                               maxlength="255">
                        @error('meta_title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">
                            Meta Descripción
                        </label>
                        <textarea name="meta_description" 
                                  id="meta_description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('meta_description') border-red-500 @enderror">{{ old('meta_description', $product->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">
                            Palabras Clave (separadas por comas)
                        </label>
                        <input type="text" 
                               name="meta_keywords" 
                               id="meta_keywords" 
                               value="{{ old('meta_keywords', $product->meta_keywords) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('meta_keywords') border-red-500 @enderror"
                               placeholder="lentes, gafas, ray-ban, sol">
                        @error('meta_keywords')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('admin.catalog.products.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Actualizar Producto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let featureIndex = 1;

function addFeature() {
    const container = document.getElementById('features-container');
    const newFeature = document.createElement('div');
    newFeature.className = 'feature-item flex gap-2';
    newFeature.innerHTML = `
        <input type="text" 
               name="features[${featureIndex}][name]" 
               placeholder="Nombre"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="text" 
               name="features[${featureIndex}][value]" 
               placeholder="Valor"
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="button" onclick="removeNewFeature(this)" class="text-red-600 hover:text-red-800">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(newFeature);
    featureIndex++;
}

function removeNewFeature(button) {
    button.parentElement.remove();
}

// Delete existing image via AJAX
function deleteImage(imageId) {
    if(confirm('¿Estás seguro de eliminar esta imagen?')) {
        fetch(`/admin/products/images/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById(`image-${imageId}`).remove();
            } else {
                alert('Error al eliminar la imagen');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar la imagen');
        });
    }
}

// Delete existing feature via AJAX
function deleteFeature(featureId) {
    if(confirm('¿Estás seguro de eliminar esta característica?')) {
        fetch(`/admin/products/features/${featureId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                document.getElementById(`feature-${featureId}`).remove();
            } else {
                alert('Error al eliminar la característica');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al eliminar la característica');
        });
    }
}

// Auto-generate slug from name (only if slug is empty)
document.getElementById('name').addEventListener('input', function(e) {
    const slug = document.getElementById('slug');
    const currentSlug = slug.value;
    
    // Only generate if current slug is empty or equals the auto-generated version
    if (!currentSlug || currentSlug === e.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '')) {
        slug.value = e.target.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }
});

// Preview for model image
document.getElementById('model_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Crear preview si no existe
            let preview = document.getElementById('model-image-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.id = 'model-image-preview';
                preview.className = 'mt-2';
                preview.innerHTML = `
                    <img id="model-preview-img" class="w-32 h-24 object-cover rounded-lg border">
                    <p class="text-sm text-gray-500 mt-1">Nueva vista previa</p>
                `;
                document.getElementById('model_image').parentElement.appendChild(preview);
            }
            document.getElementById('model-preview-img').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Preview for featured image
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Crear preview si no existe
            let preview = document.getElementById('featured-image-preview');
            if (!preview) {
                preview = document.createElement('div');
                preview.id = 'featured-image-preview';
                preview.className = 'mt-2';
                preview.innerHTML = `
                    <img id="featured-preview-img" class="w-32 h-24 object-cover rounded-lg border">
                    <p class="text-sm text-gray-500 mt-1">Nueva vista previa</p>
                `;
                document.getElementById('featured_image').parentElement.appendChild(preview);
            }
            document.getElementById('featured-preview-img').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

@push('scripts')
<script>
// Ensure CSRF token is included in the page head
document.addEventListener('DOMContentLoaded', function() {
    if(!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }
});
</script>
@endpush

@endsection