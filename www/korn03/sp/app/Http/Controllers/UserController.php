<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Address;




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
        return view('profile', ['user' => Auth::user()]);
    }
    public function getAdresses($id)
    {
        //$categories = $product->categories;
        //return view('product.listing', compact('product', 'categories'));
        return view('category', ['addresses' => Address::where('user_id', $id)->get()]);

    }
}
