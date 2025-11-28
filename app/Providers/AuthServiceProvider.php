<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Tarea;
use App\Models\User;
use App\Policies\TareaPolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tarea::class => TareaPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate para comprobar rol de administrador desde vistas y middleware
        \Illuminate\Support\Facades\Gate::define('is-admin', function (?User $user) {
            return $user !== null && $user->isAdmin();
        });
    }
}
