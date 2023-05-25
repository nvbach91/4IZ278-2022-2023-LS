<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpaceStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SpaceStation::factory()->create([
            'name' => 'Salyut 1',
            'x' => 12.6,
            'y' => 17.2,
            'z' => 19.1,
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/32/ISS_after_STS-119_in_March_2009_1.jpg/440px-ISS_after_STS-119_in_March_2009_1.jpg',
            'galaxy_id' => 1
        ]);
        \App\Models\SpaceStation::factory()->create([
            'name' => 'Genesis I',
            'x' => -12.6,
            'y' => 192.2,
            'z' => 12.1,
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/df/Skylab_Station_Viewed_by_Skylab_2_Command_Module_-_GPN-2000-001709.jpg/440px-Skylab_Station_Viewed_by_Skylab_2_Command_Module_-_GPN-2000-001709.jpg',
            'galaxy_id' => 2
        ]);
        \App\Models\SpaceStation::factory()->create([
            'name' => 'Tiangong space station',
            'x' => -23.6,
            'y' => 1.2,
            'z' => 92.1,
            'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a9/Skylab_mockup_Smithsonian_NASM.jpg/440px-Skylab_mockup_Smithsonian_NASM.jpg',
            'galaxy_id' => 1
        ]);
    }
}