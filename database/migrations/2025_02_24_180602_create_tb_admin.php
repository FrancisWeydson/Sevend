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
        Schema::create('tb_admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nome_admin', 150);
            $table->date('data_nasc_admin');
            $table->string('cpf_admin', 14)->unique();
            $table->string('rg_admin', 12)->unique();
            $table->string('email_admin', 100)->unique();
            $table->string('senha_admin', 100);
            $table->string('tell_admin', 15);
            $table->string('foto_perfil_admin', 255);
            $table->string('logra_admin', 100);
            $table->string('numLogra_admin', 6);
            $table->string('cep_admin', 9);
            $table->string('bairro_admin', 100);
            $table->string('cidade_admin', 100);
            $table->string('uf_admin', 20);
            $table->string('complemento_admin', 150);
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
        Schema::dropIfExists('tb_admin');
    }
};
