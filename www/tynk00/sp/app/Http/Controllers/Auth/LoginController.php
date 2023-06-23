<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{


    public function form(){
        return view('oauthForm');
    }


    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Implement your logic to authenticate the user or create a new user
        // For example:
        $noId = false;

        $existingUser = User::where('google_id', $user->getId())->first();

        if(!$existingUser){
            $existingUser = User::where('email', $user->getEmail())->first();
            $noId = true;
        }




        if ($existingUser) {

            if($noId){
                $existingUser->google_id = $user->getId();
                $existingUser->save();
            }
            
            Auth::login($existingUser);
        } else {
            // Create a new user record
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $randomPassword = Str::random(10); // Generate a random string with a length of 10 characters
            $newUser->password = Hash::make($randomPassword);
            $newUser->avatar = $user->getAvatar();
            $newUser->google_id = $user->getId();

            $newUser->save();

            $userEmail = $newUser->email;

            Mail::to($userEmail)->send(new WelcomeEmail());

            Auth::login($newUser);
        }

        return redirect()->route('dashboard');
    }
}