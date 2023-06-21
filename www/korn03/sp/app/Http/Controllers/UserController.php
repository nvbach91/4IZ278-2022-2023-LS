<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;




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

    public function get() : Renderable
    {
        return view('profile', ['user' => Auth::user(),'addresses' => Address::where('user_id', Auth::user()->id)->get(), 'orders' => Order::where('user_id', Auth::user()->id)->get()]);

    }

}
