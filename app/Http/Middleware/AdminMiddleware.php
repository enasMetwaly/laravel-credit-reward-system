<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            logger('AdminMiddleware: User not authenticated as admin. Session: ' . json_encode($request->session()->all()));
            return redirect()->route('admin.auth.login')->withErrors(['message' => 'Please login as an admin.']);
        }
        return $next($request);
    }
}