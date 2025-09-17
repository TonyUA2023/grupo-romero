<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group'
    ];

    // Removemos el cast automático para evitar conflictos
    protected $casts = [
        // 'value' => 'array' // ← Este cast está causando el problema
    ];

    public static function getValue($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // Agregar método para obtener valor como array cuando sea necesario
    public function getValueAsArray()
    {
        if ($this->type === 'json') {
            return json_decode($this->value, true);
        }
        return $this->value;
    }

    // Agregar método para establecer valor como array
    public function setValueAsArray($value)
    {
        if ($this->type === 'json') {
            $this->value = json_encode($value);
        } else {
            $this->value = $value;
        }
    }
}