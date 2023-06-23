<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Item;
use App\Models\Order;
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

    public function index(): RedirectResponse
    {
        return redirect()->route('index');
    }

    /**
     *
     */
    public function profile() : Renderable
    {
        return view('profile',
            ['user' => Auth::user(),
                'adresses' => Adress::all()->where('user_id', Auth::user()->id),
                'orders' => Order::all()->where('user_id', Auth::user()->id),
            ]);
    }

    public function profileUpdate(Request $request): RedirectResponse
    {
        $user = Auth::user();
        if ($user->provider_id != null && $request->input('email') != $user->email) {
            back()->with('error' , 'You cant change email if you are logged in with social media');
        }
        $request->validateWithBag('profile', [
            'first_name' => 'required', 'max:64', 'regex:/\w+/',
            'last_name' => 'required',' max:64', 'regex:/\w+/',
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
        return back()->with('success', 'Profile updated successfully.');
    }

    public function addAdress(Request $request)
    {
        $request->validateWithBag('adress',[
            'country' => 'required', 'max:32', 'regex:/\w+/',
            'city' => 'required', 'max:128', 'regex:/\w+/',
            'adress1' => 'required', 'max:128', 'regex:/\w+/',
            'adress2' => 'max:128', 'regex:/\w+/',
            'zip' => 'max:10', 'regex:/\d{5}/',
        ]);
        $adress = new Adress();
        $adress->adress_1 = $request->input('adress1');
        $adress->adress_2 = $request->input('adress2');
        $adress->city = $request->input('city');
        $adress->country = $request->input('country');
        $adress->zip_code = $request->input('zip');
        $adress->user_id = Auth::user()->id;
        $adress->save();
        return back();
    }
    public function removeAdress(Request $request)
    {
        Adress::find($request->input('id'))->delete();
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
