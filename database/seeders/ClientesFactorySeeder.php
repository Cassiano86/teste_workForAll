<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClientesFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Clientes::factory(ClientesFactory::class, 100)->create();
    }
}
