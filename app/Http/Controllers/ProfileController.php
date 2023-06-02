<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Interface\ValidationData;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Institute;
use App\Models\User;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\{Auth, Redirect};
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller implements ValidationData
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
        $request->user()->save();
        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request)
    {
        $v_data = $this->validateDataCreate($request);
        $request->user()->update([
            'password' => Hash::make($v_data['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function validateDataCreate(Request $request)
    {
        $password =  $request->validateWithBag(
            'updatePassword',
            [
                'current_password' => ['required'],
                'password' => ['required', 'confirmed', 'string', 'min:8', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[!@#$%^&*(),.?":{}|<>]/'],
            ],
            [
                'current_password.required' => 'Kolom kata sandi saat ini harus diisi.',
                'password.required' => 'Kolom kata sandi baru harus diisi.',
                'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
                'password.string' => 'Kolom kata sandi harus berupa teks.',
                'password.min' => 'Kata sandi harus terdiri dari setidaknya :min karakter.',
                'password.regex' => 'Kata sandi harus terdiri dari setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu karakter khusus (!@#$%^&*(),.?":{}|<>).',
            ]
        );

        return $password;
    }

    public function updateInstitute(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'institute' => ['required']
            ],
            [
                'required' => 'Kolom :attribute harus diisi.'
            ]
        );

        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $ins = Auth::user()->id;
        $institute = Institute::where('created_by', $ins)->first();
        $instituteName = strtolower(trim($institute->institute_name));
        $words = explode(' ', $instituteName);
        $instituteName = $words[0];

        $ins_member = strtolower(trim($request->input('institute')));
        $member_index = explode(' ', $ins_member);
        $index = $member_index[0];

        $institute->institute_name = $request->input('institute');
        $institute->save();

        $leader = Auth::user()->hasLeader;
        $id = $leader[0]['id'];
        $users = User::where('created_by', $id)->get();
        foreach ($users as $user) {
            $emailParts = explode('.', $user->email);
            if (strtolower($emailParts[0]) === $instituteName) {
                $emailParts[0] = $index;
                $newEmail = implode('.', $emailParts);
                $user->email = $newEmail;
                $user->save();
            }
        }

        return back()->with('status', 'institute-updated');
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
