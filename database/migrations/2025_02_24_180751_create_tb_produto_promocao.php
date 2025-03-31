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
        Schema::create('tb_produto_promocao', function (Blueprint $table) {
            $table->id('id_produto_promocao');
            $table->unsignedBigInteger('id_produto');
            $table->unsignedBigInteger('id_promocao');
            $table->timestamps();

            $table->foreign('id_produto')  
                    ->references('id_produto')     
                    ->on('tb_produto')          
                    ->onDelete('cascade');

            $table->foreign('id_promocao')  
                    ->references('id_promocao')     
                    ->on('tb_promocao')          
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
        Schema::dropIfExists('tb_produto_promocao');
    }
};
