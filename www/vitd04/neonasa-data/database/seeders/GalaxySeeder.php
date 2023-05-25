<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalaxySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Galaxy::factory()->create([
            'name' => 'Andromeda Galaxy',
            'size' => 30,
            'image_url' => 'https://en.wikipedia.org/wiki/File:Andromeda_Galaxy_(with_h-alpha).jpg'
        ]);
        \App\Models\Galaxy::factory()->create([
            'name' => 'Antennae Galaxies',
            'size' => 13,
            'image_url' => 'https://en.wikipedia.org/wiki/File:Antennae_Galaxies_reloaded.jpg'
        ]);
        // \App\Models\Galaxy::factory()->create([
        //     'name' => 'Backward Galaxy',
        //     'size' => 26,
        //     'image_url' => 'https://en.wikipedia.org/wiki/File:NGC_4622HSTFull.jpg'
        // ]);
        // \App\Models\Galaxy::factory()->create([
        //     'name' => '	Black Eye Galaxy',
        //     'size' => 16,
        //     'image_url' => 'https://en.wikipedia.org/wiki/File:Blackeyegalaxy.jpg'
        // ]);
        // \App\Models\Galaxy::factory()->create([
        //     'name' => 'Bode\'s Galaxy',
        //     'size' => 16,
        //     'image_url' => 'https://en.wikipedia.org/wiki/File:Messier_81_HST.jpg'
        // ]);
        // \App\Models\Galaxy::factory()->create([
        //     'name' => 'Cartwheel Galaxy',
        //     'size' => 15,
        //     'image_url' => 'https://en.wikipedia.org/wiki/File:Cartwheel_Galaxy.jpg'
        // ]);
    }
}