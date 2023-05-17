<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSession
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the session ID matches the cookie value
            if ($request->session()->getId() !== $request->cookie(session_name())) {
                Auth::logout();
                return redirect('/login')->with('message', 'Your session has expired. Please login again.');
            }
        }

        return $next($request);
    }
}
