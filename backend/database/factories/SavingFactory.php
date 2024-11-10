<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SavingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomNumber(4),
            'goal' => $this->faker->randomNumber(4),
        ];
    }
}
