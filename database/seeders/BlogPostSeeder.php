<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        $posts = [
            [
                'title' => 'Todo sobre lentes multifocales: La solución para la presbicia',
                'slug' => 'lentes-multifocales-presbicia',
                'excerpt' => 'Descubre cómo los lentes multifocales pueden mejorar tu calidad de vida si sufres de presbicia.',
                'content' => '<p>La presbicia es una condición visual que afecta a la mayoría de personas después de los 40 años...</p>',
                'category' => 'Salud Visual',
                'tags' => json_encode(['lentes multifocales', 'presbicia', 'salud visual']),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5)
            ],
            [
                'title' => 'Cómo elegir el mejor lente según tu estilo de vida',
                'slug' => 'elegir-lentes-estilo-vida',
                'excerpt' => 'Guía completa para seleccionar los lentes que mejor se adapten a tus actividades diarias.',
                'content' => '<p>Cada persona tiene necesidades visuales diferentes según su profesión, hobbies y rutinas...</p>',
                'category' => 'Consejos',
                'tags' => json_encode(['lentes', 'consejos', 'salud visual']),
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(15)
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}