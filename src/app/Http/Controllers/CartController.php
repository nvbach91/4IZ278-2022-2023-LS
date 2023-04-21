<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\Product;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = json_decode($request->cookie('cart', '[]'), true);

        $cartItems = [];

        foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if ($product) {
                $cartItems[] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                ];
            }
        }

        $request->session()->put('cart', $cartItems);

        return view('cart', ['cart' => $cartItems]);
    }

    public function addItem(Request $request)
    {
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        // Add validation for productId and quantity if necessary

        $cart = json_decode($request->cookie('cart', '[]'), true);

        $itemIndex = array_search($productId, array_column($cart, 'id'));

        if ($itemIndex === false) {
            $cart[] = [
                'id' => $productId,
                'quantity' => intval($quantity),
            ];
        } else {
            $cart[$itemIndex]['quantity'] += intval($quantity);
        }

        return response(null, 204)->cookie('cart', json_encode($cart), 60 * 24 * 30);
    }
}
