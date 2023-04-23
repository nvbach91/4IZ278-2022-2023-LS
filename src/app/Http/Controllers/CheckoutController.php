<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = json_decode($request->cookie('cart'), true);

        $total = 0;
        if ($cart) {
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }

        return view('checkout', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }
}
