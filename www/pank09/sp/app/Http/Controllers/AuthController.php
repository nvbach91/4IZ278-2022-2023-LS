<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('signout');
    }
    
    public function signin()
    {
        return view('auth.signin');
    }  
      
    public function signinUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'))->withSuccess('You have successfully signed in!');
        }
  
        return redirect()->route('signin')->withError('Sign in credentials are invalid.');
    }

    public function signup()
    {
        return view('auth.signup');
    }
      
    public function signupUser(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
         
        return redirect()->route('signin')->withSuccess('You have successfully signed up!');
    }
    
    public function signout()
    {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('signin')->withInfo('You have successfully signed out!');
    }

    public function facebookLogin()
    {
        $redirectUrl = urlencode(route('signin.facebook.handler'));
        return redirect("https://www.facebook.com/". env('FACEBOOK_APP_VERSION') ."/dialog/oauth?client_id=". env('FACEBOOK_APP_ID') ."&redirect_uri=". $redirectUrl ."&state=". csrf_token() ."&scope=email&response_type=code");
    }

    public function facebookLoginHandler(Request $request)
    {
        $code = $request->input('code');

        if (empty($code))
            return redirect()->route('signin')->withError('Failed to authenticate with Facebook.');

        $response = Http::get('https://graph.facebook.com/'. env('FACEBOOK_APP_VERSION') .'/oauth/access_token', [
            'client_id' => env('FACEBOOK_APP_ID'),
            'client_secret' => env('FACEBOOK_APP_SECRET'),
            'redirect_uri' => route('signin.facebook.handler'),
            'code' => $code,
        ]);

        if (!$response->ok())
            return redirect()->route('signin')->withError('Failed to authenticate with Facebook. Failed to get access token.');

        $accessToken = $response->json()['access_token'];

        $response = Http::get('https://graph.facebook.com/'. env('FACEBOOK_APP_VERSION') .'/me', [
            'access_token' => $accessToken,
            'fields' => 'name,email',
        ]);

        if (!$response->ok())
            return redirect()->route('signin')->withError('Failed to authenticate with Facebook. Failed to get your profile.');

        $userData = $response->json();

        $user = User::where('email', $userData['email'])->first();

        if (!$user) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make(Str::random(16))
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('signin')->withSuccess('You have successfully signed up!');
    }
}
