<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{


    public function add(Request $request)
    {
        $quantity = $request->quantity;
        if ($quantity < 0) {
            $quantity = 1;
        }
        $oldCart = $request->session()->get('cart');
        $product = $request->id;
        if ($oldCart == null){
            $oldCart = [];
        }
        for (;$quantity > 0; $quantity--) {
            array_push($oldCart, $product);
        }

        $request->session()->put('cart', $oldCart);

        return redirect()->route('main');

    }

    public function remove(Request $request)
    {
        $oldCart = $request->session()->get('cart');
        $product = $request->id;
        if ($oldCart == null){return;}

        array_splice($oldCart, array_search($oldCart, $product));

        $request->session()->put('cart', $oldCart);

        return redirect()->route('main');

    }

    public function get(Request $request)
    {
        return view('cart', ['cart' => $request->session()->get('cart'), 'products' => Product::all()]);
    }
};