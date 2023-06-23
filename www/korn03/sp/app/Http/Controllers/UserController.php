<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;

class UserController extends Controller
{
    /*
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(): Renderable
    {
        return view('profile', ['user' => Auth::user(), 'addresses' => Address::where('user_id', Auth::user()->id)->get(), 'orders' => Order::where('user_id', Auth::user()->id)->get()]);
    }
    public function edit(): Renderable
    {
        return view('profile_edit', ['user' => Auth::user(), 'addresses' => Address::where('user_id', Auth::user()->id)->get(), 'orders' => Order::where('user_id', Auth::user()->id)->get()]);
    }

    public function updateInfo(Request $request)
    {
        /*
        mini-vzorec for myself
        $user = User::where('email', $data->email)->first();
        $firstlastName = explode(' ', $data->name);
        */
        /*
        $validated = $request->validate([
            'surname' => 'required|unique:posts|max:255',
            'name' => 'required|unique:posts',
            'email' => 'email:rfc'
            'title' => ['required', 'unique:posts', 'max:255'],
        ]);
        */
        $request->validate([
            'name' => 'required|max:125',
            'surname' => 'required|max:125',
            'email' => 'required|email:rdc|max:255',
            'phone'=> 'nullable|max:20',

        ]);


        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        if (isset($request->phone)) {
            $user->phone = $request->phone;
        }

        $user->save();
        return redirect(route('profile'));
    }
    public function updateAddress(Request $request)
    {
        $request->validate([
            'country' => 'required|max:3',
            'city' => 'required|max:25',
            'street' => 'required|max:50',
            'home'=> 'required|max:50',
            'postcode'=> 'required|max:11',

        ]);

        $address = Address::find($request->address_id);
        $address->country = $request->country;
        $address->city = $request->city;
        //$address->user_id = (Auth::user()->id);
        $address->street = $request->street;
        $address->home = $request->home;
        $address->postcode = $request->postcode;

        $address->save();

        return redirect(route('profile'));
    }
    public function deleteAddress(Request $request)
    {
    }
}
