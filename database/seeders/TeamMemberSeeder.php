<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run()
    {
        $members = [
            [
                'name' => 'Dr. Carlos Romero',
                'position' => 'Optometrista Senior',
                'bio' => 'Especialista en lentes progresivos con más de 15 años de experiencia. Certificado por la Asociación Internacional de Optometría.',
                'specialties' => 'Lentes Multifocales, Terapia Visual',
                'education' => 'Doctor en Optometría - Universidad Nacional Mayor de San Marcos',
                'social_links' => json_encode([
                    'linkedin' => 'https://linkedin.com/in/carlosromero'
                ]),
                'order' => 1
            ],
            [
                'name' => 'Dra. Laura Mendoza',
                'position' => 'Especialista en Contactología',
                'bio' => 'Experta en adaptación de lentes de contacto especiales y tratamiento de ojo seco.',
                'specialties' => 'Lentes de Contacto, Queratocono',
                'education' => 'Máster en Contactología Avanzada - Universidad de Barcelona',
                'order' => 2
            ],
        ];

        foreach ($members as $member) {
            TeamMember::create($member);
        }
    }
}