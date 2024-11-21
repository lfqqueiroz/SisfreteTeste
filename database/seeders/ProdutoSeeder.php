<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            ['id_produto' => 101, 'nome' => 'Smartphone', 'descricao' => 'Um smartphone de alta performance', 'preco' => 2500.00],
            ['id_produto' => 102, 'nome' => 'Notebook', 'descricao' => 'Notebook para trabalho e estudo', 'preco' => 3500.00],
            ['id_produto' => 103, 'nome' => 'Fone de Ouvido', 'descricao' => 'Fone com cancelamento de ruído', 'preco' => 500.00],
        ]);
    }
}
