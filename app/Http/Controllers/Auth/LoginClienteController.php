<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginClienteController extends Controller
{
    public function showLoginForm()
    {
        return view('area_cliente.login.cliente_login'); // Crie esta view
    }
    public function loginCliente(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Busca o cliente no banco de dados
        $cliente = Cliente::where('email_cliente', $request->email)->first();
    
        if ($cliente && Hash::check($request['password'], $cliente->senha_cliente)) {
            dd($cliente);
            // Autentica usando o guard 'cliente'
            Auth::guard('web')->login($cliente);
    
            // Redireciona para o dashboard do cliente
            return redirect()->route('sevend.home');
        }
    
        return back()->withErrors(['email' => 'Credenciais inválidas.']);
    }
    

    public function showRegisterForm()
    {
        return view('area_cliente.login.cliente_register'); // Crie esta view
    }

    public function registerCliente(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'dataNasc' => 'required',
            'cpf' => 'required|unique:tb_cliente,cpf_cliente',
            'rg' => 'required|unique:tb_cliente,rg_cliente',
            'email' => 'required|email|unique:tb_cliente,email_cliente',
            'password' => 'required',
            'telefone' => 'required',
            'logra' => 'required',
            'numLogra' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'complemento' => 'required'
        ]);

        $senhaHash = Hash::make($request['password']);

        $cliente = new CLiente();
        $cliente->nome_cliente = $request->nome;
        $cliente->data_nasc_cliente = $request->dataNasc;
        $cliente->cpf_cliente = $request->cpf;
        $cliente->rg_cliente = $request->rg;
        $cliente->email_cliente = $request->email;
        $cliente->senha_cliente = $senhaHash;
        $cliente->tell_cliente = $request->telefone;
        $cliente->logra_cliente = $request->logra;
        $cliente->numLogra_cliente = $request->numLogra;
        $cliente->cep_cliente = $request->cep;
        $cliente->bairro_cliente = $request->bairro;
        $cliente->cidade_cliente = $request->cidade;
        $cliente->uf_cliente = $request->uf;
        $cliente->complemento_cliente = $request->complemento;
        $cliente->save();

        Auth::guard('web')->login($cliente);

        return redirect()->route('sevend.home');
    }

    public function logoutCliente()
    {
        Auth::guard('web')->logout();  // Faz o logout do cliente
        return redirect()->route('sevend.home');  // Redireciona para a página inicial (ou para onde preferir)
    }
}
