<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_no' => fake()->unique()->numberBetween(100000, 999999),
            'name' => fake()->word(),
            'image' => fake()->imageUrl(),
            'price' => fake()->randomFloat(2, 1, 100),
            'discount' => fake()->randomFloat(2, 0, 50),
            'on_stock' => fake()->numberBetween(0, 100),
            'description' => fake()->paragraph(),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
