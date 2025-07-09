<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run()
    {
        $homePage = Page::where('slug', 'inicio')->first();

        $sections = [
            [
                'page_id' => $homePage->id,
                'type' => 'hero',
                'title' => 'Especialistas en Lentes Multifocales',
                'subtitle' => 'Solución visual avanzada para todas las distancias',
                'content' => null,
                'order' => 1
            ],
            [
                'page_id' => $homePage->id,
                'type' => 'features',
                'title' => '¿Por qué elegirnos?',
                'subtitle' => 'Ventajas de nuestros servicios',
                'content' => null,
                'data' => json_encode([
                    [
                        'icon' => 'fas fa-glasses',
                        'title' => 'Tecnología Avanzada',
                        'description' => 'Equipos de última generación para diagnósticos precisos'
                    ],
                    [
                        'icon' => 'fas fa-user-md',
                        'title' => 'Especialistas Certificados',
                        'description' => 'Optometristas con más de 10 años de experiencia'
                    ],
                    [
                        'icon' => 'fas fa-cogs',
                        'title' => 'Personalización Total',
                        'description' => 'Lentes adaptados a tus necesidades específicas'
                    ]
                ]),
                'order' => 2
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}