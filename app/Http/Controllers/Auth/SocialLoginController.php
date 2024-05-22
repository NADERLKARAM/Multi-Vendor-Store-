<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Throwable;

class SocialLoginController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)
            //->scopes(['https://www.googleapis.com/auth/drive.file'])
            ->redirect();
    }

    public function callback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();

            // Check if the user already exists by email
            $user = User::where('email', $providerUser->email)->first();

            if ($user) {
                // If user exists but with a different provider, update the provider details
                if ($user->provider !== $provider || $user->provider_id !== $providerUser->id) {
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $providerUser->id,
                        'provider_token' => $providerUser->token,
                    ]);
                }
            } else {
                // If user does not exist, create a new user
                $user = User::create([
                    'name' => $providerUser->name,
                    'email' => $providerUser->email,
                    'password' => Hash::make(Str::random(8)),
                    'provider' => $provider,
                    'provider_id' => $providerUser->id,
                    'provider_token' => $providerUser->token,
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect to the intended page
            return redirect()->route('home');

        } catch (Throwable $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Unable to login. Please try again.',
            ]);
        }
    }
}