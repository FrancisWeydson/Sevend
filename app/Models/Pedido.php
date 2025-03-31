<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table ='tb_pedido';

    protected $primaryKey ='id_pedido';

    public $fillable =[
        'id_cliente', 
        'data_pedido', 
        'data_entrega_pedido', 
        'status_pedido', 
        'valor_total_pedido'
    ];
}
