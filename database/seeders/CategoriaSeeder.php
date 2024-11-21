<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            ['id_categoria' => 1, 'nome' => 'Eletronicos'],
            ['id_categoria' => 2, 'nome' => 'Video'],
            ['id_categoria' => 3, 'nome' => 'Audio'],
        ]);
    }
}
