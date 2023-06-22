<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;




class OrderController extends Controller
{
    /*
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    public function get() : Renderable
    {
        return view('orders', ['user' => Auth::user()], ['addresses' => Address::where('user_id', Auth::user()->id)->get()],
        ['orders' => Order::where('user_id', Auth::user()->id)->get()]);

    }
    */
    public function createOrder(Request $request)
    {
        //$product = $request->id;

        /*
        mini-vzorec for myself
        $user = User::where('email', $data->email)->first();
        $firstlastName = explode(' ', $data->name);
        */
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = "received";
        $order->total_price = $request->total_price;
        $order->payment_method = $request->payment_method;

        $order->save();


        return redirect(route('profile'));

        /*
            $arrayKeys = array_keys($cart);
        for ($i = 0; $i < count($arrayKeys); $i++) {
            $itemId = $arrayKeys[$i];
            if (isset($cart[$itemId])) {
                $quantity = $cart[$itemId];
                if ($quantity > 0) {
                    $item = Product::find($product_id);
                    $order->belongsToMany(Product::class, 'order_items')->attach($product, ['quantity' => $quantity, 'old_price' => $item->price]);
                }
            }

        }
            */

        //remove cart from session after success
        //$request->session()->remove('cart');


    }
}
