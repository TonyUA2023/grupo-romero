@extends('layouts.admin')

@section('title', 'Configuración del Sitio')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Configuración General</h2>
    </div>
    
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="p-6">
            @foreach($settings as $group => $groupSettings)
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4 capitalize">{{ $group }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($groupSettings as $setting)
                    <div class="md:col-span-{{ in_array($setting->type, ['textarea', 'json']) ? '2' : '1' }}">
                        <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                            {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                        </label>
                        
                        @if($setting->type === 'text')
                        <input type="text" name="{{ $setting->key }}" id="{{ $setting->key }}" 
                               value="{{ old($setting->key, $setting->value) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        
                        @elseif($setting->type === 'textarea')
                        <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old($setting->key, $setting->value) }}</textarea>
                        
                        @elseif($setting->type === 'image')
                        <div class="mt-1 flex items-center">
                            @if($setting->value)
                            <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->key }}" class="h-16 w-16 object-cover rounded mr-4">
                            @endif
                            <input type="file" name="{{ $setting->key }}" id="{{ $setting->key}}" 
                                   class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                        
                        @elseif($setting->type === 'json' && $setting->key === 'schedule')
                        <div class="space-y-2">
                            @php
                                $schedule = json_decode($setting->value, true);
                            @endphp
                            @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                            <div class="flex items-center">
                                <label class="w-24 text-sm text-gray-600 capitalize">{{ $day }}</label>
                                <input type="text" name="schedule[{{ $day }}]" 
                                       value="{{ old("schedule.$day", $schedule[$day] ?? '') }}" 
                                       class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection