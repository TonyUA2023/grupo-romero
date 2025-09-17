@extends('layouts.admin')

@section('title', 'Gestión de Marcas')

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Marcas</h2>
            <a href="{{ route('admin.catalog.brands.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Nueva Marca
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <form method="GET" action="{{ route('admin.catalog.brands.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Buscar por nombre..." 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todos los estados</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Activas</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactivas</option>
            </select>
            
            <select name="featured" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las marcas</option>
                <option value="featured" {{ request('featured') == 'featured' ? 'selected' : '' }}>Solo destacadas</option>
                <option value="regular" {{ request('featured') == 'regular' ? 'selected' : '' }}>No destacadas</option>
            </select>
            
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-search mr-2"></i>Buscar
            </button>
            
            @if(request()->hasAny(['search', 'status', 'featured']))
                <a href="{{ route('admin.catalog.brands.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-times mr-2"></i>Limpiar
                </a>
            @endif
        </form>
    </div>

    <!-- Brands Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Logo
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Marca
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sitio Web
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Productos
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Orden
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
                @forelse($brands as $brand)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ $brand->logo ? asset('storage/' . $brand->logo) : 'https://via.placeholder.com/60' }}" 
                             alt="{{ $brand->name }}"
                             class="w-16 h-12 object-contain bg-gray-50 rounded p-1">
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-medium text-gray-900">{{ $brand->name }}</div>
                            <div class="text-sm text-gray-500">Slug: {{ $brand->slug }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($brand->website)
                            <a href="{{ $brand->website }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 hover:underline">
                                <i class="fas fa-external-link-alt mr-1"></i>
                                {{ parse_url($brand->website, PHP_URL_HOST) }}
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">
                            {{ $brand->products_count }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                        {{ $brand->order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex flex-col items-center gap-1">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $brand->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $brand->is_active ? 'Activa' : 'Inactiva' }}
                            </span>
                            @if($brand->is_featured)
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-star mr-1"></i>Destacada
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.catalog.brands.show', $brand) }}" 
                               class="text-gray-600 hover:text-gray-900 transition"
                               title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.catalog.brands.edit', $brand) }}" 
                               class="text-blue-600 hover:text-blue-900 transition"
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($brand->products_count == 0)
                                <form action="{{ route('admin.catalog.brands.destroy', $brand) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('¿Estás seguro de eliminar esta marca?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition"
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <button type="button" 
                                        class="text-gray-400 cursor-not-allowed"
                                        title="No se puede eliminar (tiene productos asociados)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron marcas
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($brands->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $brands->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Featured Brands Section -->
@php
    $featuredBrands = \App\Models\Brand::where('is_featured', true)
                                      ->where('is_active', true)
                                      ->orderBy('order')
                                      ->orderBy('name')
                                      ->limit(8)
                                      ->get();
@endphp

@if($featuredBrands->count() > 0)
<div class="mt-6 bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Marcas Destacadas</h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
            @foreach($featuredBrands as $featured)
                <div class="text-center">
                    <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition">
                        <img src="{{ $featured->logo ? asset('storage/' . $featured->logo) : 'https://via.placeholder.com/100' }}" 
                             alt="{{ $featured->name }}"
                             class="w-full h-16 object-contain mb-2">
                        <p class="text-xs text-gray-600 truncate">{{ $featured->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-trademark text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Marcas</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Brand::count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Activas</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Brand::where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-star text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Destacadas</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Brand::where('is_featured', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-full">
                <i class="fas fa-box text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Con Productos</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Brand::has('products')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-full">
                <i class="fas fa-globe text-red-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Con Sitio Web</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Brand::whereNotNull('website')->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection