<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;

    protected $table ='tb_carrinho';

    protected $primaryKey ='id_carrinho';

    public $fillable =[
        'id_cliente', 
        'id_produto', 
        'qntd_carrinho', 
        'preco_unitario_carrinho', 
        'preco_total_carrinho'
    ];
}
