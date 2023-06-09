<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $user = User::where('email', $credentials['email'])->first();

        if($user && $user->archived) {
            return false;
        }

        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $credentials = $this->credentials($request);
        $user = User::where('email', $credentials['email'])->first();

        if($user && $user->archived) {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.archived')],
            ]);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                if($user->archived) {
                    throw ValidationException::withMessages([
                        'email' => ['Your account has been archived. Please contact the administrator.'],
                    ]);
                }

                Auth::login($user, true);
            } else {
                $newUser = new User;
                $newUser->name = $googleUser->name;
                $newUser->email = $googleUser->email;
                $newUser->google_id = $googleUser->id;
                $newUser->password = Hash::make(Str::random(16));
                $newUser->save();

                Auth::login($newUser, true);
            }

            return redirect()->intended('home');
        } catch (ValidationException $e) {
            return redirect('login')->withErrors($e->errors());
        } catch (Exception $e) {
            return redirect('login');
        }
    }
}
