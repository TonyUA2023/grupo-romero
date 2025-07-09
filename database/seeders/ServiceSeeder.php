<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Examen Visual Completo',
                'slug' => 'examen-visual-completo',
                'short_description' => 'Evaluación completa de la salud ocular y calidad visual',
                'description' => 'Examen especializado que evalúa todas las áreas de la visión incluyendo detección de enfermedades oculares, agudeza visual, presión intraocular y evaluación de retina.',
                'price' => 120.00,
                'duration' => '60 minutos',
                'featured' => true,
                'order' => 1
            ],
            [
                'name' => 'Lentes Multifocales Premium',
                'slug' => 'lentes-multifocales-premium',
                'short_description' => 'Solución visual para todas las distancias',
                'description' => 'Lentes de última generación que permiten ver con claridad a todas las distancias sin líneas visibles. Tecnología FreeForm personalizada para cada paciente.',
                'price' => 850.00,
                'duration' => null,
                'featured' => true,
                'order' => 2
            ],
            [
                'name' => 'Adaptación de Lentes de Contacto',
                'slug' => 'adaptacion-lentes-contacto',
                'short_description' => 'Solución especializada para usuarios de lentes de contacto',
                'description' => 'Evaluación, adaptación y seguimiento para usuarios de lentes de contacto. Incluye enseñanza de manipulación, cuidado y seguimiento mensual.',
                'price' => 180.00,
                'duration' => '3 sesiones',
                'featured' => true,
                'order' => 3
            ],
            [
                'name' => 'Tratamiento para Ojo Seco',
                'slug' => 'tratamiento-ojo-seco',
                'short_description' => 'Solución avanzada para síndrome de ojo seco',
                'description' => 'Evaluación con tecnología avanzada y tratamiento personalizado para el síndrome de ojo seco. Incluye terapia con luz pulsada y recomendaciones personalizadas.',
                'price' => 300.00,
                'duration' => '4 sesiones',
                'featured' => false,
                'order' => 4
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}