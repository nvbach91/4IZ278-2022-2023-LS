<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *
     */
    public function profile() : Renderable
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function profileUpdate(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user->provider_id != null && $request->input('email') != $user->email) {
            throw ValidationException::withMessages(['field_name' => 'You cant change email if you are logged in with social media']);
        }
        $request->validate([
            'first_name' => 'required', 'max:64',
            'last_name' => 'required',' max:64',
            'phone' => 'max:16', 'phone',
            'email' => [
                'required', 'email', 'max:64',
                Rule::unique('users')->ignore($user->id),
            ],
            'isic_number' => 'max:32',
        ]);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        if ($request->input('adress') != null) {
            $user->adress = $request->input('adress');
        }
        if ($request->input('phone') != null) {
            $user->phone = $request->input('phone');
        }
        $user->update();
        return back();
    }


    /**
     * Show the admin dashboard.
     */
    public function adminIindex() : Renderable
    {
        return view('admin');
    }
}
