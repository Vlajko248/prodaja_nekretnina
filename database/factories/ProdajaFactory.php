<?php

namespace Database\Factories;

use App\Models\Agent;
use App\Models\Kupac;
use App\Models\Nekretnina;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdajaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'kupac_id' => Kupac::factory(),
            'agent_id' => Agent::factory(),
            'nekretnina_id' => Nekretnina::factory(),
            'datum_kreiranja' => fake()->date(),
            'status' => fake()->word(),
        ];
    }
}
