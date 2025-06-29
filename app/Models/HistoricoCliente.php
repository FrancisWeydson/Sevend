<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoCliente extends Model
{
    use HasFactory;

    protected $table ='tb_historico_cliente';

    protected $primaryKey ='id_historico_cliente';

    public $fillable =[
        'query_historico_cliente'
    ];
}
