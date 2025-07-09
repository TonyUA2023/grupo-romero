<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            ServiceSeeder::class,
            PageSeeder::class,
            SectionSeeder::class,
            TeamMemberSeeder::class,
            TestimonialSeeder::class,
            BlogPostSeeder::class,
            GalleryItemSeeder::class,
        ]);
    }
}