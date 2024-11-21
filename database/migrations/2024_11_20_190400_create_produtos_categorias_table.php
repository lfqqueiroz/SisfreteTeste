<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_categorias', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produto'); // FK para produtos
            $table->unsignedBigInteger('id_categoria'); // FK para categorias

            // Chave primária composta
            $table->primary(['id_produto', 'id_categoria']);

            // Chaves estrangeiras
            $table->foreign('id_produto')->references('id_produto')->on('produtos')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos_categorias');
    }
}
