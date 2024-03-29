<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile() : Renderable
    {
        return view('profile', ['user' => Auth::user()]);
    }


    public function update( Request $request){
    //validation rules

        // $request->validate([
        //         'name' =>'required|min:4|string|max:255',
        //         'surname' =>'required|min:4|string|max:255',
        //         'email'=>'required|email|string|max:255',
        //         'adress'=>'string|max:255',
        //         'phone'=>'string|max:255',
        //     ]);
        $user = Auth::user();
        if ($user->provider_id != null && $request->input('email') != $user->email) {
            throw ValidationException::withMessages(['field_name' => 'You cant change email if you are logged in with social media']);
        }
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => [
                'required', 'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        if ($request->input('country') != null) {
            $user->country = $request->input('country');
        }
        if ($request->input('city') != null) {
                $user->city = $request->input('city');
        }
        if ($request->input('street') != null) {
            $user->street = $request->input('street');
        }
        if ($request->input('house') != null) {
            $user->house = $request->input('house');
        }
        if ($request->input('zip') != null) {
            $user->zip = $request->input('zip');
        }
        if ($request->input('phone') != null) {
            $user->phone = $request->input('phone');
        }
        $user->update();
        return back();
    }
}

?>
