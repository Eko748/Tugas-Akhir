<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\Project;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvideCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            // ->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->back();
        }
        $authUser = $this->findOrCreateUser($user, $provider);

        Auth()->login($authUser, true);

        if ($authUser->wasRecentlyCreated) {
            session()->flash('status', 'new-user');
        }

        return redirect()->route('dashboard.index');
    }


    public function findOrCreateUser($socialUser, $provider)
    {
        $socialAccount = SocialAccount::where('provider_id', $socialUser->getId())
            ->where('provider_name', $provider)
            ->first();
        if ($socialAccount) {
            return $socialAccount->user;
        } else {
            $user = User::where('email', $socialUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'id' => random_int(1000000, 9999999),
                    'uuid_user' => Str::uuid(),
                    'code' => 'A',
                    'role_id' => 1,
                    'name'  => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(12345678),
                ]);

                $leader = Leader::create(
                    [
                        'id' => random_int(1000000, 9999999),
                        'user_id' => $user->id,
                        'created_at' => now()
                    ]
                );

                Project::create(
                    [
                        'id' => random_int(1000000, 9999999),
                        'leader_id' => $leader->id,
                        'uuid_project' => Str::uuid(),
                        'created_by' => $user->id,
                        'created_at' => now()
                    ]
                );
            }

            $user->socialAccounts()->create([
                'id' => random_int(1000000, 9999999),
                'provider_id'   => $socialUser->getId(),
                'provider_name' => $provider,
                'created_at' => now()
            ]);

            return $user;
        }
    }
}
