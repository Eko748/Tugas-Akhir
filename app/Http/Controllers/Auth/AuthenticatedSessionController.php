<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.pages.login.index');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role_id == '1') {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else if (Auth::user()->role_id == '2') {
            return redirect()->intended(RouteServiceProvider::MEMBER);
        } else {
            return abort(403);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect('/login');
    }

    public function storeAjax(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::user()->role_id == '1') {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else if (Auth::user()->role_id == '2') {
            return redirect()->intended(RouteServiceProvider::MEMBER);
        } else {
            return abort(403);
        }
    }
}
