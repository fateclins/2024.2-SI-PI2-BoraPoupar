<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'category_id' => 1,
            'name' => $this->faker->name,
            'amount' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $this->faker->randomElement(['expense', 'income']),
            'note' => $this->faker->sentence,
        ];
    }
}
