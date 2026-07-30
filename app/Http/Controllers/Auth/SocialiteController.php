<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the Google authentication callback.
     */
    public function handleGoogleCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Google sign-in was cancelled or expired. Please try again.',
            ]);
        } catch (\Exception $e) {
            Log::error('Google OAuth failed', ['error' => $e->getMessage()]);

            return redirect()->route('login')->withErrors([
                'email' => 'Google authentication failed. Please try again.',
            ]);
        }

        // Check if a user already exists with this email
        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // Log in the existing user
            Auth::login($existingUser);

            return redirect()->intended(route('home', absolute: false));
        }

        // Create a new user
        $user = User::create([
            'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User',
            'email' => $googleUser->getEmail(),
            'password' => Hash::make(Str::random(24)),
            'email_verified_at' => now(),
        ]);

        Auth::login($user);

        toast()->success('Account created successfully!');

        return redirect()->intended(route('home', absolute: false));
    }
}
