<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
    public function showProfile()
    {
        $cliente = auth()->user(); // Ou Auth::guard('cliente')->user() dependendo da sua configuração
        return view('perfil', compact('cliente'));
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
            'nome' => 'required',
            'data_nasc' => 'required',
            'cpf' => 'required|unique:tb_cliente,cpf',
            'rg' => 'required|unique:tb_cliente,rg',
            'email' => 'required|email|unique:tb_cliente,email',
            'senha' => 'required',
            'tell' => 'required',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png|max:6656',
            'logra' => 'required',
            'numLogra' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'complemento' => 'required'
        ]);

        if ($request->hasFile('foto_perfil')) {
            $imagem = $request->file('foto_perfil'); // Obtém o arquivo da requisição
            $novoNome = md5(time()) . '.' . $imagem->extension(); // Gera um nome único para o arquivo
            $caminho = 'img/' . $novoNome; // Caminho onde o arquivo será salvo dentro de public/
        
            // Move o arquivo para public/img
            $imagem->move(public_path('img'), $novoNome);
        } else {
            $caminho = null; // Se não houver imagem, salva como null
        }

        $senhaHash = Hash::make($request->senha_cliente);

        Cliente::create(array_merge($request->all(), ['senha' => $senhaHash ,'foto_perfil' => $caminho]));
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
            'nome' => 'required',
            'data_nasc' => 'required',
            'cpf' => 'required|unique:tb_cliente,cpf_cliente,' . $id . ',id',
            'rg' => 'required|unique:tb_cliente,rg_cliente,' . $id . ',id',
            'email' => 'required|email|unique:tb_cliente,email_cliente,' . $id . ',id',
            'senha' => 'required',
            'tell' => 'required',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png|max:6656',
            'logra' => 'required',
            'numLogra' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'complemento' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        if ($request->hasFile('foto_perfil')) {
            $imagem = $request->file('foto_perfil');
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

        $cliente->update(array_merge($request->all(), ['senha' => $senhaHash ,'foto_perfil' => $caminho]));
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
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('cliente.index')->with('success', 'Mensagem enviada com sucesso!');
    }
    
    public function edit2($id)
    {
        //
        $cliente = Cliente::findOrFail($id);
        return view('perfil')->with('cliente', $cliente);
    }


    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'data_nasc' => 'required',
            'cpf' => 'required|unique:tb_cliente,cpf_cliente,' . $id . ',id',
            'rg' => 'required|unique:tb_cliente,rg_cliente,' . $id . ',id',
            'email' => 'required|email|unique:tb_cliente,email_cliente,' . $id . ',id',
            'tell' => 'required',
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png|max:6656',
            'logra' => 'required',
            'numLogra' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'complemento' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        if ($request->hasFile('foto_perfil')) {
            $imagem = $request->file('foto_perfil'); // Obtém o arquivo da requisição
            $novoNome = md5(time()) . '.' . $imagem->extension(); // Gera um nome único para o arquivo
            $caminho = 'img/adm/' . $novoNome; // Caminho onde o arquivo será salvo dentro de public/
        
            // Move o arquivo para public/img
            $imagem->move(public_path('img/adm'), $novoNome);
        } else {
            $caminho = $cliente->foto_perfil_cliente; // Se não houver imagem, salva como null
        }

        $cliente->nome_cliente = $request['nome'];
        $cliente->data_nasc_cliente = $request['data_nasc'];
        $cliente->cpf_cliente = $request['cpf'];
        $cliente->rg_cliente = $request['rg'];
        $cliente->email_cliente = $request['email'];
        $cliente->tell_cliente = $request['tell'];
        $cliente->foto_perfil_cliente = $caminho;
        $cliente->logra_cliente = $request['logra'];
        $cliente->numLogra_cliente = $request['numLogra'];
        $cliente->cep_cliente = $request['cep'];
        $cliente->bairro_cliente = $request['bairro'];
        $cliente->cidade_cliente = $request['cidade'];
        $cliente->uf_cliente = $request['uf'];
        $cliente->complemento_cliente = $request['complemento'];
        $cliente->save();

        return redirect()->route('sevend.home')->with('success', 'Mensagem enviada com sucesso!');
        
    }
    public function updateSenhaProfile(Request $request, $id){
        $request->validate([
            'senha_atual' => 'required',
            'senha' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        if ($cliente && Hash::check($request['senha_atual'], $cliente->senha_cliente)) {
            $cliente->senha_cliente = $request['senha'];
            $cliente->save();
            return redirect()->route('sevend.home')->with('success', 'Mensagem enviada com sucesso!');
        }else {
            return redirect()->route('sevend.sobre')->with('error', 'Senha Atual Errada!');
        };

    }
    public function destroy2($id)
    {
        Auth::guard('web')->logout();
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('sevend.home')->with('success', 'Mensagem enviada com sucesso!');
    }
    public function updateApiCliente(Request $request, $id)
    {
        $request->validate([
            'logra' => 'required',
            'num' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'complemento' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        $cliente->logra_cliente = $request['logra'];
        $cliente->numLogra_cliente = $request['num'];
        $cliente->cep_cliente = $request['cep'];
        $cliente->bairro_cliente = $request['bairro'];
        $cliente->cidade_cliente = $request['cidade'];
        $cliente->uf_cliente = $request['uf'];
        $cliente->complemento_cliente = $request['complemento'];
        $cliente->save();

        return response()->json([
            'success' => 'Endereco Atualizado com Sucesso!'
        ]);
        
    }
    
    
}
