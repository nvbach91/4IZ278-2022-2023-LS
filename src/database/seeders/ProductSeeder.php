<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample product data
        $products = [
            [
                'name' => 'Sourdough Bread',
                'description' => 'A delicious loaf of sourdough bread, perfect for sandwiches and toasts.',
                'price' => 4.99,
                'image_url' => 'https://via.placeholder.com/150x150'
            ],
            [
                'name' => 'Baguette',
                'description' => 'A classic French baguette with a crispy crust and soft interior.',
                'price' => 2.49,
                'image_url' => 'https://via.placeholder.com/150x150'
            ],
            // Add more if needed //
        ];

        // Insert the products and related images
        foreach ($products as $productData) {
            $product = new Product([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
            ]);
            $product->save();

            $image = new ProductImage([
                'url' => $productData['image_url'],
            ]);
            $product->images()->save($image);
        }
    }
}
