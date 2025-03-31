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
        Schema::create('tb_produto', function (Blueprint $table) {
            $table->id('id_produto');
            $table->unsignedBigInteger('id_categoria');
            $table->string('nome_produto');
            $table->string('desc_produto');
            $table->decimal('valor_produto', 10, 2);
            $table->string('img_produto');
            $table->timestamps();

            $table->foreign('id_categoria')  
                    ->references('id_categoria')     
                    ->on('tb_categoria')          
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
        Schema::dropIfExists('tb_produto');
    }
};
