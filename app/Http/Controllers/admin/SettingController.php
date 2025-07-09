<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        // Obtener todos los ajustes agrupados por grupo
        $settings = DB::table('settings')
            ->orderBy('group')
            ->orderBy('key')
            ->get()
            ->groupBy('group');
            
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validar todos los campos dinámicamente
        $rules = [];
        $messages = [];
        
        // Obtener todos los ajustes para construir reglas
        $allSettings = DB::table('settings')->get();
        
        foreach ($allSettings as $setting) {
            $key = $setting->key;
            $type = $setting->type;
            
            // Construir reglas basadas en el tipo
            switch ($type) {
                case 'image':
                    $rules[$key] = 'nullable|image|max:2048';
                    break;
                case 'json':
                    // Para campos JSON validamos cada subcampo
                    if ($key === 'schedule') {
                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                        foreach ($days as $day) {
                            $rules["{$key}.{$day}"] = 'nullable|string|max:50';
                        }
                    }
                    break;
                default:
                    $rules[$key] = 'nullable|string|max:255';
                    break;
            }
        }

        // Validar los datos
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Procesar cada ajuste
        foreach ($allSettings as $setting) {
            $key = $setting->key;
            $type = $setting->type;
            $value = $request->input($key);
            
            // Manejar tipos especiales
            switch ($type) {
                case 'image':
                    // Manejar carga de imagen
                    if ($request->hasFile($key)) {
                        // Eliminar imagen anterior si existe
                        if ($setting->value) {
                            Storage::disk('public')->delete($setting->value);
                        }
                        
                        // Guardar nueva imagen
                        $path = $request->file($key)->store('settings', 'public');
                        DB::table('settings')
                            ->where('key', $key)
                            ->update(['value' => $path]);
                    }
                    break;
                
                case 'json':
                    // Manejar datos JSON
                    if ($key === 'schedule') {
                        $scheduleData = [];
                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                        
                        foreach ($days as $day) {
                            $scheduleData[$day] = $request->input("schedule.{$day}");
                        }
                        
                        DB::table('settings')
                            ->where('key', $key)
                            ->update(['value' => json_encode($scheduleData)]);
                    }
                    break;
                
                default:
                    // Actualizar valor normal
                    DB::table('settings')
                        ->where('key', $key)
                        ->update(['value' => $value]);
                    break;
            }
        }
        
        return redirect()->route('admin.settings.index')
            ->with('success', 'Configuración actualizada exitosamente.');
    }
}