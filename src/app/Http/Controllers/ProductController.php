<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImage;

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'image_link' => 'nullable|url',
            'description' => 'nullable|string',
        ]);
    
        $product = Product::findOrFail($id);
    
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
    
        $product->save();
    
        // Update the existing image link in the product_images table
        if ($request->input('image_link')) {
            $productImage = $product->images->first();

        if ($productImage) {
            $productImage->url = $request->input('image_link');
            $productImage->save();
        } else {
            // If no existing image, create a new one
                $productImage = new ProductImage([
                    'product_id' => $product->id,
                    'url' => $request->input('image_link'),
                ]);
            
                $productImage->save();
            }
        }
    
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
