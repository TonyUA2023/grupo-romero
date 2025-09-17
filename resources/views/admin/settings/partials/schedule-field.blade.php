@php
    // Obtener el valor actual como array
    $scheduleData = $setting->type === 'json' ? $setting->getValueAsArray() : [];
    $days = $fieldConf['days'] ?? [
        'monday' => 'Lunes',
        'tuesday' => 'Martes',
        'wednesday' => 'Miércoles',
        'thursday' => 'Jueves',
        'friday' => 'Viernes',
        'saturday' => 'Sábado',
        'sunday' => 'Domingo'
    ];
@endphp

<div class="field-group">
    <div class="mb-4">
        <h3 class="text-lg font-medium text-gray-900">
            <i class="fas fa-clock mr-2 text-gray-400"></i>
            {{ $fieldConf['label'] ?? 'Horarios de Atención' }}
        </h3>
        <p class="mt-1 text-sm text-gray-500">Define los horarios de atención para cada día de la semana</p>
    </div>

    <div class="space-y-4">
        @foreach($days as $dayKey => $dayName)
            @php
                $daySchedule = $scheduleData[$dayKey] ?? '';
                $isClosed = empty($daySchedule) || strtolower($daySchedule) === 'cerrado';
            @endphp
            
            <div class="schedule-day-container flex items-center space-x-4 p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                <div class="flex-shrink-0 w-32">
                    <label class="text-sm font-medium text-gray-700">{{ $dayName }}</label>
                </div>
                
                <div class="flex-1">
                    <input 
                        type="text"
                        id="schedule_{{ $dayKey }}"
                        name="schedule[{{ $dayKey }}]"
                        value="{{ $daySchedule }}"
                        placeholder="Ej: 9:00 AM - 6:00 PM"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ $isClosed ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                        {{ $isClosed ? 'disabled' : '' }}
                    >
                </div>
                
                <div class="flex-shrink-0">
                    <label class="inline-flex items-center">
                        <input 
                            type="checkbox"
                            id="closed_{{ $dayKey }}"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            {{ $isClosed ? 'checked' : '' }}
                            onchange="toggleDaySchedule('{{ $dayKey }}')"
                        >
                        <span class="ml-2 text-sm text-gray-600">Cerrado</span>
                    </label>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700">
                    Puedes usar cualquier formato de horario que prefieras. Ejemplos: "9:00 - 18:00", "9 AM - 6 PM", "Cita previa"
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleDaySchedule(day) {
        const checkbox = document.getElementById('closed_' + day);
        const input = document.getElementById('schedule_' + day);
        const container = input.closest('.schedule-day-container');
        
        if (checkbox.checked) {
            input.value = 'Cerrado';
            input.disabled = true;
            input.classList.add('bg-gray-100', 'cursor-not-allowed');
            container.classList.add('opacity-60');
        } else {
            input.value = '';
            input.disabled = false;
            input.classList.remove('bg-gray-100', 'cursor-not-allowed');
            container.classList.remove('opacity-60');
            input.focus();
        }
    }
</script>