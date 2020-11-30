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

    public function store(Request $request)
    {
        $oficinas = new Oficina();
        $oficinas-> nombre_oficina = $request-> nombre_oficina;
        $oficinas-> responsable = $request-> responsable;
        $oficinas-> condicion = '1';
        $oficinas->save();
    }

    public function update(Request $request)
    {
        $oficinas = Oficina::findOrFail($request->id);
        $oficinas-> nombre_oficina = $request-> nombre_oficina;
        $oficinas-> responsable = $request-> responsable;
        $oficinas-> condicion = '1';
        $oficinas->save();
    }

    public function desactivar(Request $request)
    {
        $oficinas = Oficina::findOrFail($request->id);
        $oficinas-> condicion = '0';
        $oficinas->save();
    }

    public function activar(Request $request)
    {
        $oficinas = Oficina::findOrFail($request->id);
        $oficinas-> condicion = '1';
        $oficinas->save();
    }
}
