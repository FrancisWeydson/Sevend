<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('area_admin.login.admin_login'); // Crie esta view
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email_admin' => 'required|email',
            'senha_admin' => 'required',
        ]);

        // Busca o administrador no banco de dados
        $admin = Admin::where('email_admin', $request->email_admin)->first();

        if ($admin && Hash::check($request->senha_admin, $admin->senha_admin)) {
            // Autentica usando o guard 'admin'
            Auth::guard('admin')->login($admin);

            // Redireciona para o dashboard do admin
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email_admin' => 'Credenciais inválidas.']);
    }
    
    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();  // Faz o logout do administrador
        return redirect()->route('login');  // Redireciona para a página inicial (ou para onde preferir)
    }
}
