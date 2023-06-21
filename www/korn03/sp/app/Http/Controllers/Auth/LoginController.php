<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated()
    {
        if (Auth::user()->is_admin == '1') //1 = Admin Login
        {
            return redirect('dashboard')->with('status', 'Welcome to your dashboard');
        } elseif (Auth::user()->is_admin == '0') // Normal or Default User Login
        {
            return redirect('/')->with('status', 'Logged in successfully');
        }
    }

    //AUTH2.0

    //Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')
            ->redirect();
    }

    //facebook callback
    public function handleFacebookCallback()
    {

        $user = Socialite::driver('facebook')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('home');
    }

    protected function _registerOrLoginUser($data)
    {
        $user = User::where('email', $data->email)->first();
        $firstlastName = explode(' ', $data->name);
        if (!$user) {
            $user = new User();
            $user->name = $firstlastName[0];
            $user->surname = $firstlastName[1];
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->save();
        }
        Auth::login($user);
    }


    //google

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->redirect();
    }
       //google callback
    public function handleGoogleCallback()
    {

        $user = Socialite::driver('google')->stateless()->user();

        $this->_registerorLoginUser($user);
        return redirect()->route('home');
    }


}
