<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ItensPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class itensPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $itpedidos = ItensPedido::all();
        $pedidos = Pedido::all();
        $produtos = Produto::all();
        $itps = DB::select("
            SELECT 
                id_itens_pedido, 
                id_pedido, 
                nome_produto, 
                qtd_itens_pedido 
            FROM 
                tb_itens_pedido 
            INNER JOIN 
                tb_produto ON tb_itens_pedido.id_produto = tb_produto.id_produto
        ");
        return view('area_admin.itens_pedido.index')->with('itps', $itps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pedidos = Pedido::all();
        $produtos = Produto::all();
        return view('area_admin.itens_pedido.create', compact('pedidos'), compact('produtos'));
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
            'id_pedido' => 'required',
            'id_produto' => 'required',
            'qtd_itens_pedido' => 'required',
            'preco_unitario' => 'required',
        ]);

        ItensPedido::create($request->all());

        return redirect()->route('itens_pedido.index')->with('success', 'feito!');
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
        $itpedido = ItensPedido::findOrFail($id);
        return view('area_admin.itens_pedido.show', compact('itpedido'));
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
        $pedidos = Pedido::all();
        $produtos = Produto::all();
        $itpedido = ItensPedido::findOrFail($id);
        return view('area_admin.itens_pedido.edit')->with('produtos', $produtos)->with('pedidos', $pedidos)->with('itpedido', $itpedido);
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
            'id_pedido' => 'required',
            'id_produto' => 'required',
            'qtd_itens_pedido' => 'required',
            'preco_unitario' => 'required',
        ]);

        $itpedido = ItensPedido::findOrFail($id);

        $itpedido->update($request->all());

        return redirect()->route('itens_pedido.index')->with('success', 'feito!');
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
        $itpedido = ItensPedido::findOrFail($id);
        $itpedido->delete();

        return redirect()->route('itens_pedido.index')->with('success', 'feito!');
    }
}
