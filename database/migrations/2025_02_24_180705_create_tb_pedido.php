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
        Schema::create('tb_pedido', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->unsignedBigInteger('id_cliente');
            $table->date('data_pedido');
            $table->date('data_entrega_pedido');
            $table->enum('status_pedido', ['Em Andamento', 'Finalizado', 'Cancelado']);
            $table->decimal('valor_total_pedido', 10, 2);
            $table->timestamps();

            $table->foreign('id_cliente')  
                    ->references('id_cliente')     
                    ->on('tb_cliente')          
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
        Schema::dropIfExists('tb_pedido');
    }
};
