<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estoque;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;

class estoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $estoques = Estoque::all();
        $prods = Produto::all();
        $estqs = DB::select("
            SELECT 
                id_estoque, 
                nome_produto, 
                qtd_movimento_estoque 
            FROM 
                tb_estoque 
            INNER JOIN 
                tb_produto ON tb_estoque.id_produto = tb_produto.id_produto
        ");
        return view('area_admin.estoque.index', compact('estoques'), compact('prods'))->with('estqs', $estqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $prods = Produto::all();
        return view('area_admin.estoque.create', compact('prods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_produto' => 'required',
            'tipo_movimento_estoque' => 'required|in:entrada,saida',
            'qtd_movimento_estoque' => 'required'
        ]);

        Estoque::create($request->all());

        return redirect()->route('estoque.index')->with('success', 'feito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $estoque = Estoque::findOrFail($id);
        return view('area_admin.estoque.show', compact('estoque'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prods = Produto::all();
        $estoque = Estoque::findOrFail($id);
        return view('area_admin.estoque.edit', compact('estoque'), compact('prods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'id_produto' => 'required',
            'tipo_movimento_estoque' => 'required|in:entrada,saida',
            'qtd_movimento_estoque' => 'required'
        ]);
        $estoque = Estoque::findOrFail($id);

        $estoque->update($request->all());

        return redirect()->route('estoque.index')->with('success', 'feito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $estoque = Estoque::findOrFail($id);
        $estoque->delete();

        return redirect()->route('estoque.index')->with('success', 'feito!');
    }
}
