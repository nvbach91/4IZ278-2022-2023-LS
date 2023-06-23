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
            'name' => 'Frog holder/bed',
            'description' =>  'A holder or a bed for a frog in a shape of a frog',
            'price' => 2000,
            'category_id' => $this->getCategoryId("Accessories"),
            'img' => 'https://m.media-amazon.com/images/I/615y-CxUDiL._AC_SL1500_.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Rocks for a terrarium',
            'description' =>  'Special rocks for a terrarium',
            'price' => 500,
            'category_id' => $this->getCategoryId("Accessories"),
            'img' => 'https://cdn.shopify.com/s/files/1/0397/7868/0992/products/terrarium-stones-kit-sproutsouth-sproutsouth-online-houseplants-300786_600x600.jpg?v=1611958379'
        ]);

        DB::table('products')->insert([
            'name' => 'Frog hat for humans',
            'description' =>  'A knitted hat in a shape of a frog(for humans)',
            'price' => 200,
            'category_id' => $this->getCategoryId("Other"),
            'img' => 'https://i.etsystatic.com/28848691/r/il/d16559/3996660608/il_fullxfull.3996660608_1toj.jpg'
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


        DB::table('products')->insert([
            'name' => 'Tree frog',
            'description' =>  'a small and friendly forg',
            'price' => 4000,
            'category_id' => $this->getCategoryId("Frogs"),
            'img' => 'https://t2.ea.ltmcdn.com/en/posts/1/3/0/step_by_step_guide_to_preparing_a_terrarium_for_a_green_tree_frog_1031_orig.jpg'
        ]);

        DB::table('products')->insert([
            'name' => ' African Horned Frog',
            'description' =>  'a middle-sized frog with horns',
            'price' => 5000,
            'category_id' => $this->getCategoryId("Frogs"),
            'img' => 'https://i.pinimg.com/originals/b5/c3/09/b5c30943b588ed14721e67c7e353840e.jpg'
        ]);

    }

    public function getCategoryId($name) : int
    {
        return DB::table('categories')->select('id')->where('category', $name)->get(0)->get(0)->id;
    }


}


