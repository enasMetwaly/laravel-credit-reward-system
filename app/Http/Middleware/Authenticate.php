<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($request->is('admin/*')) {
            return route('admin.auth.login');
        }

        return route('home'); // Ensure 'home' is defined, or use '/'
    }
}