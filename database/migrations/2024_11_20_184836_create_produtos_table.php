<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('id_produto'); // Chave primária
            $table->string('nome'); // Nome do produto
            $table->text('descricao')->nullable(); // Descrição do produto
            $table->decimal('preco', 10, 2); // Preço do produto
            $table->integer('estoque')->default(0); // Estoque disponível
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
