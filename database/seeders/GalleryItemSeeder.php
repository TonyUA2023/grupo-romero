<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class GalleryItemSeeder extends Seeder
{
    public function run()
    {
        // Crear imagen de marcador de posición si no existe
        $placeholderPath = 'gallery/placeholder.jpg';
        if (!Storage::disk('public')->exists($placeholderPath)) {
            Storage::disk('public')->put(
                $placeholderPath, 
                file_get_contents('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQu7vx16XwsUlcvF9ephK3J33c7hU6WzsTU5A&s')
            );
        }

        $items = [
            [
                'title' => 'Sala de Exámenes',
                'description' => 'Nuestro espacio equipado con tecnología de última generación',
                'image' => $placeholderPath, // Usar la misma imagen para todos los items
                'category' => 'instalaciones',
                'order' => 1
            ],
            [
                'title' => 'Lentes Multifocales Premium',
                'description' => 'Nuestra línea exclusiva de lentes progresivos',
                'image' => $placeholderPath,
                'category' => 'productos',
                'order' => 2
            ],
            [
                'title' => 'Equipo de Trabajo',
                'description' => 'Profesionales altamente capacitados',
                'image' => $placeholderPath,
                'category' => 'equipo',
                'order' => 3
            ],
        ];

        foreach ($items as $item) {
            GalleryItem::create($item);
        }
    }
}