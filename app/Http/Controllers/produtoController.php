<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class produtoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prods = Produto::all();
        $cats = Categoria::all();
        $prds = DB::select("
            SELECT 
                id_produto, 
                nome_produto, 
                nome_categoria 
            FROM 
                tb_produto 
            INNER JOIN 
                tb_categoria ON tb_produto.id_categoria = tb_categoria.id_categoria
        ");
        return view('area_admin.produto.index')->with('prds', $prds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cats = Categoria::all();
        return view('area_admin.produto.create', compact('cats'));
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
            'id_categoria' => 'required',
            'nome_produto' => 'required',
            'desc_produto' => 'required',
            'valor_produto' => 'required',
            'img_produto' => 'required|image|mimes:jpg,jpeg,png|max:6656'
        ]);

        if ($request->hasFile('img_produto')) {
            $imagem = $request->file('img_produto'); // Obtém o arquivo da requisição
            $novoNome = md5(time()) . '.' . $imagem->extension(); // Gera um nome único para o arquivo
            $caminho = 'img/' . $novoNome; // Caminho onde o arquivo será salvo dentro de public/
        
            // Move o arquivo para public/img
            $imagem->move(public_path('img'), $novoNome);
        } else {
            $caminho = null; // Se não houver imagem, salva como null
        }

        Produto::create(array_merge($request->all(), ['img_produto' => $caminho]));

        return redirect()->route('produto.index')->with('success', 'Feito!');
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
        $produto = Produto::findOrFail($id);
        return view('area_admin.produto.show', compact('produto'));
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
        $cats = Categoria::all();
        $produto = Produto::findOrFail($id);
        return view('area_admin.produto.edit', compact('produto'), compact('cats'));
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
            'id_categoria' => 'required',
            'nome_produto' => 'required',
            'desc_produto' => 'required',
            'valor_produto' => 'required',
            'img_produto' => 'nullable|image|mimes:jpg,jpeg,png|max:6656'
        ]);

        $produto = Produto::findOrFail($id);

        if ($request->hasFile('img_produto')) {
            $imagem = $request->file('img_produto');
            $novoNome = md5(time()) . '.' . $imagem->extension();
            $caminho = 'img/' . $novoNome; // Caminho relativo dentro de public/

            // Move o arquivo para public/img
            $imagem->move(public_path('img'), $novoNome);

            // Se já existir uma imagem anterior, opcionalmente, pode excluir a antiga
            if ($produto->img_produto && file_exists(public_path($produto->img_produto))) {
                unlink(public_path($produto->img_produto));
            }
        } else {
            $caminho = $produto->img_produto; // Mantém a imagem anterior se não for alterada
        }

        $produto->update(array_merge($request->all(), ['img_produto' => $caminho]));

        return redirect()->route('produto.index')->with('success', 'Feito!');
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
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produto.index')->with('success', 'Feito!');
    }
}
