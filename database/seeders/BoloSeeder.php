<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Bolo;

class BoloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Bolos fixos
        $bolosFixos = [
            [
                'nome' => 'Bolo de Chocolate',
                'peso' => 1200,
                'valor' => 30.00,
                'quantidade_disponivel' => 5,
                'emails_interessados' => ['cliente1@email.com', 'cliente2@email.com'],
            ],
            [
                'nome' => 'Bolo de Cenoura com cobertura de chocolate',
                'peso' => 1000,
                'valor' => 25.00,
                'quantidade_disponivel' => 0,
                'emails_interessados' => ['carla@email.com'],
            ],
            [
                'nome' => 'Bolo de Morango',
                'peso' => 1500,
                'valor' => 35.00,
                'quantidade_disponivel' => 3,
                'emails_interessados' => ['joao@email.com', 'maria@email.com'],
            ],
            [
                'nome' => 'Bolo de Aveia com banana',
                'peso' => 950,
                'valor' => 58.90,
                'quantidade_disponivel' => 4,
                'emails_interessados' => ['antonio@email.com', 'eunice@email.com'],
            ],
            [
                'nome' => 'Bolo de Maçã com Canela',
                'peso' => 1100,
                'valor' => 55.00,
                'quantidade_disponivel' => 5,
                'emails_interessados' => ['cliente3@email.com', 'cliente4@email.com', 'cliente5@email.com'],
            ],
        ];

        foreach ($bolosFixos as $bolo) {
            Bolo::create($bolo);
        }

        // Bolos aleatórios com Faker
        for ($i = 0; $i < 5; $i++) {
            Bolo::create([
                'nome' => 'Bolo de ' . $faker->word(),
                'peso' => $faker->numberBetween(800, 1600),
                'valor' => $faker->randomFloat(2, 20, 60),
                'quantidade_disponivel' => $faker->numberBetween(0, 10),
                'emails_interessados' => $faker->randomElements([
                    'ana@email.com',
                    'bruno@email.com',
                    'carol@email.com',
                    'danilo@email.com',
                    'erica@email.com',
                ], $faker->numberBetween(1, 3)),
            ]);
        }
    }
}
