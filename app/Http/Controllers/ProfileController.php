<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect};
use Illuminate\View\View;

class ProfileController extends Controller
{
    private string $page = 'Profile';
    private string $label;
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showProfile(Request $request): View
    {
        $this->label = Auth::user()->name;
        $this->data = [
            'parent' => $this->page,
            'child' => $this->label,
            'user' => $request->user(),
        ];
        return view('pages.profile.index', $this->data);
    }

    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    public function deleteProfile(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        $auth = Auth::user()->hasLeader->first();
        User::where('created_by', $auth->id)->delete();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
