<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table ='tb_produto';

    protected $primaryKey ='id_produto';

    public $fillable =[
        'id_categoria', 
        'nome_produto', 
        'desc_produto', 
        'valor_produto', 
        'img_produto'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
