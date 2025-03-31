<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoPromocao extends Model
{
    use HasFactory;

    protected $table ='tb_produto_promocao';

    protected $primaryKey ='id_produto_promocao';

    public $fillable =[
        'id_produto', 
        'id_promocao'
    ];
}
