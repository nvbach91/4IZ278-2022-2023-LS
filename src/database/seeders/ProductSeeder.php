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
                'name' => 'Classic Bread',
                'description' => 'A delicious loaf of sourdough bread, perfect for sandwiches and toasts.',
                'price' => 4.99,
                'image_url' => 'https://i.imgur.com/6LqoUSK.jpg'
            ],
            [
                'name' => 'Cheese Bread',
                'description' => 'A classic French baguette with a crispy crust and soft interior.',
                'price' => 2.49,
                'image_url' => 'https://i.imgur.com/K1rMks2.jpg'
            ],
            [
                'name' => 'Rye Bread',
                'description' => 'A classic French baguette with a crispy crust and soft interior.',
                'price' => 5.99,
                'image_url' => 'https://i.imgur.com/jFTb3Gv.jpg'
            ],
            [
                'name' => 'Baguette',
                'description' => 'A classic French baguette with a crispy crust and soft interior.',
                'price' => 3.99,
                'image_url' => 'https://i.imgur.com/ASLa6Fk.jpg'
            ],
            [
                'name' => 'Classic Croissant',
                'description' => 'A classic croissant with a crispy crust and soft interior. Perfect for breakfast.',
                'price' => 2.99,
                'image_url' => 'https://i.imgur.com/aPh4U13.jpg'
            ],
            [
                'name' => 'Borodinsky Bread',
                'description' => 'A classic Russian bread with a crispy crust and soft interior.',
                'price' => 10.90,
                'image_url' => 'https://i.imgur.com/TG3KGf2.jpg'
            ],
            [
                'name' => 'Ciaabatta',
                'description' => 'A classic Italian bread with a crispy crust and soft interior.',
                'price' => 2.59,
                'image_url' => 'https://i.imgur.com/66JILtZ.jpg'
            ],
            [
                'name' => 'Milk Chocolad Croissant',
                'description' => 'A milk chocolate croissant with a crispy crust and soft interior.',
                'price' => 4.99,
                'image_url' => 'https://i.imgur.com/byPAakT.jpg'
            ],
            [
                'name' => 'Linen Bread',
                'description' => 'A linen bread with a crispy crust and soft interior. Our bestseller.',
                'price' => 10.90,
                'image_url' => 'https://i.imgur.com/diUEp8d.jpg'
            ],
            // [
            //     'name' => '',
            //     'description' => '',
            //     'price' => 30,
            //     'image_url' => ''
            // ],
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
