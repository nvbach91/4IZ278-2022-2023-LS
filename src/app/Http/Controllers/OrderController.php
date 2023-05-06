<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
    
        $orders = Order::where('user_id', $user->id)
            ->when($search, function ($query, $search) {
                return $query->where('order_num', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->with(['products'])
            ->get();
        
        return view('orders', compact('orders', 'search', 'sortBy', 'sortOrder'));
    }




    public function show($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->with('products')->findOrFail($id);

        return view('show', compact('order'));
    }
}


