<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'date_of_birth' => '1990-01-01',
            'gender' => 'male',
            'address' => '123 Admin Street',
            'city' => 'Admin City',
            'phone_number' => '1234567890',
            'is_admin' => true,
        ]);

        // Create regular users
        User::factory(10)->create();

        // Create categories
        Category::factory(5)->create();

        // Create products
        Product::factory(20)->create();

        // Create orders with items
        Order::factory(15)->create()->each(function ($order) {
            // Create 1-3 items for each order
            OrderItem::factory(rand(1, 3))->create([
                'order_id' => $order->id,
                'price' => fake()->randomFloat(2, 10, 100),
            ]);

            // Update order total
            $order->total_amount = $order->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
            $order->save();
        });

        // Create ratings
        Rating::factory(50)->create();
    }
}
