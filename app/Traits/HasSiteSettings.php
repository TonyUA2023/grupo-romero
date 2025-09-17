<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

trait HasSiteSettings
{
    /**
     * Obtener un setting específico
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getSetting($key, $default = null)
    {
        return $this->getAllSettings()[$key] ?? $default;
    }

    /**
     * Obtener todos los settings
     * 
     * @return array
     */
    public function getAllSettings()
    {
        return Cache::remember('site_settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });
    }

    /**
     * Obtener settings de un grupo específico
     * 
     * @param string $group
     * @return array
     */
    public function getSettingsByGroup($group)
    {
        return Cache::remember("site_settings_{$group}", 3600, function () use ($group) {
            return Setting::where('group', $group)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Obtener horarios formateados
     * 
     * @return array
     */
    public function getSchedule()
    {
        $setting = Setting::where('key', 'schedule')->first();
        
        if (!$setting) {
            return [];
        }
        
        $schedule = $setting->getValueAsArray();
        $days = config('site-settings.fields.schedule.schedule.days', []);
        
        $formatted = [];
        foreach ($days as $dayKey => $dayLabel) {
            $formatted[$dayKey] = [
                'label' => $dayLabel,
                'hours' => $schedule[$dayKey] ?? 'Cerrado',
                'is_closed' => empty($schedule[$dayKey]) || $schedule[$dayKey] === 'Cerrado'
            ];
        }
        
        return $formatted;
    }

    /**
     * Obtener redes sociales activas
     * 
     * @return array
     */
    public function getSocialNetworks()
    {
        $social = $this->getSettingsByGroup('social');
        
        return array_filter($social, function($value) {
            return !empty($value);
        });
    }

    /**
     * Obtener información de contacto
     * 
     * @return array
     */
    public function getContactInfo()
    {
        return $this->getSettingsByGroup('contact');
    }

    /**
     * Limpiar caché de settings
     * 
     * @return void
     */
    public function clearSettingsCache()
    {
        Cache::forget('site_settings');
        
        $groups = array_keys(config('site-settings.groups', []));
        foreach ($groups as $group) {
            Cache::forget("site_settings_{$group}");
        }
    }
}

// Helper functions globales (opcional)
if (!function_exists('setting')) {
    /**
     * Obtener un setting específico
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        static $settings = null;
        
        if ($settings === null) {
            $settings = Cache::remember('site_settings', 3600, function () {
                return Setting::pluck('value', 'key')->toArray();
            });
        }
        
        return $settings[$key] ?? $default;
    }
}

if (!function_exists('site_config')) {
    /**
     * Obtener múltiples settings como objeto
     * 
     * @param array $keys
     * @return object
     */
    function site_config(array $keys = [])
    {
        $settings = [];
        
        if (empty($keys)) {
            $settings = Setting::pluck('value', 'key')->toArray();
        } else {
            $settings = Setting::whereIn('key', $keys)
                ->pluck('value', 'key')
                ->toArray();
        }
        
        return (object) $settings;
    }
}