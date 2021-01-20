<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $contactos = Contacto::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $contactos = Contacto::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        
    
        return [
            'pagination' => [
                'total'        => $contactos->total(),
                'current_page' => $contactos->currentPage(),
                'per_page'     => $contactos->perPage(),
                'last_page'    => $contactos->lastPage(),
                'from'         => $contactos->firstItem(),
                'to'           => $contactos->lastItem(),
            ],
            'contactos' => $contactos
        ];
    }

   

    
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $contacto = new Contacto();
        $contacto->apellidos = $request->apellidos;
        $contacto->nombres = $request->nombres;
        $contacto->email = $request->email;
        $contacto->telefono = $request->telefono;
        $contacto->asunto = $request->asunto;
        $contacto->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $contacto = Contacto::findOrFail($request->id);
        $contacto->apellidos = $request->apellidos;
        $contacto->nombres = $request->nombres;
        $contacto->email = $request->email;
        $contacto->telefono = $request->telefono;
        $contacto->asunto = $request->asunto;
        $contacto->save();
    }

}
