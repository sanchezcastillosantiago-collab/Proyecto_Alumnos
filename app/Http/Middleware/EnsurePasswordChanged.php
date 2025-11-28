<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePasswordChanged
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Only act for authenticated users
        if ($user) {
            // Allow access to the change password routes to avoid loop
            if ($request->routeIs('password.change') || $request->routeIs('password.change.post')) {
                return $next($request);
            }

            if ($user->must_change_password) {
                return redirect()->route('password.change');
            }
        }

        return $next($request);
    }
}
