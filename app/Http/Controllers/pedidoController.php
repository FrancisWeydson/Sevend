<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use App\Models\Carrinho;
use App\Models\ItensPedido;

class pedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidos = Pedido::all();
        $clientes = Cliente::all();
        $peds = DB::select("
            SELECT 
                id_pedido, 
                nome_cliente, 
                data_entrega_pedido, 
                data_pedido, 
                status_pedido 
            FROM 
                tb_pedido 
            INNER JOIN 
                tb_cliente ON tb_pedido.id_cliente = tb_cliente.id_cliente
        ");
        return view('area_admin.pedido.index')->with('peds', $peds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('area_admin.pedido.create', compact('clientes'));
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
            'data_pedido' => 'required',
            'data_entrega_pedido' => 'required',
            'status_pedido' => 'required|in:Em Andamento,Finalizado,Cancelado',
            'valor_total_pedido' => 'required',
        ]);

        Pedido::create($request->all());

        return redirect()->route('pedido.index')->with('success', 'feito!');
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
        $pedido = Pedido::findOrFail($id);
        return view('area_admin.pedido.show', compact('pedido'));
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
        $clientes = Cliente::all();
        $pedido = Pedido::findOrFail($id);
        return view('area_admin.pedido.edit', compact('pedido'), compact('clientes'));
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
            'data_pedido' => 'required',
            'data_entrega_pedido' => 'required',
            'status_pedido' => 'required|in:Em Andamento,Finalizado,Cancelado',
            'valor_total_pedido' => 'required',
        ]);

        $pedido = Pedido::findOrFail($id);

        $pedido->update($request->all());

        return redirect()->route('pedido.index')->with('success', 'feito!');
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
        $pedido = Pedido::findOrFail($id);
        $pedido->delete();

        return redirect()->route('pedido.index')->with('success', 'feito!');
    }
    public function storeCliente($id)
    {
        //
        $cliente= Cliente::findOrFail($id);
        $carrinho = Carrinho::where('id_cliente', $id)->join('tb_produto', 'tb_carrinho.id_produto', '=', 'tb_produto.id_produto')->get();

        $total = 0;

        foreach ($carrinho as $item) {
            $total += $item->preco_total_carrinho;
        };

        $pedido = new Pedido();
        $pedido->id_cliente = $id;
        $pedido->data_pedido = now();
        $pedido->data_entrega_pedido = now()->addDays(20);
        $pedido->status_pedido = 'Em Andamento';
        $pedido->valor_total_pedido = $total;
        $pedido->save();

        foreach ($carrinho as $item) {
            $itemPedido = new ItensPedido();
            $itemPedido->id_pedido = $pedido->id_pedido;
            $itemPedido->id_produto = $item->id_produto;
            $itemPedido->qtd_itens_pedido = $item->qntd_carrinho;
            $itemPedido->preco_unitario = $item->preco_total_carrinho;
            $itemPedido->save();

            $carrinho = Carrinho::findOrFail($item->id_carrinho);
            $carrinho->delete();
        };

        return redirect()->route('sevend.pedido.index', $id)->with('success', 'feito!');
    }
    public function mostrarPedidos(Request $request, $id)
    {
        $filtroStatus = $request->query('status');
        $pedidos = Pedido::query();

        $pedidos->where('id_cliente', $id)->with('itens.produto');

        if ($filtroStatus) {
            $pedidos->where('status_pedido', 'like', "%{$filtroStatus}%");
        }

        $pedidos = $pedidos->get();

        return view('pedidos')->with('pedidos', $pedidos);
    }
}
