<?php

namespace App\Http\Controllers;

use App\Testimonio;
use Illuminate\Http\Request;

class TestimonioController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $testimonios = Testimonio::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $testimonios = Testimonio::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
        

        return [
            'pagination' => [
                'total'        => $testimonios->total(),
                'current_page' => $testimonios->currentPage(),
                'per_page'     => $testimonios->perPage(),
                'last_page'    => $testimonios->lastPage(),
                'from'         => $testimonios->firstItem(),
                'to'           => $testimonios->lastItem(),
            ],
            'testimonios' => $testimonios
        ];
    }


    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = new Testimonio();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->imagen = $request->imagen;
        $categoria->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Testimonio::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->imagen = $request->imagen;
        $categoria->save();
    }

}


