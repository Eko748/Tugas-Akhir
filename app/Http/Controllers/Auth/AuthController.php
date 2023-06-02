<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showAuthPage(): View
    {
        return view('auth.pages.login.index');
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed...
    //         $user = Auth::user();
    //         Session::put('user', $user);
    //         return redirect()->intended('/dashboard');
    //     } else {
    //         return back()->withErrors([
    //             'email' => 'The provided credentials do not match our records.',
    //         ]);
    //     }
    // }


    public function getLogin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function getTimeLogging()
    {
        $from = Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->last_seen);
        $to = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $diff = $to->diffInMinutes($from);

        return response()->json(['time' => $diff]);
    }

    public function getLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect('/login');
    }
}
