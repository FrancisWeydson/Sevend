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
        Schema::create('tb_cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nome_cliente', 100);
            $table->date('data_nasc_cliente');
            $table->string('cpf_cliente', 14)->unique();
            $table->string('rg_cliente', 12)->unique();
            $table->string('email_cliente', 100)->unique();
            $table->string('senha_cliente', 100);
            $table->string('tell_cliente', 15);
            $table->string('foto_perfil_cliente', 255);
            $table->string('logra_cliente', 100);
            $table->string('numLogra_cliente', 6);
            $table->string('cep_cliente', 9);
            $table->string('bairro_cliente', 50);
            $table->string('cidade_cliente', 50);
            $table->string('uf_cliente', 20);
            $table->string('complemento_cliente', 100);
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
        Schema::dropIfExists('tb_cliente');
    }
};
