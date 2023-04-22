<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Socialite;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;


// class LoginController extends Controller
// {
//     public function index() {
//         return view('login');
//     }

//     public function login(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//         ]);

//         $credentials = $request->only('email', 'password');

//         if (Auth::attempt($credentials, $request->has('remember'))) {
//             $request->session()->regenerate();
//             return redirect()->intended('/store');
//         }

//         return back()->withErrors([
//             'email' => 'The provided credentials do not match our records.',
//         ]);
//     }

//     public function redirectToGitHub()
//     {
//         return Socialite::driver('github')->redirect();
//     }

//     public function handleGitHubCallback()
//     {
//         $githubUser = Socialite::driver('github')->user();

//         // If the email is null, set a default one
//         $email = $githubUser->getEmail() ?? 'no-email-' . $githubUser->getId() . '@example.com';

//         // Find the user in the database or create a new one
//         $user = User::firstOrCreate(
//             ['email' => $email],
//             [
//                 'name' => $githubUser->getName(),
//                 'password' => Hash::make(Str::random(24)), // Random password, as it won't be used
//             ]
//         );

//         // Log the user in
//         Auth::login($user, true);

//         return redirect()->intended('/store');
//     }



    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
