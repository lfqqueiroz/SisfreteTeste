<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('id_pedido'); // Chave primária
            $table->unsignedBigInteger('id_cliente'); // FK para clientes
            // $table->timestamp('data_pedido')->default(now()); // Data do pedido
            $table->string('status')->default('pendente'); // Status do pedido
            $table->timestamps(); // Campos created_at e updated_at

            // Chave estrangeira
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
