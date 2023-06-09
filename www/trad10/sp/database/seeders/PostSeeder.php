<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::factory()->count(10)->create();
        Category::factory()->count(3)->create();
        Post::factory()->count(50)->create();
    }
}
