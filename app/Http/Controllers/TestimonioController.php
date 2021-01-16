<?php

namespace App\Http\Controllers;

use App\Testimonio;
use Illuminate\Support\Str;
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
    public function getDatos(){
        $testimonios = Testimonio::orderBy('id','asc')->get();
        return [ 'testimonios' => $testimonios];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $testimonio = new Testimonio();
        $testimonio->nombre = $request->nombre;
        $testimonio->descripcion = $request->descripcion;
        $exploded = explode(',', $request->imagen);
        $decoded = base64_decode($exploded[1]);
    
            if (Str::contains($exploded[0], 'jpeg')) {
    
                $extension = 'jpg';
            } else {
    
                $extension = 'png';
            }
    
            $fileName = Str::random() . '.' . $extension;
    
            $path = public_path() . '/imagepage/testimonios/' . $fileName;
    
            file_put_contents($path, $decoded);
    
            $testimonio->imagen = $fileName;
            $testimonio->save();
    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $testimonio = Testimonio::findOrFail($request->id);
        $testimonio->nombre = $request->nombre;
        $testimonio->descripcion = $request->descripcion;
        $currentPhoto = $testimonio->imagen;
        if ($request->imagen != $currentPhoto) {
    
            $exploded = explode(',', $request->imagen);
            $decoded = base64_decode($exploded[1]);
    
            if (Str::contains($exploded[0], 'jpeg')) {
    
                $extension = 'jpg';
            } else {
    
                $extension = 'png';
            }
    
            $fileName = Str::random() . '.' . $extension;
    
            $path = public_path() . '/imagepage/testimonios/' . $fileName;
    
            file_put_contents($path, $decoded);
    
            /*inicio eliminar del servidor*/
            $usuarioImagen = public_path('/imagepage/testimonios/') . $currentPhoto;
            if (file_exists($usuarioImagen)) {
                @unlink($usuarioImagen);
            }
            /*fin eliminar del servidor*/
            $testimonio->imagen = $fileName;
        }
        $testimonio->save();
    }

    public function destroy(Request $request){
        $testimonio=Testimonio::findOrFail($request->id);
        $testimonio->delete();
    }
    



}


