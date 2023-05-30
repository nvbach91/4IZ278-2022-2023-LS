<?php

namespace App\Http\Controllers\Auth;

use App\Mail\UserCreated;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirectUrl(env('FRONTEND_URL') . '/system/auth/google/callback')->redirect();
    }

    public function handleGoogleCallback(Request $request): RedirectResponse
    {
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->user();
            // if the user exits, use that user and login
            $finduser = User::where('google_id', $user->id)->first();
            $finduser_email = User::where('email', $user->email)->first();
            if ($finduser) {
                //if the user exists, login and show dashboard
                Auth::login($finduser);
                $request->session()->regenerate();
                return redirect(env('FRONTEND_URL', '/'));
            } else if ($finduser_email) {
                //if the user exists, login and show dashboard
                $finduser_email->google_id = $user->id;
                $finduser_email->save();
                Auth::login($finduser_email);
                $request->session()->regenerate();
                return redirect(env('FRONTEND_URL', '/'));
            } else {
                //user is not yet created, so create first
                $newUser = User::create([
                    'email' => $user->email,
                    'password' => encrypt(''),
                    'google_id' => $user->id
                ]);
                // save the team and add the team to the user.

                $newUser->save();
                event(new Registered($newUser));
                Mail::to($request->user())->send(new UserCreated());
                //login as the new user
                Auth::login($newUser);
                // go to the dashboard
                return redirect(env('FRONTEND_URL', '/'));
            }
            //catch exceptions
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return redirect(env('FRONTEND_URL', '/auth'));
    }
}