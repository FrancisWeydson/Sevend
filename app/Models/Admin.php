<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table ='tb_admin';

    protected $primaryKey ='id_admin';

    public $fillable =[
        'nome_admin',
        'data_nasc_admin', 
        'cpf_admin', 
        'rg_admin', 
        'email_admin', 
        'senha_admin', 
        'tell_admin',
        'foto_perfil_admin', 
        'logra_admin', 
        'numLogra_admin', 
        'cep_admin', 
        'bairro_admin', 
        'cidade_admin', 
        'uf_admin', 
        'complemento_admin'
    ];

    protected $hidden = [
        'senha_admin'
    ];
}
