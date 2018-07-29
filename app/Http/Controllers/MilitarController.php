<?php

namespace App\Http\Controllers;

use App\Http\Requests\MilitarFormRequest;
use App\Models\Militar;
use Illuminate\Http\Request;

class MilitarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $militares = Militar::orderBy('nome')->get();
        
        return view('militar.index', compact('militares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $patentes = array_combine(Militar::patentes, Militar::patentes);
        
        return view('militar.form', compact('patentes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MilitarFormRequest $request, Militar $militar)
    {
        
        if ($militar->create($request->all())) {
            return redirect()->route('militares.index')->with('success', 'O ' . $request->input('patente') . 
                ' <b>' . $request->input('nome') . '</b> foi cadastrado com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Falha ao cadastrar militar!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Militar  $militar
     * @return \Illuminate\Http\Response
     */
    public function show(Militar $militar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Militar  $militar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $militar = Militar::find($id);
        $patentes = array_combine(Militar::patentes, Militar::patentes);

        return view('militar.form', compact('militar', 'patentes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Militar  $militar
     * @return \Illuminate\Http\Response
     */
    public function update(MilitarFormRequest $request, $id)
    {
        // recupera as patentes e as transforma em string através da string ',' para ser usada na validação do "in"
        $militar = Militar::find($id);
        
        if ($militar->update($request->all())) {
            return redirect()->route('militares.index')->with('success', 'O ' . $militar->patente . 
                ' <b>' . $militar->nome . '</b> foi salvo com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Falha ao salvar militar!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Militar  $militar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $militar = Militar::find($id);
        $nome = $militar->nome;
        $patente = $militar->patente;
        
        if ($militar->delete()) {
            return redirect()->route('militares.index')->with('success', "O $patente <b>$nome</b> foi 
                excluído com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao excluir militar!');
    }
}
