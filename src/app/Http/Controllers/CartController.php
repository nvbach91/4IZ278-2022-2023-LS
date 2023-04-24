<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $totalSum = $this->calculateTotalSum($cart);
        return view('cart', ['cart' => $cart, 'totalSum' => $totalSum]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        $quantity = $request->input('quantity');

        $cart = session('cart', []);

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('status', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = session('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] = $quantity;
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $product_id = $request->input('product_id');

        $cart = session('cart', []);

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index');
    }

    public function flush()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('status', 'Cart has been flushed successfully');
    }

    public static function cartItemCount()
    {
        $cart = session('cart', []);

        $totalItems = 0;

        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
        }

        return $totalItems;
    }

    protected function calculateTotalSum($cart)
    {
        $totalSum = 0;
        foreach ($cart as $item) {
            if (isset($item['price']) && isset($item['quantity'])) {
                $totalSum += $item['price'] * $item['quantity'];
            }
        }

        return $totalSum;
    }
}
