<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        // Create orders for each user
        foreach ($users as $user) {
            // Create 1 to 5 orders per user
            $numOrders = rand(1, 5);
            for ($i = 0; $i < $numOrders; $i++) {
                $product = $products->random();
                $total_sum = $product->price;

                $order = new Order([
                    'user_id' => $user->id,
                    'status' => 'processing',
                    'order_num' => 'ORD-' . rand(100000, 999999),
                ]);

                $order->save();
            }
        }
    }
}
