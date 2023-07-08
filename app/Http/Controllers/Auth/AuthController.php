<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showAuthPage(): View
    {
        return view('pages.login.index');
    }

    public function getLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'username' => 'Kesalahan kredensial.',
        ]);
    }

    public function getTimeLogging()
    {
        $from = Carbon::createFromFormat('Y-m-d H:i:s', Auth::user()->last_seen);
        $to = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $diff = $to->diffInMinutes($from);

        return response()->json(['time' => $diff]);
    }

    public function getLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
