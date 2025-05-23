<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total_amount' => fake()->randomFloat(2, 50, 2000),
            'status' => fake()->randomElement(['pending', 'shipped', 'delivered', 'canceled']),
            'shipping_address' => fake()->address(),
            'payment_method' => fake()->randomElement(['debit_credit_card', 'cod']),
            'payment_status' => fake()->randomElement(['pending', 'paid', 'failed']),
            'payment_type' => fake()->randomElement(['pre_paid', 'post_paid']),
        ];
    }
}
