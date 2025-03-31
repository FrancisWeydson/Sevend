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
        Schema::create('tb_estoque', function (Blueprint $table) {
            $table->id('id_estoque');
            $table->unsignedBigInteger('id_produto');
            $table->enum('tipo_movimento_estoque', ['entrada', 'saida']);
            $table->integer('qtd_movimento_estoque')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('tb_estoque');
    }
};
