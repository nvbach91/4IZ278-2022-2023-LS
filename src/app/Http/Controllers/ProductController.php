<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('manage-products');

        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $this->authorize('manage-products');

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('manage-products');

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->only('name', 'price'));

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function create()
    {
        $this->authorize('manage-products');
    
        return view('admin.products.create');
    }
    
    public function store(Request $request)
    {
        $this->authorize('manage-products');
    
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
    
        Product::create($request->only('name', 'price'));
    
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }
    
    public function destroy(Product $product)
    {
        $this->authorize('manage-products');
    
        $product->delete();
    
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

}
