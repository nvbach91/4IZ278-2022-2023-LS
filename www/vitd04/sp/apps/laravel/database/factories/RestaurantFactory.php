<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $slug = str_slug($name);
        return [
            'name' => $name,
            'slug' => $slug,
            'location' => fake()->latitude() . ',' . fake()->longitude(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'zip' => fake()->postcode(),
            'visible' => fake()->boolean(),
            // 'user_id' => \App\Models\User::factory(),
            // 'thumbnail_id' => \App\Models\Asset::factory(),
        ];
    }
}