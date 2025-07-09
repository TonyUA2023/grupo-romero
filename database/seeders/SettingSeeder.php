<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::truncate();

        $settings = [
            // Información general
            ['key' => 'site_name', 'value' => 'Grupo Romero Ópticas', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Centro de Salud Visual. Especialistas en lentes MULTIFOCALES', 'type' => 'textarea', 'group' => 'general'],
            
            // Contacto
            ['key' => 'phone', 'value' => '+51 1 123 4567', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'whatsapp', 'value' => '51987654321', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@romeroopticas.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'Av. Javier Prado 1234, San Isidro, Lima', 'type' => 'text', 'group' => 'contact'],
            
            // Horarios
            ['key' => 'schedule', 'value' => json_encode([
                'Lunes a Viernes' => '9:00 AM - 7:00 PM',
                'Sábados' => '9:00 AM - 2:00 PM',
                'Domingos' => 'Cerrado'
            ]), 'type' => 'json', 'group' => 'schedule'],
            
            // Redes sociales
            ['key' => 'facebook', 'value' => 'https://facebook.com/romeroopticas', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/romeroopticas', 'type' => 'text', 'group' => 'social'],
            
            // SEO
            ['key' => 'meta_title', 'value' => 'Grupo Romero Ópticas - Especialistas en Lentes Multifocales', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Centro de salud visual especializado en lentes multifocales. Exámenes de la vista completos y soluciones visuales avanzadas en Lima.', 'type' => 'textarea', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}