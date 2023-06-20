<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        // Find existing user by email
        $user = User::where('email', $githubUser->getEmail())->first();

        // Create a new user if it doesn't exist
        if (!$user) {
            $user = User::create([
                'name' => $githubUser->getName(),
                'email' => $githubUser->getEmail(),
                // You may want to ask the user to provide a password after registering with GitHub
                'password' => Hash::make(Str::random(24)),
            ]);
        }

        // Log the user in
        Auth::login($user, true);

        return redirect('/');  // or wherever you want to redirect after login
    }
}

