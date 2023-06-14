<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function displayMyOrders(){
        if(session()->exists('id')){
            $id = session('id');
            $orders = DB::select("select * from `order` where customer={$id}");
            return view('myOrders',['orders' => $orders]);

        }else{
            return redirect('/');
        }
    }
}
