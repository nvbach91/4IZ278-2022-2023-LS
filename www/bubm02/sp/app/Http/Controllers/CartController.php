<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Request $request)
    {
        $requestQuantity = $request->input('quantity');
        if ($requestQuantity == null) {
            $requestQuantity = 1;
        }
        $cart = $request->session()->get('cart');
        if ($cart == null) {
            $cart = [];
        }
        $itemId = $request->input('id');
        if (isset($cart[$itemId])) {
            $quantity = $cart[$itemId] + $requestQuantity;
        } else {
            $quantity = $requestQuantity;
        }
        $cart[$itemId] = $quantity;
        $request->session()->put('cart', $cart);
        return back();
    }

    public function subtract(Request $request)
    {
        $cart = $request->session()->get('cart');
        if ($cart != null) {
            $itemId = $request->input('id');
            if (isset($cart[$itemId])) {
                $quantity = $cart[$itemId] - 1;
                if ($quantity <= 0) {
                    unset($cart[$itemId]);
                }
                else {
                    $cart[$itemId] = $quantity;
                }
            }
            $request->session()->put('cart', $cart);
        }
        return back();
    }

    public function remove(Request $request)
    {
        $cart = $request->session()->get('cart');
        if ($cart != null) {
            $itemId = $request->input('id');
            unset($cart[$itemId]);
            $request->session()->put('cart', $cart);
        }
        return back();
    }

    /**
     * Show the profile for the given user.
     */
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart');
        if (isset($cart))
            $products = Item::all()->whereIn('id', array_keys($cart));
        else
            $products = [];
        return view('cart', [
            'cart' => $request->session()->get('cart'),
            'items' => $products,
            'adresses' => Adress::all()->where('user_id', $request->user()->id),
        ]);
    }
}
