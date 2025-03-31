<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Cliente;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clientes = Cliente::all();

        return view('area_admin.cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('area_admin.cliente.create');
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
            'nome_cliente' => 'required',
            'data_nasc_cliente' => 'required',
            'cpf_cliente' => 'required',
            'rg_cliente' => 'required',
            'email_cliente' => 'required',
            'senha_cliente' => 'required',
            'tell_cliente' => 'required',
            'foto_perfil_cliente' => 'nullable|image|mimes:jpg,jpeg,png|max:6656',
            'logra_cliente' => 'required',
            'numLogra_cliente' => 'required',
            'cep_cliente' => 'required',
            'bairro_cliente' => 'required',
            'cidade_cliente' => 'required',
            'uf_cliente' => 'required',
            'complemento_cliente' => 'required'
        ]);

        if ($request->hasFile('foto_perfil_cliente')) {
            $imagem = $request->file('foto_perfil_cliente'); // Obtém o arquivo da requisição
            $novoNome = md5(time()) . '.' . $imagem->extension(); // Gera um nome único para o arquivo
            $caminho = 'img/' . $novoNome; // Caminho onde o arquivo será salvo dentro de public/
        
            // Move o arquivo para public/img
            $imagem->move(public_path('img'), $novoNome);
        } else {
            $caminho = null; // Se não houver imagem, salva como null
        }

        $senhaHash = Hash::make($request->senha_cliente);

        Cliente::create(array_merge($request->all(), ['senha_cliente' => $senhaHash ,'foto_perfil_cliente' => $caminho]));
        //cliente::create($request->all());

        return redirect()->route('cliente.index')
                         ->with('success', 'cliente Criado Com Sucesso');
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
        $cliente = Cliente::findOrFail($id);
        return view('area_admin.cliente.show');
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
        $cliente = Cliente::findOrFail($id);
        return view('area_admin.cliente.edit', compact('cliente'));
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
            'nome_cliente' => 'required',
            'data_nasc_cliente' => 'required',
            'cpf_cliente' => 'required',
            'rg_cliente' => 'required',
            'email_cliente' => 'required',
            'senha_cliente' => 'required',
            'tell_cliente' => 'required',
            'foto_perfil_cliente' => 'nullable|image|mimes:jpg,jpeg,png|max:6656',
            'logra_cliente' => 'required',
            'numLogra_cliente' => 'required',
            'cep_cliente' => 'required',
            'bairro_cliente' => 'required',
            'cidade_cliente' => 'required',
            'uf_cliente' => 'required',
            'complemento_cliente' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        if ($request->hasFile('foto_perfil_cliente')) {
            $imagem = $request->file('foto_perfil_cliente');
            $novoNome = md5(time()) . '.' . $imagem->extension();
            $caminho = 'img/' . $novoNome; // Caminho relativo dentro de public/

            // Move o arquivo para public/img
            $imagem->move(public_path('img'), $novoNome);

            // Se já existir uma imagem anterior, opcionalmente, pode excluir a antiga
            if ($cliente->foto_perfil_cliente && file_exists(public_path($cliente->foto_perfil_cliente))) {
                unlink(public_path($cliente->foto_perfil_cliente));
            }
        } else {
            $caminho = $cliente->foto_perfil_cliente; // Mantém a imagem anterior se não for alterada
        }

        $senhaHash = Hash::make($request->senha_cliente);

        $cliente->update(array_merge($request->all(), ['senha_cliente' => $senhaHash ,'foto_perfil_cliente' => $caminho]));
        //cliente::create($request->all());

        return redirect()->route('cliente.index')
                         ->with('success', 'cliente Criado Com Sucesso');
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
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('cliente.index')
                         ->with('success', 'cliente Criado Com Sucesso');
    }
}
