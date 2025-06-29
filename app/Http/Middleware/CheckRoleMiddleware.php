<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('admin')->user()->hasRole('admin')) { // Example role check
            return redirect('/admin/login')->withErrors(['message' => 'Unauthorized.']);
        }
        return $next($request);
    }
}