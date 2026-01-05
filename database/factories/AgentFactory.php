<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'ime' => fake()->regexify('[A-Za-z0-9]{100}'),
            'prezime' => fake()->regexify('[A-Za-z0-9]{100}'),
            'email' => fake()->safeEmail(),
        ];
    }
}
