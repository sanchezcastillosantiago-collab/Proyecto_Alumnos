<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Alias middleware so we can use it in routes without editing Kernel
        if ($this->app->bound('router')) {
            $this->app['router']->aliasMiddleware('must.change', \App\Http\Middleware\EnsurePasswordChanged::class);
            $this->app['router']->aliasMiddleware('admin.or404', \App\Http\Middleware\EnsureAdminOr404::class);
        }
    }
}
