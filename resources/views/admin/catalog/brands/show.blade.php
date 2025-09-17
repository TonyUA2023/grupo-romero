@extends('layouts.admin')

@section('title', 'Detalle de Marca')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}" 
                             alt="{{ $brand->name }}"
                             class="h-16 object-contain">
                    @endif
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $brand->name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Slug: {{ $brand->slug }}</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.catalog.brands.edit', $brand) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                        <i class="fas fa-edit mr-2"></i>
                        Editar
                    </a>
                    @if($brand->products->count() == 0)
                        <form action="{{ route('admin.catalog.brands.destroy', $brand) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('¿Estás seguro de eliminar esta marca?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                Eliminar
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('admin.catalog.brands.index') }}" 
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
            <!-- Brand Logo -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Logo de la Marca</h3>
                <div class="bg-gray-50 rounded-lg p-8 text-center">
                    <img src="{{ $brand->logo ? asset('storage/' . $brand->logo) : 'https://via.placeholder.com/300' }}" 
                         alt="{{ $brand->name }}"
                         class="max-w-full h-32 object-contain mx-auto">
                </div>
            </div>

            <!-- Status and Settings -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Estado y Configuración</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Estado:</span>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $brand->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $brand->is_active ? 'Activa' : 'Inactiva' }}
                        </span>
                    </div>
                    
                    @if($brand->is_featured)
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Destacada:</span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-star mr-1"></i> Sí
                            </span>
                        </div>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Orden:</span>
                        <span class="font-medium">{{ $brand->order }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">ID:</span>
                        <span class="font-mono text-sm">#{{ $brand->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Estadísticas</h3>
                
                <div class="space-y-4">
                    <div class="text-center">
                        <p class="text-3xl font-bold text-blue-600">{{ $brand->products->count() }}</p>
                        <p class="text-sm text-gray-600">Productos totales</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t">
                        <div class="text-center">
                            <p class="text-xl font-semibold text-green-600">
                                {{ $brand->products->where('is_active', true)->count() }}
                            </p>
                            <p class="text-xs text-gray-600">Activos</p>
                        </div>
                        
                        <div class="text-center">
                            <p class="text-xl font-semibold text-yellow-600">
                                {{ $brand->products->whereNotNull('sale_price')->count() }}
                            </p>
                            <p class="text-xs text-gray-600">En oferta</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                
                <div class="space-y-4">
                    @if($brand->description)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Descripción</label>
                            <div class="mt-1 text-gray-900 prose max-w-none">
                                {!! nl2br(e($brand->description)) !!}
                            </div>
                        </div>
                    @endif
                    
                    @if($brand->website)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Sitio Web Oficial</label>
                            <p class="mt-1">
                                <a href="{{ $brand->website }}" 
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 hover:underline inline-flex items-center">
                                    <i class="fas fa-external-link-alt mr-2"></i>
                                    {{ $brand->website }}
                                </a>
                            </p>
                        </div>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Fecha de Creación</label>
                            <p class="mt-1 text-gray-900">{{ $brand->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Última Actualización</label>
                            <p class="mt-1 text-gray-900">{{ $brand->updated_at->format('d/m/Y H:i') }}</p>
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
                        <p class="mt-1 text-gray-900">{{ $brand->meta_title ?: 'No especificado' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-medium text-gray-500">Meta Descripción</label>
                        <p class="mt-1 text-gray-900">{{ $brand->meta_description ?: 'No especificado' }}</p>
                    </div>
                </div>
            </div>

            <!-- Products in this Brand -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">
                        Productos de {{ $brand->name }} ({{ $brand->products->count() }})
                    </h3>
                    <div class="flex space-x-2">
                        <select id="categoryFilter" class="text-sm px-3 py-1 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Todas las categorías</option>
                            @foreach($brand->products->pluck('category')->unique('id') as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                @if($brand->products->count() > 0)
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
                                        Categoría
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
                                @foreach($brand->products as $product)
                                <tr class="hover:bg-gray-50 product-row" data-category="{{ $product->category_id }}">
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
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $product->category->name }}
                                        </span>
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
                        No hay productos de esta marca
                    </div>
                @endif
            </div>

            <!-- Price Range Analysis -->
            @if($brand->products->count() > 0)
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Análisis de Precios</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600">Precio más bajo</p>
                            <p class="text-xl font-semibold text-gray-900 mt-1">
                                S/ {{ number_format($brand->products->min('sale_price') ?: $brand->products->min('price'), 2) }}
                            </p>
                        </div>
                        
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600">Precio promedio</p>
                            <p class="text-xl font-semibold text-gray-900 mt-1">
                                S/ {{ number_format($brand->products->avg('price'), 2) }}
                            </p>
                        </div>
                        
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600">Precio más alto</p>
                            <p class="text-xl font-semibold text-gray-900 mt-1">
                                S/ {{ number_format($brand->products->max('price'), 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Administrando marca: <span class="font-medium text-gray-900">{{ $brand->name }}</span>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.catalog.brands.create') }}" 
                   class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Crear Nueva Marca
                </a>
                <a href="{{ route('admin.catalog.products.create') }}?brand_id={{ $brand->id }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Agregar Producto de esta Marca
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Filter products by category
document.getElementById('categoryFilter').addEventListener('change', function(e) {
    const selectedCategory = e.target.value;
    const rows = document.querySelectorAll('.product-row');
    
    rows.forEach(row => {
        if (!selectedCategory || row.dataset.category === selectedCategory) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Update visible count
    const visibleRows = document.querySelectorAll('.product-row:not([style*="display: none"])');
    // You could update a counter here if needed
});
</script>
@endsection