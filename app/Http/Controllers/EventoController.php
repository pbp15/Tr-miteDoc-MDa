<?php

namespace App\Http\Controllers;

use App\Evento;
use Illuminate\Support\Str;
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

public function getDatos(){
    $eventos = Evento::orderBy('id','asc')->get();
    return [ 'eventos' => $eventos];
}

public function store(Request $request)
{
    if (!$request->ajax()) return redirect('/');
    $evento = new Evento();
    $evento->titulo = $request->titulo;
    $evento->descripcion = $request->descripcion;
    $exploded = explode(',', $request->imagen);
    $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {

            $extension = 'jpg';
        } else {

            $extension = 'png';
        }

        $fileName = Str::random() . '.' . $extension;

        $path = public_path() . '/imagepage/eventos/' . $fileName;

        file_put_contents($path, $decoded);

        $evento->imagen = $fileName;
        $evento->save();


    $evento->imagen = $fileName;
    $evento->save();
}

public function update(Request $request)
{
    if (!$request->ajax()) return redirect('/');
    $evento = Evento::findOrFail($request->id);
    $evento->titulo = $request->titulo;
    $evento->descripcion = $request->descripcion;
    $currentPhoto = $evento->imagen;
    if ($request->imagen != $currentPhoto) {

        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {

            $extension = 'jpg';
        } else {

            $extension = 'png';
        }

        $fileName = Str::random() . '.' . $extension;

        $path = public_path() . '/imagepage/eventos/' . $fileName;

        file_put_contents($path, $decoded);

        /*inicio eliminar del servidor*/
        $usuarioImagen = public_path('/imagepage/eventos/') . $currentPhoto;
        if (file_exists($usuarioImagen)) {
            @unlink($usuarioImagen);
        }
        /*fin eliminar del servidor*/
        $evento->imagen = $fileName;
    }
    $evento->save();
}

public function destroy(Request $request){
    $evento=Evento::findOrFail($request->id);
    $evento->delete();
}

}
