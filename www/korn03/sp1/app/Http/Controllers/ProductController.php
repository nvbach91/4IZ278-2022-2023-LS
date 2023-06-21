<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{

    public function returnProduct($id)
    {
        $product = Product::find($id);
        return view('product', ['product' => $product, 'relatedProducts' =>Product::where('category_id', $product->category_id)->whereNot('id', $product->id) ->get()]);
    }

    public function returnProductsByCategory($category_id)
    {

        return view('category', ['products' => Product::where('category_id', $category_id)->get()]);

    }

}
