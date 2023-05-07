<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Generate a random order number
        $orderNum = 'ORD-' . rand(100000, 999999);

        $order = new Order([
            'user_id' => auth()->id(),
            'order_num' => $orderNum,
            'status' => 'processing',
        ]);
        $order->save();

        // Attach products to the order
        foreach ($cart as $item) {
            $order->products()->attach($item['id'], [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        $request->session()->forget('cart');

        return redirect()->route('user.orders')->with('success', 'Order placed successfully!');
    }

}
