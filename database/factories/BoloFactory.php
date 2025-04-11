<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BoloFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => 'Bolo ' . $this->faker->word,
            'peso' => $this->faker->numberBetween(500, 2000),
            'valor' => $this->faker->randomFloat(2, 10, 100),
            'quantidade_disponivel' => $this->faker->numberBetween(0, 10),
            'emails_interessados' => [$this->faker->safeEmail],
        ];
    }
}
