<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Dapatkan token dari HTTP header Authorization
        $token = $request->header('Authorization');

        // Validasi token pada tabel pengguna
        $user = User::where('remember_token', $token)->first();
        if (!$user) {
            return redirect('/login');
        }

        // Token valid, lanjutkan ke request selanjutnya
        return $next($request);
    }
}
