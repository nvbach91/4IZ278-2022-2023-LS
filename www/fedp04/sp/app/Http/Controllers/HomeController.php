<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home', ['products' => Product::all()]);
    }

    public function category($id)
    {

        return view('home', ['products' => Product::all()->where('category_id', $id)]);
    }

    public function product($id)
    {

        return view('product', ['product' => Product::find($id)]);
    }

    public function order($id)
    {

        return view('order', ['products' => Product::find($id)]);
    }
}
