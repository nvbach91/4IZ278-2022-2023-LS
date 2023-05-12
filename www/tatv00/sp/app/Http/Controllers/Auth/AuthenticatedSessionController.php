<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $clearCartCookie = cookie('cart', null, -1);


        return redirect('/')->withCookie($clearCartCookie);;
    }

    /**
     * Redirect to GitHub for authentication.
     */
    public function redirectToGitHub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Handle the GitHub callback.
     */
    public function handleGitHubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        // If the email is null, set a default one
        $email = $githubUser->getEmail() ?? 'no-email-' . $githubUser->getId() . '@example.com';

        // Find the user in the database or create a new one
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $githubUser->getName(),
                'password' => Hash::make(Str::random(24)), // Random password, as it won't be used
            ]
        );

        // Log the user in
        Auth::login($user, true);

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
