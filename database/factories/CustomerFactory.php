<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genders = array('男性', '女性');

        return [
            'name' => fake()->name(),
            'tel' => str_replace('-', '', fake()->unique()->phoneNumber()),
            'email' => fake()->unique()->safeEmail(),
            'postcode' => fake()->postcode(),
            'address' => mb_substr(fake()->address(), 9),
            'birthday' => fake()->date(),
            'gender' => $genders[rand(0, 1)]
        ];
    }
}
