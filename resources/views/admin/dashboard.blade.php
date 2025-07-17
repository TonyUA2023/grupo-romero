@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full mr-4">
                <i class="fas fa-glasses text-blue-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600">Servicios</p>
                <p class="text-2xl font-bold">{{ $stats['services'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full mr-4">
                <i class="fas fa-file-alt text-green-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600">Páginas</p>
                <p class="text-2xl font-bold">{{ $stats['pages'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-full mr-4">
                <i class="fas fa-blog text-purple-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600">Artículos de Blog</p>
                <p class="text-2xl font-bold">{{ $stats['posts'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-full mr-4">
                <i class="fas fa-users text-yellow-600 text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-600">Miembros del Equipo</p>
                <p class="text-2xl font-bold">{{ $stats['team'] }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Últimos servicios -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-lg font-medium text-gray-800">Últimos Servicios</h2>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($recentServices as $service)
            <div class="px-6 py-4 flex items-center">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16"></div>
                <div class="ml-4">
                    <h3 class="font-medium text-gray-800">{{ $service->name }}</h3>
                    <p class="text-gray-600 text-sm">{{ $service->created_at->diffForHumans() }}</p>
                </div>
                <div class="ml-auto">
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm">S/ {{ number_format($service->price, 2) }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="border-t border-gray-200 px-6 py-4 text-center">
            <a href="{{ route('services.index') }}" class="text-blue-600 hover:text-blue-800">Ver todos los servicios</a>
        </div>
    </div>
    
    <!-- Últimos artículos -->
    <div class="bg-white rounded-lg shadow">
        <div class="border-b border-gray-200 px-6 py-4">
            <h2 class="text-lg font-medium text-gray-800">Últimos Artículos</h2>
        </div>
        <div class="divide-y divide-gray-200">
            @foreach($recentPosts as $post)
            <div class="px-6 py-4 flex items-center">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16"></div>
                <div class="ml-4">
                    <h3 class="font-medium text-gray-800">{{ $post->title }}</h3>
                    <p class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                <div class="ml-auto">
                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-sm">
                        {{ $post->is_published ? 'Publicado' : 'Borrador' }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="border-t border-gray-200 px-6 py-4 text-center">
            <a href="{{ route('blogs.index') }}" class="text-blue-600 hover:text-blue-800">Ver todos los artículos</a>
        </div>
    </div>
</div>
@endsection