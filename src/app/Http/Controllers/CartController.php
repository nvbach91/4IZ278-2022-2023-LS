<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
    {
        $cart = json_decode(Cookie::get('cart'), true) ?? [];
        return view('cart', ['cart' => $cart]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        $quantity = $request->input('quantity');

        $cart = json_decode($request->cookie('cart'), true) ?? [];

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity
            ];
        }

        $cookie = cookie('cart', json_encode($cart), 60 * 24 * 7);

        return redirect()->back()->cookie($cookie)->with('status', 'Product added to cart successfully!');
    }


    public function update(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = json_decode(Cookie::get('cart'), true) ?? [];

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] = $quantity;
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // 30 days

        return redirect()->route('cart.index');
    }

    public function remove(Request $request)
    {
        $product_id = $request->input('product_id');

        $cart = json_decode(Cookie::get('cart'), true) ?? [];

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
        }

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // 30 days

        return redirect()->route('cart.index');
    }

    public function flush()
    {
        Cookie::queue(Cookie::forget('cart'));
        return redirect()->route('cart.index')->with('status', 'Cart has been flushed successfully');
    }

    public static function cartItemCount()
    {
        $cart = request()->cookie('cart') ? json_decode(request()->cookie('cart'), true) : [];

        $totalItems = 0;

        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
        }

        return $totalItems;
    }


}

