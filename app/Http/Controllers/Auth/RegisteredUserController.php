<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.pages.register.index');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = User::with('userStores')->whereHas('userStores', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        if ($user == null) {
            return redirect()->route('management.employee.index');
        } else {
            $store = $user->userStores->store_name;
        }

        $array = array($store, $request->email);
        $string = implode('.', $array);

        $auth = Auth::user()->id;

        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|max:255|unique:users",
            "password" => ["required", "min:5"],
            "status" => "required|numeric",
        ]);
        $token = Str::random(64);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'status' => ['required', 'integer'],
        ]);

        $user = User::create([
            'id_role' => 2,
            'name' => $request->name,
            'email' => $string,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'created_by' => $auth,
            'remember_token' => $token
        ]);


        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->route('management.employee.index');
    }
}
