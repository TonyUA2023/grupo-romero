<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Mostrar el formulario de configuración
     */
    public function index()
    {
        try {
            // Inicializar settings desde la configuración
            $this->initializeSettingsFromConfig();
            
            // Obtener settings agrupados
            $settings = $this->getGroupedSettings();
            
            // Obtener configuración de grupos
            $groups = config('site-settings.groups');
            
            return view('admin.settings.index', compact('settings', 'groups'));
            
        } catch (\Exception $e) {
            Log::error('Error al cargar configuración: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')
                ->with('error', 'Error al cargar la configuración: ' . $e->getMessage());
        }
    }

    /**
     * Actualizar la configuración
     */
    public function update(Request $request)
    {
        try {
            // Construir y ejecutar validación
            $validator = $this->buildValidator($request);
            
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            // Procesar cada campo según su configuración
            $this->processFields($request);
            
            // Limpiar caché si existe
            cache()->forget('site_settings');
            
            return redirect()->route('admin.settings.index')
                ->with('success', 'Configuración actualizada exitosamente.');
                
        } catch (\Exception $e) {
            Log::error('Error al actualizar configuración: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al actualizar la configuración: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Inicializar settings desde archivo de configuración
     */
    private function initializeSettingsFromConfig()
    {
        $fields = config('site-settings.fields');
        
        foreach ($fields as $group => $groupFields) {
            foreach ($groupFields as $key => $fieldConfig) {
                Setting::firstOrCreate(
                    ['key' => $key],
                    [
                        'value' => $fieldConfig['default'] ?? '',
                        'type' => $fieldConfig['type'],
                        'group' => $group
                    ]
                );
            }
        }
    }

    /**
     * Obtener settings agrupados y ordenados
     */
    private function getGroupedSettings()
    {
        return Setting::orderBy('group')
            ->orderBy('key')
            ->get()
            ->filter(fn($setting) => $setting instanceof Setting && !empty($setting->group))
            ->groupBy('group');
    }

    /**
     * Construir validador con reglas desde la configuración
     */
    private function buildValidator(Request $request)
    {
        $rules = [];
        $messages = config('site-settings.validation_messages', []);
        $fields = config('site-settings.fields');
        
        foreach ($fields as $group => $groupFields) {
            foreach ($groupFields as $key => $fieldConfig) {
                // Manejar campos especiales
                if ($fieldConfig['type'] === 'json' && $fieldConfig['subtype'] === 'schedule') {
                    foreach ($fieldConfig['days'] as $dayKey => $dayLabel) {
                        $rules["schedule.{$dayKey}"] = $fieldConfig['day_rules'] ?? 'nullable|string|max:50';
                    }
                } else {
                    $rules[$key] = $fieldConfig['rules'] ?? 'nullable|string|max:255';
                }
            }
        }
        
        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Procesar todos los campos según su tipo
     */
    private function processFields(Request $request)
    {
        $settings = Setting::all()->keyBy('key');
        $fieldConfigs = config('site-settings.fields');
        
        foreach ($fieldConfigs as $group => $groupFields) {
            foreach ($groupFields as $key => $fieldConfig) {
                if (!isset($settings[$key])) continue;
                
                $setting = $settings[$key];
                $processor = $this->getFieldProcessor($fieldConfig['type']);
                
                $value = $processor($setting, $request, $fieldConfig);
                
                if ($value !== null) {
                    $setting->value = $value;
                    $setting->save();
                }
            }
        }
    }

    /**
     * Obtener procesador para cada tipo de campo
     */
    private function getFieldProcessor($type)
    {
        return match($type) {
            'image' => fn($setting, $request, $config) => $this->processImageField($setting, $request),
            'json' => fn($setting, $request, $config) => $this->processJsonField($setting, $request, $config),
            default => fn($setting, $request, $config) => $request->input($setting->key)
        };
    }

    /**
     * Procesar campo de imagen
     */
    private function processImageField(Setting $setting, Request $request)
    {
        if (!$request->hasFile($setting->key)) {
            return null;
        }
        
        // Eliminar imagen anterior
        if ($setting->value && Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }
        
        // Guardar nueva imagen
        $file = $request->file($setting->key);
        $filename = $setting->key . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('settings', $filename, 'public');
        
        return $path;
    }

    /**
     * Procesar campo JSON
     */
    private function processJsonField(Setting $setting, Request $request, array $config)
    {
        if ($setting->key === 'schedule' && isset($config['subtype']) && $config['subtype'] === 'schedule') {
            return $this->processScheduleField($request, $config);
        }
        
        // Otros campos JSON
        $data = $request->input($setting->key, []);
        return is_array($data) ? json_encode($data) : $data;
    }

    /**
     * Procesar campo de horarios
     */
    private function processScheduleField(Request $request, array $config)
    {
        $scheduleData = [];
        
        foreach ($config['days'] as $dayKey => $dayLabel) {
            $value = $request->input("schedule.{$dayKey}");
            if (!empty($value) && $value !== 'null') {
                $scheduleData[$dayKey] = $value;
            }
        }
        
        return json_encode($scheduleData);
    }
}