<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Romero',
            'email' => 'admin@romeroopticas.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'phone' => '+51 987 654 321',
            'avatar' => null,
            'is_active' => true,
        ]);
    }
}