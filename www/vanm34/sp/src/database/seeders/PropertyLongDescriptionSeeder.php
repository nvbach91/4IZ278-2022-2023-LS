<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Property;

class PropertyLongDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $properties = Property::all();
        foreach ($properties as $property) {
            $property->longDescription = $faker->realText(200);  // generate random text
            $property->save();
        }
    }
}
