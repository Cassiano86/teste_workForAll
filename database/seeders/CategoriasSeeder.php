<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorias;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria_1 = Categorias::firstOrCreate(
            ['nome' => 'Diamante'],
            ['descricao' => 'Para clientes diamante']
        );

        $categoria_2 = Categorias::firstOrCreate(
            ['nome' => 'Ouro'],
            ['descricao' => 'Para clientes ouro']
        );

        $categoria_3 = Categorias::firstOrCreate(
            ['nome' => 'Prata'],
            ['descricao' => 'Para clientes prata']
        );

        $categoria_4 = Categorias::firstOrCreate(
            ['nome' => 'Bronze'],
            ['descricao' => 'Para clientes bronze']
        );
    }
}
