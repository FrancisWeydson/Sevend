<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carrinho;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;
use App\Models\Produto;

class CarrinhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carrinhos = Carrinho::all();
        return view('area_admin.carrinho.index')->with('carrinhos', $carrinhos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();
        return view('area_admin.carrinho.create')->with('produtos', $produtos)->with('clientes', $clientes);
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
            'id_cliente' => 'required',
            'id_produto' => 'required',
            'qntd_carrinho' => 'required',
            'preco_unitario_carrinho' => 'required',
            'preco_total_carrinho' => 'required'
        ]);

        $carrinho = new Carrinho();
        $carrinho->id_cliente = $request['id_cliente'];
        $carrinho->id_produto = $request['id_produto'];
        $carrinho->qntd_carrinho = $request['qntd_carrinho'];
        $carrinho->preco_unitario_carrinho = $request['preco_unitario_carrinho'];
        $carrinho->preco_total_carrinho = $request['preco_total_carrinho'];
        $carrinho->save();

        return redirect()->route('carrinho.index')->with('success', 'feito!');
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
        $carrinho = Carrinho::findOrFail($id);
        return view('area_admin.carrinho.show')->with('carrinho', $carrinho);
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
        $carrinho = Carrinho::findOrFail($id);
        $produtos = Produto::all();
        $clientes = Cliente::all();
        return view('area_admin.carrinho.edit')->with('produtos', $produtos)->with('clientes', $clientes)->with('carrinho', $carrinho);
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
            'id_cliente' => 'required',
            'id_produto' => 'required',
            'qntd_carrinho' => 'required',
            'preco_unitario_carrinho' => 'required',
            'preco_total_carrinho' => 'required'
        ]);

        $carrinho = Carrinho::findOrFail($id);
        $carrinho->id_cliente = $request['id_cliente'];
        $carrinho->id_produto = $request['id_produto'];
        $carrinho->qntd_carrinho = $request['qntd_carrinho'];
        $carrinho->preco_unitario_carrinho = $request['preco_unitario_carrinho'];
        $carrinho->preco_total_carrinho = $request['preco_total_carrinho'];
        $carrinho->save();

        return redirect()->route('carrinho.index')->with('success', 'feito!');
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
        $carrinho = Carrinho::findOrFail($id);
        $carrinho->delete();

        return redirect()->route('carrinho.index')->with('success', 'feito!');
    }
    public function storeApiCliente(Request $request)
    {
        //
        $request->validate([
            'idCliente' => 'required',
            'idProduto' => 'required',
            'qntdCarrinho' => 'required',
            'precoUnitarioCarrinho' => 'required'
        ]);

        $itemExistente = Carrinho::where('id_cliente', $request->idCliente)
        ->where('id_produto', $request->idProduto)
        ->first();

        $novaQtd = (int) $request->qntdCarrinho;
        $precoUnitario = (float) $request->precoUnitarioCarrinho;

        if ($itemExistente) {
            
            $itemExistente->qntd_carrinho += $novaQtd;
            $itemExistente->preco_total_carrinho = $itemExistente->qntd_carrinho * $precoUnitario;
            $itemExistente->save();

            return response()->json([
                'carrinhoCliente' => $itemExistente
            ]);
        } else {
            
            $novoItem = new Carrinho();
            $novoItem->id_cliente = $request->idCliente;
            $novoItem->id_produto = $request->idProduto;
            $novoItem->qntd_carrinho = $novaQtd;
            $novoItem->preco_unitario_carrinho = $precoUnitario;
            $novoItem->preco_total_carrinho = $novaQtd * $precoUnitario;
            $novoItem->save();

            return response()->json([
                'carrinhoCliente' => $novoItem
            ]);
        }
    }
    public function updateApiCliente(Request $request, $id)
    {
        //
        $request->validate([
            'idCliente' => 'required',
            'idProduto' => 'required',
            'qntdCarrinho' => 'required',
        ]);

        $carrinho = Carrinho::findOrFail($id);

        $unit = (float) $carrinho->preco_unitario_carrinho;
        $qtd = (int) $request['qntdCarrinho'];

        $precoTotal = $unit * $qtd;

        $carrinho->id_cliente = $request['idCliente'];
        $carrinho->id_produto = $request['idProduto'];
        $carrinho->qntd_carrinho = $request['qntdCarrinho'];
        $carrinho->preco_unitario_carrinho = $carrinho->preco_unitario_carrinho;
        $carrinho->preco_total_carrinho = $precoTotal;
        $carrinho->save();

        return response()->json([
            'Sucess' => 'sucesso'
        ]);
    }
    public function indexApiCliente($id)
    {
        //
        $carrinhos = Carrinho::where('id_cliente', $id)->join('tb_produto', 'tb_carrinho.id_produto', '=', 'tb_produto.id_produto')->get();
        return response()->json([
            'carrinhoCliente' => $carrinhos
        ]);
    }
    public function indexCliente($id)
    {
        //
        $cliente= Cliente::findOrFail($id);
        $carrinho = Carrinho::where('id_cliente', $id)->join('tb_produto', 'tb_carrinho.id_produto', '=', 'tb_produto.id_produto')->get();
        $total = Carrinho::where('id_cliente', $id)
        ->join('tb_produto', 'tb_carrinho.id_produto', '=', 'tb_produto.id_produto')
        ->sum('preco_total_carrinho');

        return view('finalizar_compra')->with([
            'carrinho' => $carrinho,
            'cliente' => $cliente,
            'total' => $total
        ]);
    }
    public function destroyApiCliente($id)
    {
        //
        $carrinho = Carrinho::findOrFail($id);
        $carrinho->delete();

        return response()->json([
            'success' => 'Deletado com Sucesso!'
        ]);
    }
}
