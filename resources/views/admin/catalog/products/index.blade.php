@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Productos</h2>
            <a href="{{ route('admin.catalog.products.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Nuevo Producto
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <form method="GET" action="{{ route('admin.catalog.products.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Buscar por nombre, SKU..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <select name="category" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las categorías</option>
                @foreach(\App\Models\Category::orderBy('name')->get() as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            
            <select name="brand" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las marcas</option>
                @foreach(\App\Models\Brand::orderBy('name')->get() as $brand)
                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            
            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todos los estados</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Activos</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactivos</option>
            </select>

            <select name="has_model" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Con/Sin modelo</option>
                <option value="1" {{ request('has_model') == '1' ? 'selected' : '' }}>
                    <i class="fas fa-user-friends mr-1"></i>Solo con modelo
                </option>
            </select>
            
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-search mr-2"></i>Buscar
            </button>
            
            @if(request()->hasAny(['search', 'category', 'brand', 'status', 'has_model']))
                <a href="{{ route('admin.catalog.products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-times mr-2"></i>Limpiar
                </a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Imágenes
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Producto
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoría
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-2">
                            <!-- Imagen principal -->
                            <div class="relative group">
                                <img src="{{ $product->featured_image ? asset('storage/' . $product->featured_image) : 'https://via.placeholder.com/60' }}" 
                                     alt="{{ $product->name }}"
                                     class="w-16 h-12 object-cover rounded border-2 border-gray-200">
                                <div class="absolute -bottom-1 -right-1 bg-gray-600 text-white text-xs px-1 rounded">
                                    Principal
                                </div>
                            </div>
                            
                            <!-- Imagen con modelo (si existe) -->
                            @if($product->model_image)
                                <div class="relative group">
                                    <img src="{{ $product->model_image_url }}" 
                                         alt="{{ $product->name }} con modelo"
                                         class="w-16 h-12 object-cover rounded border-2 border-blue-200">
                                    <div class="absolute -bottom-1 -right-1 bg-blue-600 text-white text-xs px-1 rounded">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Indicador de número de imágenes adicionales -->
                        @if($product->images->count() > 0)
                            <div class="text-xs text-gray-500 mt-1">
                                +{{ $product->images->count() }} más
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">SKU: {{ $product->sku }}</div>
                            @if($product->model_image)
                                <div class="text-xs text-blue-600 mt-1">
                                    <i class="fas fa-user-friends mr-1"></i>Con modelo
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $product->category->name }}
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
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col gap-1">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                            @if($product->is_featured)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Destacado
                                </span>
                            @endif
                            @if($product->is_new)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Nuevo
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
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
                            <form action="{{ route('admin.catalog.products.destroy', $product) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900 transition"
                                        title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron productos
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $products->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-box text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Productos</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Product::count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Activos</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Product::where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-star text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Destacados</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Product::where('is_featured', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-percentage text-red-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">En Oferta</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Product::whereNotNull('sale_price')->count() }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-full">
                <i class="fas fa-user-friends text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Con Modelo</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Product::whereNotNull('model_image')->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection