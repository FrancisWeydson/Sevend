<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cliente extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table ='tb_cliente';

    protected $primaryKey ='id_cliente';

    public $fillable =[
        'nome_cliente', 
        'data_nasc_cliente',
        'cpf_cliente', 
        'rg_cliente', 
        'email_cliente', 
        'senha_cliente', 
        'tell_cliente', 
        'foto_perfil_cliente',
        'logra_cliente', 
        'numLogra_cliente', 
        'cep_cliente', 
        'bairro_cliente', 
        'cidade_cliente', 
        'uf_cliente', 
        'complemento_cliente'
    ];

    protected $hidden = [
        'senha_cliente'
    ];
}
