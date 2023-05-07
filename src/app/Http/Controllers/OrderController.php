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

        if ($request->user()->cannot('manage-orders')) {
            $ordersQuery = Order::where('user_id', $user->id);
        } else {
            $ordersQuery = Order::where('user_id', $user->id);
        }

        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $orders = $ordersQuery->when($search, function ($query, $search) {
                return $query->where('order_num', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortOrder)
            ->with(['products'])
            ->get();

        return view('user.orders', compact('orders', 'search', 'sortBy', 'sortOrder'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $order = Order::with('products')->findOrFail($id);

        // Check if the user is allowed to view the order
        if ($user->cannot('manage-orders') && $order->user_id != $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('show', compact('order'));
    }

    // Add the update method for admin to update the order status
    public function update(Request $request, Order $order)
    {
        $this->authorize('manage-orders');

        $request->validate([
            'status' => 'required|integer|min:1|max:4',
        ]);

        $order->update($request->only('status'));

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    public function adminOrders(Request $request)
    {
        $this->authorize('manage-orders');

        $search_order = $request->input('search_order');
        $search_email = $request->input('search_email');
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'users.email as user_email')
                ->when($search_order, function ($query, $search_order) {
                    return $query->where('order_num', 'like', '%' . $search_order . '%');
                })
                ->when($search_email, function ($query, $search_email) {
                    return $query->where('users.email', 'like', '%' . $search_email . '%');
                })
                ->orderBy($sortBy, $sortOrder)
                ->get();


                if ($sortBy === 'total_sum') {
                    $orders = $sortOrder === 'desc' ? $orders->sortByDesc('total_sum') : $orders->sortBy('total_sum');
                } else {
                    $orders = $sortOrder === 'desc' ? $orders->sortByDesc($sortBy) : $orders->sortBy($sortBy);
                }

        return view('admin.orders.index', compact('orders', 'search_order', 'search_email', 'sortBy', 'sortOrder'));
    }

    // public function adminOrders(Request $request)
    // {
    //     $this->authorize('manage-orders');

    //     $sortBy = $request->input('sort_by', 'created_at');
    //     $sortOrder = $request->input('sort_order', 'desc');
    //     $search = $request->input('search');

    //     $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
    //         ->select('orders.*', 'users.email as user_email')
    //         ->when($search, function ($query, $search) {
    //             return $query->where('order_num', 'like', '%' . $search . '%');
    //         })
    //         ->orderBy($sortBy, $sortOrder)
    //         ->get();

    //     return view('admin.orders.index', compact('orders', 'sortBy', 'sortOrder', 'search'));
    // }



    public function updateStatus(Request $request, $id)
    {
        $this->authorize('manage-orders');

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

}
