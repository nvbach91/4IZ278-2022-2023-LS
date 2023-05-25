<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpaceStation>
 */
class SpaceStationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'image_url' => fake()->imageUrl(),
            'galaxy_id' => GalaxyFactory::new(),
            'x' => fake()->randomFloat(),
            'y' => fake()->randomFloat(),
            'z' => fake()->randomFloat()
        ];
    }
}