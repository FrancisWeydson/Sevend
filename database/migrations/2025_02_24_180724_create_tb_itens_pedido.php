<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_itens_pedido', function (Blueprint $table) {
            $table->id('id_itens_pedido');
            $table->unsignedBigInteger('id_pedido');
            $table->unsignedBigInteger('id_produto');
            $table->integer('qtd_itens_pedido')->unsigned();
            $table->decimal('preco_unitario', 10, 2);
            $table->timestamps();

            $table->foreign('id_pedido')  
                    ->references('id_pedido')     
                    ->on('tb_pedido')          
                    ->onDelete('cascade');

            $table->foreign('id_produto')  
                    ->references('id_produto')     
                    ->on('tb_produto')          
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_itens_pedido');
    }
};
