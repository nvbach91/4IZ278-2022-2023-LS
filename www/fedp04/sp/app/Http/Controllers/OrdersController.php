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

class OrdersController extends Controller
{

    public function showAll() {

    return view('orders',['orders' => Order::all()->where('user_id', Auth::user()->id)]);
}




}
