<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use App\Models\HistoricoCliente;

class PesquisaController extends Controller
{
    //
    public function query(Request $request){

        $cats = Categoria::all();
        $query = $request->query('q');  
        $filtroCategoria = $request->query('categoria');
        $ordenacao = $request->query('sort');

        $produtos = Produto::query();

        if ($query) {
            $historico = new HistoricoCLiente();
            $historico->query_historico_cliente = $query;
            $historico->save();
            $produtos->where('nome_produto', 'like', "%{$query}%");
        }
    
        if ($filtroCategoria) {
            $produtos->whereHas('categoria', function ($q) use ($filtroCategoria) {
                $q->where('nome_categoria', 'like', "%{$filtroCategoria}%"); 
            });
        }

        if ($ordenacao) {
            if ($ordenacao == 'price-asc') {
                $produtos->orderBy('valor_produto', 'asc');
            } elseif ($ordenacao == 'price-desc') {
                $produtos->orderBy('valor_produto', 'desc');
            } else {
                $produtos->orderBy('nome_produto', 'asc');
            }
        }
    
        $produtos = $produtos->paginate(9)->appends($request->query());

        return view('pesquisa')->with('produtos', $produtos)->with('pesquisa', $query)->with('cats', $cats);
    }
}
