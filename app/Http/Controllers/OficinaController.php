<?php

namespace App\Http\Controllers;

use App\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oficinas = Oficina::all();
        return $oficinas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oficinas = new Oficina();
        $oficinas-> nombre_oficina = $request-> nombre_oficina;
        $oficinas-> responsable = $request-> responsable;
        $oficinas->save();
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Oficina  $oficina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $oficinas = Oficina::findOrFail($request->id);
        $oficinas-> nombre_oficina = $request-> nombre_oficina;
        $oficinas-> responsable = $request-> responsable;
        $oficinas->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Oficina  $oficina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oficina $oficina)
    {
        //
    }
}
