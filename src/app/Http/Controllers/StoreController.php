<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        // Fetch products from the database
        $products = Product::paginate(9);

        return view('store-page', compact('products'));
    }
}
