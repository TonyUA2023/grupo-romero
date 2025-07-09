@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if(Auth::user()->is_admin)
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold">¡Eres un administrador!</h2>
                        <p class="mt-2">Puedes acceder al panel de administración para gestionar el sitio.</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Ir al Panel de Administración
                    </a>
                @else
                    <h2 class="text-xl font-semibold">¡Bienvenido!</h2>
                    <p class="mt-4">Estás en tu área personal de usuario.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection