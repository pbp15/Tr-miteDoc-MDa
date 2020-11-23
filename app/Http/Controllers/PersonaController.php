<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Persona;

class PersonaController extends Controller
{
    
    public function index()
    {
        $personas =  Persona::all();
        return $personas;
    }

    
    public function store(Request $request)
    {
        $persona =  new Persona();
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->usuario = $request->usuario;
        $persona->password = $request->password;
        $persona->idrol = $request->idrol;
        $persona->save();


    }

 
    public function update(Request $request)
    {
        $persona =  Persona::findOrFail($request->id);
        $persona->nombre = $request->nombre;
        $persona->tipo_documento = $request->tipo_documento;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->usuario = $request->usuario;
        $persona->password = $request->password;
        $persona->idrol = $request->idrol;
        $persona->save();

    }


}
