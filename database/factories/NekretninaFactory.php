<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NekretninaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'oznaka' => fake()->regexify('[A-Za-z0-9]{50}'),
            'povrsina_m2' => fake()->randomFloat(2, 0, 999999.99),
            'cena' => fake()->randomFloat(2, 0, 9999999999.99),
            'status' => fake()->word(),
        ];
    }
}
