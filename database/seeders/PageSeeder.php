<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run()
    {
        $pages = [
            [
                'title' => 'Inicio',
                'slug' => 'inicio',
                'content' => '<h1>Bienvenidos a Grupo Romero Ópticas</h1><p>Centro especializado en salud visual con más de 15 años de experiencia. Especialistas en lentes multifocales de alta precisión.</p>',
                'meta_title' => 'Inicio | Grupo Romero Ópticas',
                'meta_description' => 'Centro de salud visual especializado en lentes multifocales. Exámenes completos y soluciones visuales avanzadas.',
                'status' => true,
                'order' => 1
            ],
            [
                'title' => 'Nosotros',
                'slug' => 'nosotros',
                'content' => '<h2>Nuestra Historia</h2><p>Fundada en 2010, Grupo Romero Ópticas se ha especializado en soluciones visuales avanzadas, siendo pioneros en lentes multifocales en Perú.</p>',
                'meta_title' => 'Conócenos | Grupo Romero Ópticas',
                'status' => true,
                'order' => 2
            ],
            [
                'title' => 'Servicios',
                'slug' => 'servicios',
                'content' => '<h2>Nuestros Servicios Especializados</h2><p>Ofrecemos soluciones visuales personalizadas para cada necesidad.</p>',
                'meta_title' => 'Servicios de Salud Visual | Grupo Romero Ópticas',
                'status' => true,
                'order' => 3
            ],
            [
                'title' => 'Contacto',
                'slug' => 'contacto',
                'content' => '<h2>Agenda tu Cita</h2><p>Estamos disponibles para resolver todas tus dudas sobre salud visual.</p>',
                'meta_title' => 'Contáctanos | Grupo Romero Ópticas',
                'status' => true,
                'order' => 4
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}