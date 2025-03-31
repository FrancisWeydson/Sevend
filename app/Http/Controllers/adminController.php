<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::all();

        return view('area_admin.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('area_admin.admin.create');
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
            'nome_admin' => 'required',
            'data_nasc_admin' => 'required',
            'cpf_admin' => 'required',
            'rg_admin' => 'required',
            'email_admin' => 'required',
            'senha_admin' => 'required',
            'tell_admin' => 'required',
            'foto_perfil_admin' => 'nullable|image|mimes:jpg,jpeg,png|max:6656',
            'logra_admin' => 'required',
            'numLogra_admin' => 'required',
            'cep_admin' => 'required',
            'bairro_admin' => 'required',
            'cidade_admin' => 'required',
            'uf_admin' => 'required',
            'complemento_admin' => 'required',
        ]);

        if ($request->hasFile('foto_perfil_admin')) {
            $imagem = $request->file('foto_perfil_admin'); // Obtém o arquivo da requisição
            $novoNome = md5(time()) . '.' . $imagem->extension(); // Gera um nome único para o arquivo
            $caminho = 'img/' . $novoNome; // Caminho onde o arquivo será salvo dentro de public/
        
            // Move o arquivo para public/img
            $imagem->move(public_path('img'), $novoNome);
        } else {
            $caminho = null; // Se não houver imagem, salva como null
        }

        $senhaHash = Hash::make($request->senha_admin);

        Admin::create(array_merge($request->all(), ['senha_admin' => $senhaHash ,'foto_perfil_admin' => $caminho]));
        //Admin::create($request->all());

        return redirect()->route('admin.index')
                         ->with('success', 'Admin Criado Com Sucesso');
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
        $admin = Admin::findOrFail($id);
        return view('area_admin.admin.show', compact('admin'));
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
        $admin = Admin::findOrFail($id);
        return view('area_admin.admin.edit', compact('admin'));
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
            'nome_admin' => 'required',
            'data_nasc_admin' => 'required',
            'cpf_admin' => 'required',
            'rg_admin' => 'required',
            'email_admin' => 'required',
            'senha_admin' => 'required',
            'tell_admin' => 'required',
            'foto_perfil_admin' => 'nullable|image|mimes:jpg,jpeg,png|max:6656',
            'logra_admin' => 'required',
            'numLogra_admin' => 'required',
            'cep_admin' => 'required',
            'bairro_admin' => 'required',
            'cidade_admin' => 'required',
            'uf_admin' => 'required',
            'complemento_admin' => 'required',
        ]);

        $admin = Admin::findOrFail($id);

        // Processar a imagem, se existir
        if ($request->hasFile('foto_perfil_admin')) {
            $imagem = $request->file('foto_perfil_admin');
            $novoNome = md5(time()) . '.' . $imagem->extension();
            $caminho = 'img/' . $novoNome; // Caminho relativo dentro de public/

            // Move o arquivo para public/img
            $imagem->move(public_path('img'), $novoNome);

            // Se já existir uma imagem anterior, opcionalmente, pode excluir a antiga
            if ($admin->foto_perfil_admin && file_exists(public_path($admin->foto_perfil_admin))) {
                unlink(public_path($admin->foto_perfil_admin));
            }
        } else {
            $caminho = $admin->foto_perfil_admin; // Mantém a imagem anterior se não for alterada
        }

        $senhaHash = Hash::make($request->senha_admin);
        
        $admin->update(array_merge($request->all(), ['senha_admin' => $senhaHash ,'foto_perfil_admin' => $caminho]));
        //$admin->update($request->all());

        return redirect()->route('admin.index')
                         ->with('success', 'Admin Atualizado Com Sucesso!');
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
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.index')
                         ->with('success', 'Admin Excluido Com Sucesso!');
    }
}
