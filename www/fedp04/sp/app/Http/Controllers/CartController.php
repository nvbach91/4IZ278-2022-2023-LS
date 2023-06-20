<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\isNull;

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
        return redirect()->route($request->input('redirect'));
    }

    public function minus(Request $request)
    {
        $oldCart = $request->session()->get('cart');
        if($oldCart != null) {
            $productId = $request->input('id');
            if (isset($oldCart[$request->input('id')])) {
                $amount = $oldCart[$request->input('id')] - 1;
                $oldCart[$productId] = $amount;
            }
            if ($oldCart[$productId]  <= 0) {
                unset($oldCart, $productId);
            }
            $request->session()->put('cart', $oldCart);
        }
        return redirect()->route($request->input('redirect'));
    }

    public function get(Request $request)
    {
        $cart = $request->session()->get('cart');
        if (isset($cart)) {
            $products = Product::all()->whereIn('id', array_keys($cart));
        }
        else {
            $products=[];
        }
        return view('cart', [
            'cart' => $request->session()->get('cart'),
            'products' => $products
        ]);
    }

}
