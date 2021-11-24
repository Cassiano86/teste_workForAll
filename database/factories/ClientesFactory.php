<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $factory->define(App\Models\Clientes::class, function (Faker $faker) {
            return [
                'nome' => $faker->name,
                'tipo' => $faker->randomElement(['Física','Jurídica']),
                'contato' => $faker->unique()->contato,
                'nascimento'    => $faker->dateBetween('+1 week', '+1 month'), // password
                'estados_fk'     => $faker->numberBetween(1, 20),
                'categoria_fk'   => $faker->numberBetween(1, 4),
            ];
        });
    }
}
