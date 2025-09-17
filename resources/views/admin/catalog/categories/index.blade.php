@extends('layouts.admin')

@section('title', 'Gestión de Categorías')

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Categorías</h2>
            <a href="{{ route('admin.catalog.categories.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Nueva Categoría
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <form method="GET" action="{{ route('admin.catalog.categories.index') }}" class="flex flex-wrap gap-4">
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
            
            <select name="type" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Todas las categorías</option>
                <option value="parent" {{ request('type') == 'parent' ? 'selected' : '' }}>Solo principales</option>
                <option value="child" {{ request('type') == 'child' ? 'selected' : '' }}>Solo subcategorías</option>
            </select>
            
            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                <i class="fas fa-search mr-2"></i>Buscar
            </button>
            
            @if(request()->hasAny(['search', 'status', 'type']))
                <a href="{{ route('admin.catalog.categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition duration-200">
                    <i class="fas fa-times mr-2"></i>Limpiar
                </a>
            @endif
        </form>
    </div>

    <!-- Categories Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Imagen
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoría
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Categoría Padre
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
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="{{ $category->image ? asset('storage/' . $category->image) : 'https://via.placeholder.com/60' }}" 
                             alt="{{ $category->name }}"
                             class="w-16 h-12 object-cover rounded">
                    </td>
                    <td class="px-6 py-4">
                        <div>
                            <div class="text-sm font-medium text-gray-900">
                                @if($category->parent_id)
                                    <span class="text-gray-400 mr-1">└</span>
                                @endif
                                {{ $category->name }}
                            </div>
                            <div class="text-sm text-gray-500">Slug: {{ $category->slug }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($category->parent)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $category->parent->name }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-semibold leading-5 text-gray-800 bg-gray-100 rounded-full">
                            {{ $category->products_count }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                        {{ $category->order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $category->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $category->is_active ? 'Activa' : 'Inactiva' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <a href="{{ route('admin.catalog.categories.show', $category) }}" 
                               class="text-gray-600 hover:text-gray-900 transition"
                               title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.catalog.categories.edit', $category) }}" 
                               class="text-blue-600 hover:text-blue-900 transition"
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($category->products_count == 0 && $category->children->count() == 0)
                                <form action="{{ route('admin.catalog.categories.destroy', $category) }}" 
                                      method="POST" 
                                      class="inline"
                                      onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
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
                                        title="No se puede eliminar (tiene productos o subcategorías)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No se encontraron categorías
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $categories->withQueryString()->links() }}
    </div>
    @endif
</div>

<!-- Category Tree View -->
<div class="mt-6 bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Estructura de Categorías</h3>
    </div>
    <div class="p-6">
        <div class="space-y-2">
            @php
                $mainCategories = \App\Models\Category::whereNull('parent_id')
                                                     ->with('children')
                                                     ->orderBy('order')
                                                     ->orderBy('name')
                                                     ->get();
            @endphp
            
            @foreach($mainCategories as $mainCategory)
                <div class="border-l-2 border-gray-200 pl-4">
                    <div class="flex items-center space-x-2 py-1">
                        <i class="fas fa-folder {{ $mainCategory->is_active ? 'text-blue-500' : 'text-gray-400' }}"></i>
                        <span class="{{ $mainCategory->is_active ? 'text-gray-900' : 'text-gray-500' }}">
                            {{ $mainCategory->name }}
                        </span>
                        <span class="text-xs text-gray-500">({{ $mainCategory->products()->count() }} productos)</span>
                    </div>
                    
                    @if($mainCategory->children->count() > 0)
                        <div class="ml-4">
                            @foreach($mainCategory->children as $child)
                                <div class="flex items-center space-x-2 py-1">
                                    <i class="fas fa-folder-open {{ $child->is_active ? 'text-green-500' : 'text-gray-400' }}"></i>
                                    <span class="{{ $child->is_active ? 'text-gray-800' : 'text-gray-500' }} text-sm">
                                        {{ $child->name }}
                                    </span>
                                    <span class="text-xs text-gray-500">({{ $child->products()->count() }} productos)</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <i class="fas fa-folder text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Total Categorías</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Category::count() }}</p>
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
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Category::where('is_active', true)->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full">
                <i class="fas fa-sitemap text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Principales</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Category::whereNull('parent_id')->count() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-full">
                <i class="fas fa-layer-group text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm text-gray-500">Subcategorías</p>
                <p class="text-2xl font-semibold text-gray-800">{{ \App\Models\Category::whereNotNull('parent_id')->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection