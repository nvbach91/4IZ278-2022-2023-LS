<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController{
    public function register( $data ): int {
        $user = User::where( "username", $data->username )->where( "provider_id", $data->id );
        if( isset( $user ) ){
            return 1;
        }
        $user = new User();
        $user->username = $data->username;
        $user->password = isset( $data->password )?$data->password:"";
        $user->email = $data->email;
        $user->provider_id = $data->id;
        $user->save();
        Auth::login( $user );
        #DB::insert
        return 0; #confirm registration
    }

    public function login( $data ): int {
        $user = User::where( "username", $data->username )->where( "provider_id", $data->id )->where( "password", isset( $data->password )?$data->password:"" );
        if( !$user ){
            return 1;
        }
        Auth::login( $user );
        return 0;
    }

    #https://www.honeybadger.io/blog/laravel-oauth/
    public function redirectToGoogle(){
        return Socialite::driver("google")->stateless()->redirect();
    }

    public function handleGoogleCallback(){
        $user = Socialite::driver("google")->stateless()->user();
        if( $this->login( $user ) == 1 ){
            if( $this->register( $user ) == 1 ){
                return redirect()->route("login"); //register and login failed
            }
        }
        return redirect()->route("home");
    }

    public function redirectToFacebook(){
        return Socialite::driver("facebook")->stateless()->redirect();
    }

    public function handleFacebookCallback(){
        $user = Socialite::driver("google")->stateless()->user();
        if( $this->login( $user ) == 1 ){
            if( $this->register( $user ) == 1 ){
                return redirect()->route("login"); //register and login failed
            }
        }
        return redirect()->route("home");
    }
}
?>
