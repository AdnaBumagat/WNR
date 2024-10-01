<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is an admin
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request);
        }

        // Redirect non-admin users to the home page
        return redirect('/');
    }
}
