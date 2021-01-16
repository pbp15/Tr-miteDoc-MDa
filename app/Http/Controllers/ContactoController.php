<?php

namespace App\Http\Controllers;

use App\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $contactos = Contacto::join('categorias','contactos.idcategoria','=','categorias.id')
            ->select('contactos.id','contactos.idcategoria','categorias.nombre as nombre_categoria', 'contactos.apellidos','contactos.nombres','contactos.email','contactos.telefono','contactos.asunto')
            ->orderBy('contactos.id', 'desc')->paginate(3);
        }
        else{
            $contactos = Contacto::join('categorias','contactos.idcategoria','=','categorias.id')
            ->select('contactos.id','contactos.idcategoria', 'categorias.nombre as nombre_categoria' , 'contactos.apellidos','contactos.nombres','contactos.email','contactos.telefono','contactos.asunto')
            ->where('contactos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('contactos.id', 'desc')->paginate(3);
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
        $contacto->idcategoria = $request->idcategoria;
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
        $contacto->idcategoria = $request->idcategoria;
        $contacto->apellidos = $request->apellidos;
        $contacto->nombres = $request->nombres;
        $contacto->email = $request->email;
        $contacto->telefono = $request->telefono;
        $contacto->asunto = $request->asunto;
        $contacto->save();
    }

}
