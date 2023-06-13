<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('users.login');
    }

    public function showRegistration()
    {
        return view('users.register');
    }

    public function showSettings() {
        return view('users.settings');
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('user', 'email')],
                'password' => [
                    'required', Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                ],
                'password_check' => 'required|min:8|same:password',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $formFields = $request->except('_token'); 
        $formFields['role'] = 'user';
        $formFields['is_active'] = 1;

        $formFields['password'] = bcrypt($formFields['password']);
        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in!');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials!'])->onlyInput('email');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }
}
