<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{


    public function checkStock($id)
    {
        $product = Product::find($id);
        return ($product->stock <= 0) ? false : true;
    }

    public function add(Request $request)
    {
        $quantity = $request->quantity;
        $product = $request->id;
        $oldCart = $request->session()->get('cart');
        if ($quantity < 0) {
            $quantity = 1;
        }
        if (!self::checkStock($product)) {
            return redirect()->route('main');
        }
        $uniqueID = array_count_values($oldCart);
        if (isset($uniqueID[$product])) {
            if ($uniqueID[$product] >= Product::find($product)->stock) {
                return redirect()->route('cart');
            }
        }
        if ($oldCart == null) {
            $oldCart = [];
        }
        for (; $quantity > 0; $quantity--) {
            array_push($oldCart, $product);
        }

        $request->session()->put('cart', $oldCart);

        return redirect()->route('cart');
    }

    public function remove(Request $request)
    {
        $oldCart = $request->session()->get('cart');

        $product = $request->id;
        /*
        if ($oldCart == null){
            return;
        }
        */
        unset($oldCart[array_search($product, $oldCart)]);
        //$newCart = unset($oldCart[array_search($product, $oldCart)]);

        $request->session()->put('cart', $oldCart);

        return redirect()->route('cart');
    }

    public function get(Request $request)
    {
        return view('cart', ['cart' => $request->session()->get('cart'), 'products' => Product::all()]);
    }
};
