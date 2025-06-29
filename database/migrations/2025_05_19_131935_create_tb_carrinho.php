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
        Schema::create('tb_carrinho', function (Blueprint $table) {
            $table->id('id_carrinho');
            $table->unsignedBigInteger('id_cliente'); 
            $table->unsignedBigInteger('id_produto');
            $table->integer('qntd_carrinho')->unsigned();
            $table->decimal('preco_unitario_carrinho', 10, 2);
            $table->decimal('preco_total_carrinho', 10, 2);
            $table->timestamps();

            $table->foreign('id_cliente')
                ->references('id_cliente') 
                ->on('tb_cliente') 
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
        Schema::dropIfExists('tb_carrinho');
    }
};
