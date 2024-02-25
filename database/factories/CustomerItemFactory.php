<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Item;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerItem>
 */
class CustomerItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'quantity' => rand(1, 10),
            'purchase_datetime' => fake()->dateTime('yesterday', 'Asia/Tokyo'),
            'customer_id' => rand(1, Customer::count()),
            'item_id' => rand(1, Item::count())
        ];
    }
}
