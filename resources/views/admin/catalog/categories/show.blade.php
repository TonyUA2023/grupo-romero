@extends('layouts.admin')

@section('title', 'Detalle de Categoría')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800">{{ $category->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Slug: {{ $category->slug }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.catalog.categories.edit', $category) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Editar
                    </a>
                    @if($category->products->count() == 0 && $category->children->count() == 0)
                        <form action="{{ route('admin.catalog.categories.destroy', $category) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                Eliminar
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('admin.catalog.categories.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Category Image -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Imagen de la Categoría</h3>
                <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://via.placeholder.com/400' }}" 
                     alt="{{ $category->name }}"
                     class="w-full rounded-lg shadow-sm">
            </div>

            <!-- Status and Settings -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Estado y Configuración</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Estado:</span>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $category->is_active ? 'Activa' : 'Inactiva' }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Orden:</span>
                        <span class="font-medium">{{ $category->order }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">ID:</span>
                        <span class="font-mono text-sm">#{{ $category->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Hierarchy -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Jerarquía</h3>
                
                @if($category->parent)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Categoría Padre:</p>
                        <a href="{{ route('admin.catalog.categories.show', $category->parent) }}" 
                           class="inline-flex items-center px-3 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition">
                            <i class="fas fa-folder mr-2"></i>
                            {{ $category->parent->name }}
                        </a>
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Esta es una categoría principal</p>
                @endif
                
                @if($category->children->count() > 0)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Subcategorías ({{ $category->children->count() }}):</p>
                        <div class="space-y-2">
                            @foreach($category->children as $child)
                                <a href="{{ route('admin.catalog.categories.show', $child) }}" 
                                   class="block px-3 py-2 bg-gray-50 text-gray-700 rounded hover:bg-gray-100 transition">
                                    <i class="fas fa-folder-open mr-2 text-gray-400"></i>
                                    {{ $child->name }}
                                    <span class="text-xs text-gray-500">({{ $child->products->count() }} productos)</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                
                <div class="space-y-4">
                    @if($category->description)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Descripción</label>
                            <div class="mt-1 text-gray-900 prose max-w-none">
                                {!! nl2br(e($category->description)) !!}
                            </div>
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Fecha de Creación</label>
                            <p class="mt-1 text-gray-900">{{ $category->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Última Actualización</label>
                            <p class="mt-1 text-gray-900">{{ $category->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información SEO</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Meta Título</label>
                        <p class="mt-1 text-gray-900">{{ $category->meta_title ?: 'No especificado' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Meta Descripción</label>
                        <p class="mt-1 text-gray-900">{{ $category->meta_description ?: 'No especificado' }}</p>
                    </div>
                </div>
            </div>

            <!-- Products in this Category -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        Productos en esta Categoría ({{ $category->products->count() }})
                    </h3>
                </div>
                
                @if($category->products->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Imagen
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Producto
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Marca
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Precio
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Estado
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($category->products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/60' }}" 
                                             alt="{{ $product->name }}"
                                             class="w-12 h-12 object-cover rounded">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-500">SKU: {{ $product->sku }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $product->brand->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm">
                                            @if($product->sale_price)
                                                <span class="text-red-600 font-medium">S/ {{ number_format($product->sale_price, 2) }}</span>
                                                <span class="text-gray-400 line-through text-xs block">S/ {{ number_format($product->price, 2) }}</span>
                                            @else
                                                <span class="text-gray-900">S/ {{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('admin.catalog.products.show', $product) }}" 
                                               class="text-gray-600 hover:text-gray-900 transition"
                                               title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.catalog.products.edit', $product) }}" 
                                               class="text-blue-600 hover:text-blue-900 transition"
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 text-center text-gray-500">
                        No hay productos en esta categoría
                    </div>
                @endif
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i class="fas fa-box text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Productos Directos</p>
                            <p class="text-xl font-semibold text-gray-800">{{ $category->products->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-folder text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Subcategorías</p>
                            <p class="text-xl font-semibold text-gray-800">{{ $category->children->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-purple-100 rounded-full">
                            <i class="fas fa-chart-line text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">Total Productos</p>
                            <p class="text-xl font-semibold text-gray-800">
                                @php
                                    $totalProducts = $category->products->count();
                                    foreach($category->children as $child) {
                                        $totalProducts += $child->products->count();
                                    }
                                @endphp
                                {{ $totalProducts }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Administrando categoría: <span class="font-medium text-gray-900">{{ $category->name }}</span>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.catalog.categories.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Crear Nueva Categoría
                </a>
                <a href="{{ route('admin.catalog.products.create') }}?category_id={{ $category->id }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Agregar Producto a esta Categoría
                </a>
            </div>
        </div>
    </div>
</div>
@endsection