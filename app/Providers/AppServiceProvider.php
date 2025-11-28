<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;

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

        // Send verification email automatically when a user registers
        Event::listen(Registered::class, function (Registered $event) {
            try {
                $event->user->sendEmailVerificationNotification();
            } catch (\Throwable $e) {
                // don't break app if mail fails in local env
                logger()->error('Failed to send verification email: ' . $e->getMessage());
            }
        });
    }
}
