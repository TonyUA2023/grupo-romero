<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log; // Importa el facade Log

class User extends Authenticatable // No necesitas implementar MustVerifyEmail si no la usas activamente
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // <-- Cambiado de 'role' a 'is_admin'
        'phone',
        'avatar',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean', // <-- Asegura que 'is_admin' se trate como booleano
        'is_active' => 'boolean'
    ];

    /**
     * Verifica si el usuario tiene privilegios de administrador.
     * Basado en el nuevo campo 'is_admin'.
     */
    public function isAdmin(): bool
    {
        // Añadido para depuración: Muestra el valor de is_admin para este usuario
        Log::info('Calling isAdmin() for user:', [
            'id' => $this->id,
            'email' => $this->email,
            'is_admin_value' => $this->is_admin // Accede directamente a la propiedad
        ]);

        return (bool) $this->is_admin; // Convierte explícitamente a booleano por si el cast falla
    }
}