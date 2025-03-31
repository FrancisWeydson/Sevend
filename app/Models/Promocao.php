<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    use HasFactory;

    protected $table ='tb_promocao';

    protected $primaryKey ='id_promocao';

    public $fillable =[
        'nome_promocao', 
        'desc_promocao', 
        'tipo_promocao', 
        'valor_promocao', 
        'data_inicio_promocao', 
        'data_fim_promocao'
    ];
}
