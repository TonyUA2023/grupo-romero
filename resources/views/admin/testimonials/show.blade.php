@extends('layouts.admin')

@section('title', 'Detalle del Testimonio')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Detalle del Testimonio</h2>
    
    <div class="flex items-start mb-4">
        @if($testimonial->image)
        <div class="flex-shrink-0 mr-4">
            <img class="h-24 w-24 rounded-full object-cover" 
                 src="{{ asset('storage/' . $testimonial->image) }}" 
                 alt="{{ $testimonial->name }}">
        </div>
        @endif
        <div>
            <h3 class="text-lg font-medium text-gray-900">{{ $testimonial->name }}</h3>
            <p class="text-sm text-gray-600">{{ $testimonial->position }}</p>
            <div class="mt-1 flex">
                @for($i = 0; $i < $testimonial->rating; $i++)
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                @endfor
            </div>
        </div>
    </div>
    
    <div class="mb-4">
        <p class="text-gray-700">{{ $testimonial->content }}</p>
    </div>
    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            @if($testimonial->is_active)
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Activo
                </span>
            @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Inactivo
                </span>
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Orden</label>
            <p class="text-gray-900">{{ $testimonial->order }}</p>
        </div>
    </div>
    
    <div class="flex justify-end">
        <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
            Volver
        </a>
    </div>
</div>
@endsection