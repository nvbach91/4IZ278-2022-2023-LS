<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'test',
            'surname' => 'testovich',
            'email' => 'user@vse.cz',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'surname' => 'test',
            'email' => 'admin@vse.cz',
            'is_admin' => '1',
            'password' => Hash::make('password'),
        ]);
        $this->createCategories();
        $this->createProducts();
    }

    public function createCategories() {

        DB::table('categories')->insert([
            'name' => 'Wha-wha',
        ]);
        DB::table('categories')->insert([
            'name' => 'Distortion',
        ]);

    }

    public function createProducts() {
        DB::table('products')->insert([
            'name' => 'Boss Distortion Pedal',
            'brand' => 'Boss',
            'description' => '
The best Boss pedal ever. Not only Boss, distortion overall.',
            'price' => 200,
            'code'=> '1001',
            'stock' => 10,
            'category_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => 'Wah-wah Pedal',
            'brand' => 'Dunlop',
            'description' => '
The best Wah-wah pedal ever.',
            'price' => 110,
            'code' => '1002',
            'stock' => 2,
            'category_id' => 1,
        ]);
    }




}
