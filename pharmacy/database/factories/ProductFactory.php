<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'image' => fake()->imageUrl(640, 480, 'product'),
            'category_id' => Category::inRandomOrder()->first()->id,
            'stock' => fake()->numberBetween(0, 100),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
