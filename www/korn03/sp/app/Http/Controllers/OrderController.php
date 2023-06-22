<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use DB;
use Illuminate\Contracts\Session\Session;

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
        $cart = $request->session()->get('cart');
        $uniqueID = array_count_values($cart);

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = "received";
        $order->payment_method = $request->payment_method;
        $order->save();


        foreach ($uniqueID as $id){
            $product= Product::find($id);
            $price = $product->price;
            $discount = $product->discount;
            $amount = $uniqueID[$id];

            $order->belongsToMany(Product::class, 'table_order_product')->attach($product, ['amount' => $amount, 'price_actual' => $price, 'discount_actual' => $discount]);
        }
        return redirect(route('profile'));
    }

    public function showOrder($id) : Renderable {
        //Order::where('user_id', Auth::user()->id

        return view('order',
        ['user' => Auth::user(),
        'order' => Order::find($id),
        'order_products'=> Order::find($id)
        ->belongsToMany(Product::class, 'table_order_product')
        ->get(['order_id', 'product_id', 'price_actual', 'amount', 'discount_actual'])
        ->all(),
        'products'=> Product::all()
    ]);
    }
}
