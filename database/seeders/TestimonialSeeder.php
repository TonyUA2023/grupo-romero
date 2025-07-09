<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'name' => 'Roberto Sánchez',
                'position' => 'Arquitecto',
                'content' => 'Después de años usando lentes bifocales, los multifocales de Grupo Romero cambiaron mi vida. Ahora puedo trabajar en la computadora y conducir sin problemas.',
                'rating' => 5,
                'order' => 1
            ],
            [
                'name' => 'María Fernández',
                'position' => 'Profesora',
                'content' => 'La atención personalizada y la tecnología que usan es increíble. Mis nuevos lentes multifocales son tan cómodos que a veces olvido que los llevo puestos.',
                'rating' => 5,
                'order' => 2
            ],
            [
                'name' => 'Jorge Velasco',
                'content' => 'Excelente servicio y profesionales de primer nivel. Solucionaron un problema visual que tenía hace años con unas lentes progresivas personalizadas.',
                'rating' => 5,
                'order' => 3
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}