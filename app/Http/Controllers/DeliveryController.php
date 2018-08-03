<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryFormRequest;
use App\Models\Delivery;
use Cornford\Googlmapper\Mapper;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::orderBy('client')->get();
        
        return view('delivery.index', compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('delivery.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryFormRequest $request, Delivery $delivery)
    {
        
        if ($delivery->create($request->all())) {
            return redirect()->route('deliveries.index')->with('success', 'A entrega do cliente <b>' 
                . $request->input('client') . ' </b> foi cadastrada com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Falha ao cadastrar a entrega!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $Delivery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $delivery = Delivery::find($id);
        
        return view('delivery.show', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $Delivery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $delivery = Delivery::find($id);

        return view('delivery.form', compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $Delivery
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryFormRequest $request, $id)
    {
        $delivery = Delivery::find($id);
        
        if ($delivery->update($request->all())) {
            return redirect()->route('deliveries.index')->with('success', 'A entrega do cliente <b>'
                . $request->input('client') . ' </b> foi salva com sucesso!');
        }
        
        return redirect()->back()->with('error', 'Falha ao salvar entrega!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $Delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery = Delivery::find($id);
        $client = $delivery->client;
        
        if ($delivery->delete()) {
            return redirect()->route('deliveries.index')->with('success', "A entrega do cliente <b>$client</b> foi 
                excluída com sucesso!");
        }
        
        return redirect()->back()->with('error', 'Falha ao excluir entrega!');
    }
}
