<?php

namespace App\Http\Controllers;

use App\Noticia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index(Request $request){
        // if (!$request->ajax()) return redirect('/');
     
         $buscar = $request->buscar;
         $criterio = $request->criterio;
         
         if ($buscar==''){
             $noticias = Noticia::orderBy('id', 'desc')->paginate(3);
         }
         else{
             $noticias = Noticia::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
         }
         
     
         return [
             'pagination' => [
                 'total'        => $noticias->total(),
                 'current_page' => $noticias->currentPage(),
                 'per_page'     => $noticias->perPage(),
                 'last_page'    => $noticias->lastPage(),
                 'from'         => $noticias->firstItem(),
                 'to'           => $noticias->lastItem(),
             ],
             'noticias' => $noticias
         ];
     }
     
     public function getDatos(){
         $noticias = Noticia::orderBy('id','asc')->get();
         return [ 'noticias' => $noticias];
     }
     
     public function store(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $noticia = new Noticia();
         $noticia->titulo = $request->titulo;
         $noticia->descripcion = $request->descripcion;
         $exploded = explode(',', $request->imagen);
         $decoded = base64_decode($exploded[1]);
     
             if (Str::contains($exploded[0], 'jpeg')) {
     
                 $extension = 'jpg';
             } else {
     
                 $extension = 'png';
             }
     
             $fileName = Str::random() . '.' . $extension;
     
             $path = public_path() . '/imagepage/noticias/' . $fileName;
     
             file_put_contents($path, $decoded);
     
             $noticia->imagen = $fileName;
             $noticia->fecha = $request->fecha;
             $noticia->save();
     }
     
     public function update(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $noticia = Noticia::findOrFail($request->id);
         $noticia->titulo = $request->titulo;
         $noticia->descripcion = $request->descripcion;
         $currentPhoto = $noticia->imagen;
         if ($request->imagen != $currentPhoto) {
     
             $exploded = explode(',', $request->imagen);
             $decoded = base64_decode($exploded[1]);
     
             if (Str::contains($exploded[0], 'jpeg')) {
     
                 $extension = 'jpg';
             } else {
     
                 $extension = 'png';
             }
     
             $fileName = Str::random() . '.' . $extension;
     
             $path = public_path() . '/imagepage/noticias/' . $fileName;
     
             file_put_contents($path, $decoded);
     
             /*inicio eliminar del servidor*/
             $usuarioImagen = public_path('/imagepage/noticias/') . $currentPhoto;
             if (file_exists($usuarioImagen)) {
                 @unlink($usuarioImagen);
             }
             /*fin eliminar del servidor*/
             $noticia->imagen = $fileName;
             $noticia->fecha = $request->fecha;
         }   
         $noticia->save();
     }
     
     public function destroy(Request $request){
         $noticia=Noticia::findOrFail($request->id);
         $noticia->delete();
     }
}
