<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id('id_pagamento'); // Chave primária
            $table->unsignedBigInteger('id_pedido'); // Chave estrangeira
            $table->string('metodo_pagamento'); // Ex: "cartão", "boleto", etc.
            $table->decimal('valor', 10, 2); // Valor do pagamento
            $table->string('status')->default('pendente'); // Status do pagamento
            $table->timestamp('data_pagamento')->nullable(); // Data do pagamento
            $table->timestamps(); // Campos created_at e updated_at

            // Chave estrangeira
            $table->foreign('id_pedido')->references('id_pedido')->on('pedidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
