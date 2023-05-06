<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;

class OrderProductSeeder extends Seeder
{
    public function run()
    {
        // Get all orders and products
        $orders = Order::all();
        $products = Product::all();

        // Loop through each order
        foreach ($orders as $order) {
            // Attach a random number of products to the order
            for ($i = 0; $i < rand(1, 5); $i++) {
                // Select a random product
                $product = $products->random();

                // Attach the product to the order with pivot data
                $order->products()->attach($product->id, [
                    'quantity' => rand(1, 10),
                    'price' => $product->price,
                ]);
            }
        }
    }
}

