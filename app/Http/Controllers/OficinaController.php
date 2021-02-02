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
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficinas = Oficina::paginate(10);
        return [
            'pagination' => [
                'total' => $oficinas->total(),
                'current_page' => $oficinas->currentPage(),
                'per_page' => $oficinas->perPage(),
                'last_page' => $oficinas->lastPage(),
                'from' => $oficinas->firstItem(),
                'to' => $oficinas->lastItem(),
            ],
            'oficinas' => $oficinas
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficinas = new Oficina();
        $oficinas-> nombre_oficina = $request-> nombre_oficina;
        $oficinas-> responsable = $request-> responsable;
        $oficinas-> condicion = '1';
        $oficinas->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficinas = Oficina::findOrFail($request->id);
        $oficinas-> nombre_oficina = $request-> nombre_oficina;
        $oficinas-> responsable = $request-> responsable;
        $oficinas-> condicion = '1';
        $oficinas->save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficinas = Oficina::findOrFail($request->id);
        $oficinas-> condicion = '0';
        $oficinas->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $oficinas = Oficina::findOrFail($request->id);
        $oficinas-> condicion = '1';
        $oficinas->save();
    }
}
