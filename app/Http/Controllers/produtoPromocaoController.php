<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProdutoPromocao;
use App\Models\Produto;
use App\Models\Promocao;
use Illuminate\Support\Facades\DB;

class produtoPromocaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prpromocaos = ProdutoPromocao::all();
        $produtos = Produto::all();
        $promocoes = Promocao::all();
        $prpromos = DB::select("
            SELECT 
                id_produto_promocao, 
                nome_produto, 
                nome_promocao 
            FROM 
                tb_produto_promocao 
            INNER JOIN 
                tb_produto ON tb_produto_promocao.id_produto = tb_produto.id_produto 
            INNER JOIN 
                tb_promocao ON tb_produto_promocao.id_promocao = tb_promocao.id_promocao
        ");
        return view('area_admin.produto_promocao.index')->with('prpromos', $prpromos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $produtos = Produto::all();
        $promocoes = Promocao::all();
        return view('area_admin.produto_promocao.create', compact('produtos'), compact('promocoes'));
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
            'id_promocao' => 'required'
        ]);

        ProdutoPromocao::create($request->all());

        return redirect()->route('produto_promocao.index')->with('success', 'feito!');
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
        $prpromocao = ProdutoPromocao::findOrFail($id);
        return view('area_admin.produto_promocao.show', compact('prpromocao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $produtos = Produto::all();
        $promocoes = Promocao::all();
        $prpromocao = ProdutoPromocao::findOrFail($id);
        return view('area_admin.produto_promocao.edit')->with('prpromocao', $prpromocao)->with('produtos', $produtos)->with('promocoes', $promocoes);
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
            'id_promocao' => 'required'
        ]);

        $prpromocao = ProdutoPromocao::findOrFail($id);

        $prpromocao->update($request->all());

        return redirect()->route('produto_promocao.index')->with('success', 'feito!');
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
        $prpromocao = ProdutoPromocao::findOrFail($id);
        $prpromocao->delete();

        return redirect()->route('produto_promocao.index')->with('success', 'feito!');
    }
}
