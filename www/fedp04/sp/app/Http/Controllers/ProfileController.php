<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
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
}

?>
