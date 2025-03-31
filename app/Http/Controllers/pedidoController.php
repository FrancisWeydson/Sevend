<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

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
}
