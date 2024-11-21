<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            ['id_cliente' => 1, 'nome' => 'João Silva', 'email' => 'joao.silva@example.com'],
            ['id_cliente' => 2, 'nome' => 'Maria Oliveira', 'email' => 'maria.oliveira@example.com'],
            ['id_cliente' => 3, 'nome' => 'Carlos Lima', 'email' => 'carlos.lima@example.com'],
        ]);
    }
}
