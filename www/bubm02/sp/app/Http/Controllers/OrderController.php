<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function submit(Request $request)
    {
        $cart = $request->session()->get('cart');
        $user_id = $request->user()->id;
        $adress = $request->input('adress');
        $shippingType = $request->input('shipping-type');

        if ($adress == null) {
            return redirect()->route('profile')->withErrors( 'Please add an adress','adress');
        }

        $validator = Validator::make($request->session()->all(), [
            'cart' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }

        $request->validate([
            'adress' => 'required',
            'shipping-type' => 'required',
            'card-number' => ['required', 'min:16', 'max:19'],
            'card-name' => ['required', 'min:5', 'max:50'],
        ]);
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = 'new';
//        $order->note = $request->input('note');
        $order->shipping_type = $shippingType;
        $order->tracking_number = rand(100000000, 999999999);
        $order->adress_id = $adress;
        $order->save();

        $arrayKeys = array_keys($cart);
        for ($i = 0; $i < count($arrayKeys); $i++) {
            $itemId = $arrayKeys[$i];
            if (isset($cart[$itemId])) {
                $quantity = $cart[$itemId];
                if ($quantity > 0) {
                    $item = Item::find($itemId);
                    $order->belongsToMany(Item::class, 'order_items')->attach($item, ['quantity' => $quantity, 'old_price' => $item->discount_price > 0 ? $item->discount_price : $item->price]);
                }
            }
        }

        $request->session()->forget('cart');
        return back()->with('success', 'Order submitted successfully.');
    }

}
