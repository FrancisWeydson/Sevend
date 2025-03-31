<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Promocao;

class promocaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promocaos = Promocao::all();
        return view('area_admin.promocao.index', compact('promocaos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('area_admin.promocao.create');
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
            'nome_promocao' => 'required',
            'desc_promocao' => 'required',
            'tipo_promocao' => 'required|in:Desconto,Combo,Outro',
            'valor_promocao' => 'required',
            'data_inicio_promocao' => 'required',
            'data_fim_promocao' => 'required',
        ]);

        Promocao::create($request->all());

        return redirect()->route('promocao.index')->with('success', 'feito!');
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
        $promocao = Promocao::findOrFail($id);
        return view('ara_admin.promocao.show', compact('promocao'));
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
        $promocao = Promocao::findOrFail($id);
        return view('area_admin.promocao.edit', compact('promocao'));
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
            'nome_promocao' => 'required',
            'desc_promocao' => 'required',
            'tipo_promocao' => 'required|in:Desconto,Combo,Outro',
            'valor_promocao' => 'required',
            'data_inicio_promocao' => 'required',
            'data_fim_promocao' => 'required',
        ]);

        $promocao = Promocao::findOrFail($id);

        $promocao->update($request->all());

        return redirect()->route('promocao.index')->with('success', 'feito!');
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
        $promocao = Promocao::findOrFail($id);
        $promocao->delete();

        return redirect()->route('promocao.index')->with('success', 'feito!');
    }
}
