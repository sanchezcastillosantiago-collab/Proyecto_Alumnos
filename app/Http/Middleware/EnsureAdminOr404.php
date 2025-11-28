<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdminOr404
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // If the user is not authenticated, let auth middleware handle redirect to login
        if (! $user) {
            return redirect()->guest(route('login'));
        }

        // If user is not admin, hide the resource by returning 404
        if (! $user->isAdmin()) {
            abort(404);
        }

        return $next($request);
    }
}
