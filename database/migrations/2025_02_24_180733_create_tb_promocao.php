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
        Schema::create('tb_promocao', function (Blueprint $table) {
            $table->id('id_promocao');
            $table->string('nome_promocao');
            $table->string('desc_promocao');
            $table->enum('tipo_promocao', ['Desconto', 'Combo', 'Outro']);
            $table->decimal('valor_promocao', 10, 2);
            $table->date('data_inicio_promocao');
            $table->date('data_fim_promocao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_promocao');
    }
};
