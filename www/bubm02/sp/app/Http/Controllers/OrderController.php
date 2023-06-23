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

    public function show($id) {
        $order = Order::find($id);
        if ($order == null) {
            return back()->withErrors("Order not found");
        }
        if ($order->user_id != auth()->user()->id) {
            return back()->withErrors("You are not allowed to view this order");
        }
        return view('order', ['order' => $order, 'user' => auth()->user()]);
    }

    public function showAdmin($id) {
        $order = Order::find($id);
        if ($order == null) {
            return back()->withErrors("Order not found");
        }
        if ($order->user_id != auth()->user()->id) {
            return back()->withErrors("You are not allowed to view this order");
        }
        return view('order', ['order' => $order, 'user' => auth()->user()]);
    }

    public function showAdminAll() {
        $orders = Order::all();
        return view('admin', ['orders' => $orders]);
    }

    public function approveAdmin($id) {
        $order = Order::find($id);
        if ($order == null) {
            return back()->withErrors("Order not found");
        }
        $order->status = 'approved';
        $order->save();
        return back()->with('status', 'Order approved');
    }
    public function denyAdmin($id) {
        $order = Order::find($id);
        if ($order == null) {
            return back()->withErrors("Order not found");
        }
        $order->status = 'denied';
        $order->save();
        return back()->with('status', 'Order denied');
    }

    public function submit(Request $request)
    {
        $cart = $request->session()->get('cart');
        $user_id = $request->user()->id;
        $adressId = $request->input('adress');
        $shippingType = $request->input('shipping-type');

        if ($adressId == null) {
            if (!Adress::all()->where('user_id', $user_id)->count() > 0) {
                return redirect()->route('profile')->withErrors( 'Please add an adress','adress');
            }
        }

        $validator = Validator::make($request->session()->all(), [
            'cart' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors("Please add items to cart");
        }

        $request->validate([
            'adress' => 'required',
            'shipping-type' => 'required',
            'card-number' => ['required', 'min:16', 'max:16', 'regex:/\d{16}/'],
            'card-name' => ['required', 'min:5', 'max:128', 'regex:/\w+\s+\w+\w*/'],
            'card-expire' => ['required', 'min:5', 'max:5', 'regex:/\d{2}\/\d{2}/'],
            'cvv-code' => ['required', 'min:3', 'max:3', 'regex:/\d{3}/'],
        ]);
        foreach ($cart as $id => $quantity) {
            $item = Item::find($id);
            if ($item->stock < $quantity) {
                return back()->withErrors("Sorry, not enough stock for item: " . $item->name . 'available: ' . $item->stock);
            }
            $item->stock = $item->stock - $quantity;
            if ($item->stock < 0) {
                $item->stock = 0;
            }
            $item->save();
        }
        $orderAdress = Adress::find($adressId);
        $order = new Order();
        $order->user_id = $user_id;
        $order->status = 'new';
//        $order->note = $request->input('note');
        $order->shipping_type = $shippingType;
        $order->tracking_number = rand(100000000, 999999999);
        $order->country = $orderAdress->country;
        $order->city = $orderAdress->city;
        $order->adress_1 = $orderAdress->adress_1;
        $order->adress_2 = $orderAdress->adress_2;
        $order->zip_code = $orderAdress->zip_code;
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
        return redirect()->route('order.show', ['id' => $order->id]);
    }

}
