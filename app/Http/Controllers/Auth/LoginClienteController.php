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
            'email_cliente' => 'required|email',
            'senha_cliente' => 'required',
        ]);

        // Busca o clienteistrador no banco de dados
        $cliente = Cliente::where('email_cliente', $request->email_cliente)->first();

        if ($cliente && Hash::check($request->senha_cliente, $cliente->senha_cliente)) {
            // Autentica usando o guard 'cliente'
            Auth::guard('web')->login($cliente);

            // Redireciona para o dashboard do cliente
            return redirect()->route('sevend.index');
        }

        return back()->withErrors(['email_cliente' => 'Credenciais inválidas.']);
    }

    public function showRegisterForm()
    {
        return view('area_cliente.login.cliente_register'); // Crie esta view
    }

    public function registerCliente(Request $request)
    {
        $request->validate([
            'nome_cliente' => 'required',
            'data_nasc_cliente' => 'required',
            'cpf_cliente' => 'required',
            'rg_cliente' => 'required',
            'email_cliente' => 'required',
            'senha_cliente' => 'required',
            'tell_cliente' => 'required',
            'logra_cliente' => 'required',
            'numLogra_cliente' => 'required',
            'cep_cliente' => 'required',
            'bairro_cliente' => 'required',
            'cidade_cliente' => 'required',
            'uf_cliente' => 'required',
            'complemento_cliente' => 'required'
        ]);

        $senhaHash = Hash::make($request->senha_cliente);

        $cliente = Cliente::create([
            'nome_cliente' => $request->nome_cliente,
            'data_nasc_cliente' => $request->data_nasc_cliente,
            'cpf_cliente' => $request->cpf_cliente,
            'rg_cliente' => $request->rg_cliente,
            'email_cliente' => $request->email_cliente,
            'senha_cliente' => $senhaHash,
            'tell_cliente' => $request->tell_cliente,
            'logra_cliente' => $request->logra_cliente,
            'numLogra_cliente' => $request->numLogra_cliente,
            'cep_cliente' => $request->cep_cliente,
            'bairro_cliente' => $request->bairro_cliente,
            'cidade_cliente' => $request->cidade_cliente,
            'uf_cliente' => $request->uf_cliente,
            'complemento_cliente' => $request->complemento_cliente
        ]);

        Auth::guard('web')->login($cliente);

        return redirect()->route('sevend.dashboard');
    }

    public function logoutCliente()
    {
        Auth::guard('web')->logout();  // Faz o logout do cliente
        return redirect()->route('sevend.dashboard');  // Redireciona para a página inicial (ou para onde preferir)
    }
}
