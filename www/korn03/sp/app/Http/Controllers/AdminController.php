<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
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

    public function get(): Renderable
    {
        return view('admin.index', [
            'users' => User::paginate(5),
            'orders' => Order::paginate(5),
            'products' => Product::paginate(3)
        ]);
    }
    public function editProductPage(Request $request): Renderable
    {
        return view('admin.dashboard_edit_product', [
            'users' => User::all(),
            'orders' => Order::all(),
            'product' => Product::find($request->id)
        ]);
    }
    public function editProduct(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'brand' => 'required|max:125',
            'name' => 'required|max:255',
            'code' => 'required|max:256',
            'description' => 'required|max:2056',
            'thumbnail' => 'max:255',
            'price' => 'required|integer',
            'category_id' => 'required',
            'discount' => 'integer',
            'stock' => 'required|integer',
        ]);

        $product = Product::find($request->id);
        $product->brand = $request->brand;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->thumbnail = $request->thumbnail;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->stock = $request->stock;

        $product->save();

        return redirect(route('edit_product_page', ['id' => $product->id]));
    }
    public function addProductPage(){
        return view('admin.dashboard_add_product');
    }
    public function addProduct(Request $request)
    {
        $request->validate([
            'brand' => 'required|max:125',
            'name' => 'required|max:255',
            'code' => 'required|max:256',
            'description' => 'required|max:2056',
            'category_id' => 'required',
            'thumbnail' => 'max:255',
            'price' => 'required|integer',
            'discount' => 'integer',
            'stock' => 'required|integer',
        ]);

        $product = new Product();
        $product->brand = $request->brand;
        $product->name = $request->name;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->thumbnail = $request->thumbnail;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->stock = $request->stock;

        $product->save();

        return redirect(route('edit_product_page', ['id' => $product->id]));
    }

    public function changeStatusOfOrder(Request $request)
    {

        $request->validate([
            'status' => ['required', 'in:received,sent,finished'],
        ]);

        $order = Order::find($request->id);

        $order->status = $request->status;

        $order->save();

        return redirect(route('dashboard'));
    }
}
