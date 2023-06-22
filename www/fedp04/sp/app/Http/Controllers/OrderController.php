<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Profile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $cart = $request->session()->get('cart');

        if ($user->adress == null) {
            return redirect()->route('profile')->withErrors("You must enter your adress to make an order");
        }

        $request->validate([
            'card' => ['required', 'min:16', 'max:19'],
            'expire' => ['required', 'min:5', 'max:5'],
        ]);

        $validator = Validator::make($request->session()->all(), [
            'cart' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors("The cart must not be empty");
        }

        $order = new Order();
        $order->user_id = $user->id;
        $order->order_adress = $user->adress;
        $order->save();

        $arrayKeys = array_keys($cart);
        for ($i = 0; $i < count($arrayKeys); $i++) {
            $productId = $arrayKeys[$i];
            if (isset($cart[$productId])) {
                $amount = $cart[$productId];
                if ($amount > 0) {
                    $product = Product::find($productId);
                    $order->belongsToMany(Product::class, 'order_items')->attach($product, ['amount' => $amount, 'ordered_price' => $product->price]);
                }
            }
        }

        $request->session()->forget('cart');
        return redirect()->route('order', $order->id);
    }

    public function show($id) {
        $order = Order::find($id);
        $orderItems = $order->belongsToMany(Product::class, 'order_items')
        ->get(['order_id', 'product_id', 'ordered_price', 'amount'])
        ->all();
        return view('order', ['order' => $order, 'orderItems' => $orderItems]);
    }


}
