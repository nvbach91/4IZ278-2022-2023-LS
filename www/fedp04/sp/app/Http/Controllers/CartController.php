<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

    //  * Show the profile for the given user.

    public function add(Request $request)
    {
        $oldCart = $request->session()->get('cart');
        if ($oldCart == null) {
            $oldCart = [];
        }
        $productId = $request->input('id');
        if (isset($oldCart[$request->input('id')])) {
            $amount = $oldCart[$request->input('id')] + 1;
        } else {
            $amount = 1;
        }
        $oldCart[$productId] = $amount;
        $request->session()->put('cart', $oldCart);
        return redirect()->back();
    }

    public function minus(Request $request)
    {
        $oldCart = $request->session()->get('cart');
        if ($oldCart == null) {
            return redirect()->back();
        }
        $productId = $request->input('id');
        if (isset($oldCart[$productId])) {
            $amount = $oldCart[$productId] - 1;
            $oldCart[$productId] = $amount;
        }
        if ($oldCart[$productId]  <= 0) {
            unset($oldCart[$productId]);
        }
        $products = Product::all()->whereIn('id', array_keys($oldCart));
        $request->session()->put('cart', $oldCart);
        return redirect()->back();
    }

    public function get(Request $request)
    {
        $cart = $request->session()->get('cart');
        if (isset($cart)) {
            $products = Product::all()->whereIn('id', array_keys($cart));
        } else {
            $products = [];
        }
        return view('cart', [
            'cart' => $cart,
            'products' => $products
        ]);
    }
}
