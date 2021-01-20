<?php

namespace App\Http\Controllers;

use App\Comunicado;
use Illuminate\Http\Request;

class ComunicadoController extends Controller
{
    public function index(Request $request){
        // if (!$request->ajax()) return redirect('/');
     
         $buscar = $request->buscar;
         $criterio = $request->criterio;
         
         if ($buscar==''){
             $comunicados = Comunicado::orderBy('id', 'desc')->paginate(3);
         }
         else{
             $comunicados = Comunicado::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
         }
         
     
         return [
             'pagination' => [
                 'total'        => $comunicados->total(),
                 'current_page' => $comunicados->currentPage(),
                 'per_page'     => $comunicados->perPage(),
                 'last_page'    => $comunicados->lastPage(),
                 'from'         => $comunicados->firstItem(),
                 'to'           => $comunicados->lastItem(),
             ],
             'comunicados' => $comunicados
         ];
     }
     
     
     public function store(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $comunicado = new Comunicado();
         $comunicado->titulo = $request->titulo;
         $comunicado->descripcion = $request->descripcion;
         $comunicado->fecha = $request->fecha;
         $comunicado->atentamente = $request->atentamente;
         $comunicado->save();
     }
     
     public function update(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $comunicado = Comunicado::findOrFail($request->id);
         $comunicado->titulo = $request->titulo;
         $comunicado->descripcion = $request->descripcion;
         $comunicado->fecha = $request->fecha;
         $comunicado->atentamente = $request->atentamente;
         $comunicado->save();
     }

}
