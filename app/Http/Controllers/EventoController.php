<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index(Request $request){
   // if (!$request->ajax()) return redirect('/');

    $buscar = $request->buscar;
    $criterio = $request->criterio;
    
    if ($buscar==''){
        $eventos = Evento::orderBy('id', 'desc')->paginate(3);
    }
    else{
        $eventos = Evento::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
    }
    

    return [
        'pagination' => [
            'total'        => $eventos->total(),
            'current_page' => $eventos->currentPage(),
            'per_page'     => $eventos->perPage(),
            'last_page'    => $eventos->lastPage(),
            'from'         => $eventos->firstItem(),
            'to'           => $eventos->lastItem(),
        ],
        'eventos' => $eventos
    ];
}


public function store(Request $request)
{
    if (!$request->ajax()) return redirect('/');
    $categoria = new Evento();
    $categoria->titulo = $request->titulo;
    $categoria->descripcion = $request->descripcion;
    $categoria->imagen = $request->imagen;
    $categoria->condicion = '1';
    $categoria->save();
}

public function update(Request $request)
{
    if (!$request->ajax()) return redirect('/');
    $categoria = Evento::findOrFail($request->id);
    $categoria->titulo = $request->titulo;
    $categoria->descripcion = $request->descripcion;
    $categoria->imagen = $request->imagen;
    $categoria->condicion = '1';
    $categoria->save();
}


}
