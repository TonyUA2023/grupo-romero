@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="px-6 py-5 sm:p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Configuración del Sitio</h1>
                        <p class="mt-1 text-sm text-gray-500">Gestiona la configuración general de tu sitio web</p>
                    </div>
                    <div class="hidden sm:block">
                        <svg class="w-12 h-12 text-indigo-100" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-start">
                <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 flex items-start">
                <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div class="flex-1">
                        <p class="font-medium mb-2">Se encontraron errores:</p>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form -->
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if(count($settings) > 0)
                <div class="bg-white shadow-sm rounded-lg">
                    <!-- Tabs -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                            @php
                                $groupIcons = [
                                    'general' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                    'contact' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
                                    'schedule' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                    'social' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m9.032 4.026a9.001 9.001 0 01-7.432 3.315A9 9 0 016.75 9.75c0 2.942 2.358 5.358 5.3 5.358 1.966 0 3.684-1.07 4.602-2.649l.998 1.232c.75.926 2.158.848 2.808-.153.649-1.001.421-2.352-.5-3.128l-1.226-1.033a9.003 9.003 0 01-3.016 5.35z"/>',
                                    'seo' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>'
                                ];
                                $groupNames = [
                                    'general' => 'General',
                                    'contact' => 'Contacto',
                                    'schedule' => 'Horarios',
                                    'social' => 'Redes Sociales',
                                    'seo' => 'SEO'
                                ];
                                $firstGroup = true;
                            @endphp
                            
                            @foreach($settings as $group => $groupSettings)
                                <button type="button" 
                                        class="tab-button {{ $firstGroup ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500' }} hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm flex items-center"
                                        onclick="switchTab('{{ $group }}', this)">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $groupIcons[$group] ?? '<circle cx="12" cy="12" r="10"/>' !!}
                                    </svg>
                                    {{ $groupNames[$group] ?? ucfirst($group) }}
                                </button>
                                @php $firstGroup = false; @endphp
                            @endforeach
                        </nav>
                    </div>

                    <!-- Tab Contents -->
                    <div class="p-6">
                        @php $firstGroup = true; @endphp
                        @foreach($settings as $group => $groupSettings)
                            @if(is_array($groupSettings) || $groupSettings instanceof \Traversable)
                                <div id="{{ $group }}-tab" class="tab-content {{ !$firstGroup ? 'hidden' : '' }}">
                                @if($group === 'schedule')
                                    @php
                                        $scheduleSetting = null;
                                        foreach($groupSettings as $setting) {
                                            if($setting instanceof \App\Models\Setting && $setting->key === 'schedule' && $setting->type === 'json') {
                                                $scheduleSetting = $setting;
                                                break;
                                            }
                                        }
                                    @endphp
                                    
                                    @if($scheduleSetting)
                                        <!-- Special handling for schedule -->
                                        <div class="space-y-4">
                                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Horarios de Atención
                                            </h3>
                                            
                                            @php
                                                $days = [
                                                    'monday' => 'Lunes',
                                                    'tuesday' => 'Martes',
                                                    'wednesday' => 'Miércoles',
                                                    'thursday' => 'Jueves',
                                                    'friday' => 'Viernes',
                                                    'saturday' => 'Sábado',
                                                    'sunday' => 'Domingo'
                                                ];
                                                $scheduleData = $scheduleSetting->getValueAsArray() ?? [];
                                            @endphp
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                @foreach($days as $dayKey => $dayName)
                                                <div class="bg-gray-50 p-4 rounded-lg">
                                                    <label for="schedule_{{ $dayKey }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                        {{ $dayName }}
                                                    </label>
                                                    <input type="text" 
                                                           id="schedule_{{ $dayKey }}"
                                                           name="schedule[{{ $dayKey }}]" 
                                                           value="{{ old('schedule.'.$dayKey, $scheduleData[$dayKey] ?? '') }}"
                                                           class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                           placeholder="9:00 AM - 6:00 PM">
                                                    <div class="mt-2">
                                                        <label class="inline-flex items-center">
                                                            <input type="checkbox" 
                                                                   id="closed_{{ $dayKey }}"
                                                                   onchange="toggleDaySchedule('{{ $dayKey }}')"
                                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                            <span class="ml-2 text-sm text-gray-600">Cerrado</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <!-- Regular fields -->
                                    <div class="grid grid-cols-1 {{ in_array($group, ['contact', 'social']) ? 'md:grid-cols-2' : '' }} gap-6">
                                        @foreach($groupSettings as $setting)
                                            @if($setting instanceof \App\Models\Setting && $setting->type !== 'json')
                                                <div class="{{ $setting->type === 'textarea' ? 'col-span-full' : '' }}">
                                                    @include('admin.settings.partials.field', ['setting' => $setting])
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            @endif
                            @php $firstGroup = false; @endphp
                        @endforeach
                    </div>

                    <!-- Form Actions -->
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Los cambios se aplicarán inmediatamente
                            </p>
                            <div class="space-x-3">
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Cancelar
                                </a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay configuraciones</h3>
                        <p class="mt-1 text-sm text-gray-500">No se encontraron configuraciones disponibles.</p>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
    // Tab switching
    function switchTab(tabName, button) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active state from all buttons
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('border-indigo-500', 'text-indigo-600');
            btn.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Show selected tab
        document.getElementById(tabName + '-tab').classList.remove('hidden');
        
        // Update active button
        button.classList.remove('border-transparent', 'text-gray-500');
        button.classList.add('border-indigo-500', 'text-indigo-600');
    }

    // Toggle schedule day
    function toggleDaySchedule(day) {
        const checkbox = document.getElementById('closed_' + day);
        const input = document.getElementById('schedule_' + day);
        
        if (checkbox.checked) {
            input.value = 'Cerrado';
            input.disabled = true;
            input.classList.add('bg-gray-100');
        } else {
            input.value = '';
            input.disabled = false;
            input.classList.remove('bg-gray-100');
            input.focus();
        }
    }

    // Update SEO preview
    function updateSeoPreview() {
        const titleInput = document.getElementById('meta_title');
        if (titleInput) {
            const titlePreview = document.getElementById('preview-title');
            const titleCount = document.getElementById('title-count');
            
            if (titlePreview) {
                titlePreview.textContent = titleInput.value || 'Título de tu página';
            }
            if (titleCount) {
                titleCount.textContent = titleInput.value.length;
            }
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Check for closed days
        const scheduleInputs = document.querySelectorAll('[id^="schedule_"]');
        scheduleInputs.forEach(input => {
            const value = input.value.toLowerCase();
            if (value === 'cerrado' || value === '') {
                const day = input.id.replace('schedule_', '');
                const checkbox = document.getElementById('closed_' + day);
                if (checkbox && value === 'cerrado') {
                    checkbox.checked = true;
                    input.disabled = true;
                    input.classList.add('bg-gray-100');
                }
            }
        });
        
        // Initialize SEO preview if it exists
        if (typeof updateSeoPreview === 'function') {
            updateSeoPreview();
        }
    });
</script>
@endsection