<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User; // Asegúrate de que User esté importado
use Illuminate\Support\Facades\Log; // Importa el facade Log

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-admin', function (?User $user) {
            if (!$user) {
                return false; // No autenticado => no autorizado
            }
            return in_array($user->role, ['admin', 'manager']);
        });
    }
}