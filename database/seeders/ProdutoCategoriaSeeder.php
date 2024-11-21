<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos_categorias')->insert([
            ['id_produto' => 101, 'id_categoria' => 1],
            ['id_produto' => 102, 'id_categoria' => 2],
            ['id_produto' => 103, 'id_categoria' => 3],
        ]);
    }
}
