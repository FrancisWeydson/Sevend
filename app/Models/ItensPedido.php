<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{
    use HasFactory;

    protected $table ='tb_itens_pedido';

    protected $primaryKey ='id_itens_pedido';

    public $fillable =[
        'id_pedido', 
        'id_produto', 
        'qtd_itens_pedido', 
        'preco_unitario'
    ];
}
