<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query and sorting order from the request
        $search = $request->input('search', '');
        $sortOrder = $request->input('sort_order', 'asc');

        // Fetch products from the database
        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('price', $sortOrder)
            ->paginate(9);

        return view('store-page', [
            'products' => $products,
            'search' => $search,
            'sortOrder' => $sortOrder,
        ]);
    }

}
