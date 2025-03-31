<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table ='tb_estoque';

    protected $primaryKey ='id_estoque';

    public $fillable =[
        'id_produto', 
        'tipo_movimento_estoque', 
        'qtd_movimento_estoque'
    ];
}
