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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // DB::table('users')->insert([
        //     'first_name' => 'User',
        //     'last_name' => 'Test',
        //     'email' => 'user@test.test',
        //     'password' => Hash::make('password'),
        // ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'surname' => 'Test',
            'email' => 'admin@test.test',
            'is_admin' => '1',
            'password' => Hash::make('password'),
        ]);

        


        DB::table('categories')->insert([
            'category' => 'Frogs',
        ]);

        DB::table('categories')->insert([
            'category' => 'Tadpoles',

        ]);


        DB::table('categories')->insert([
            'category' => 'Terrariums',
        ]);


        DB::table('categories')->insert([
            'category' => 'Accessories',
        ]);


        DB::table('categories')->insert([
            'category' => 'Other',
        ]);

        DB::table('products')->insert([
            'name' => 'African Bullfrog',
            'description' =>  'A big and agressive frog',
            'price' => 6000,
            'category_id' => $this->getCategoryId("Frogs"),
            'img' => 'https://cdn.britannica.com/17/163817-004-D7A1C3EF.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Tadpoles',
            'description' =>  'toad children',
            'price' => 800,
            'category_id' => $this->getCategoryId("Tadpoles"),
            'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bb/Tadpoles_10_days.jpg/800px-Tadpoles_10_days.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Big terrarium',
            'description' =>  'a big terrarium for a big forg',
            'price' => 3000,
            'category_id' => $this->getCategoryId("Terrariums"),
            'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Regenwaldterrarium.jpg/640px-Regenwaldterrarium.jpg'
        ]);

    }

    public function getCategoryId($name) : int
    {
        return DB::table('categories')->select('id')->where('category', $name)->get(0)->get(0)->id;
    }


}


