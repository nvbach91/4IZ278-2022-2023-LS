<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

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

        // Check if a user is authenticated, if not, create a guest user or use a default user
        $userId = auth()->id();
        if (!$userId) {
            // Create a guest user or use a default user
            $guestUser = User::firstOrCreate(
                ['email' => $request->input('email')],
                [
                    'name' => $request->input('lastName') . ' ' . $request->input('firstName'),
                    'password' => bcrypt('guest_password'),
                ]
            );


            // Assign the guest user's ID to $userId
            $userId = $guestUser->id;
        }

        $order = new Order([
            'user_id' => $userId,
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

        return redirect()->route('order.success');

    }

}
