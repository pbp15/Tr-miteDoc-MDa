<?php

namespace App\Http\Controllers;


use App\Persona;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    
    public function index(Request $request)
    {
        //esta peticion determina si la consulta que se ha hecho es diferente a  una peticion ajax
     //   if(!$request->ajax()) return redirect('/');
     // sin Modelo
     //   $personas = DB::table('personas')->paginate(15);
     ///con Modelo
     $personas = Persona::paginate(15);
        return [
            'pagination' => [
                'total'         => $personas->total(),
                'current_page'  => $personas->currentPage(),
                'per_page'      => $personas->perPage(),
                'last_page'     => $personas->lastPage(),
                'from'          => $personas->firstItem(),
                'to'            => $personas->lastItem(),
            ],
            'persona'  =>$personas
        ];
    }
    
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $persona =  new Persona();
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->save();


    }

 
    public function update(Request $request)
    {
        //buscar la persona que se encuentra registradas en la
        //base de datos mediante el id (request->id) que se esta recibiendo
        // del formulario
        if(!$request->ajax()) return redirect('/');
        $persona =  Persona::findOrFail($request->id);
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->save();

    }


}
