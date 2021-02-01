<?php

namespace App\Http\Controllers;

use App\Profesore;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProfesoreController extends Controller
{
    public function index(Request $request){
        // if (!$request->ajax()) return redirect('/');
     
         $buscar = $request->buscar;
         $criterio = $request->criterio;
         
         if ($buscar==''){
             $profesores = Profesore::orderBy('id', 'desc')->paginate(3);
         }
         else{
             $profesores = Profesore::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
         }
         
     
         return [
             'pagination' => [
                 'total'        => $profesores->total(),
                 'current_page' => $profesores->currentPage(),
                 'per_page'     => $profesores->perPage(),
                 'last_page'    => $profesores->lastPage(),
                 'from'         => $profesores->firstItem(),
                 'to'           => $profesores->lastItem(),
             ],
             'profesores' => $profesores
         ];
     }
  

  
     public function store(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $profesore = new Profesore();
         $profesore->nombres = $request->nombres;
         $profesore->curso_cargo = $request->curso_cargo;
         $profesore->nivel = $request->nivel;
         $exploded = explode(',', $request->imagen);
         $decoded = base64_decode($exploded[1]);
     
             if (Str::contains($exploded[0], 'jpeg')) {
     
                 $extension = 'jpg';
             } else {
     
                 $extension = 'png';
             }
     
             $fileName = Str::random() . '.' . $extension;
     
             $path = public_path() . '/imagepage/profesores/' . $fileName;
     
             file_put_contents($path, $decoded);
     
             $profesore->imagen = $fileName;
             $profesore->save();
     }
     
     public function update(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $profesore = Profesore::findOrFail($request->id);
         $profesore->nombres = $request->nombres;
         $profesore->curso_cargo = $request->curso_cargo;
         $profesore->nivel = $request->nivel;
         $currentPhoto = $profesore->imagen;
         if ($request->imagen != $currentPhoto) {
     
             $exploded = explode(',', $request->imagen);
             $decoded = base64_decode($exploded[1]);
     
             if (Str::contains($exploded[0], 'jpeg')) {
     
                 $extension = 'jpg';
             } else {
     
                 $extension = 'png';
             }
     
             $fileName = Str::random() . '.' . $extension;
     
             $path = public_path() . '/imagepage/profesores/' . $fileName;
     
             file_put_contents($path, $decoded);
     
             /*inicio eliminar del servidor*/
             $usuarioImagen = public_path('/imagepage/profesores/') . $currentPhoto;
             if (file_exists($usuarioImagen)) {
                 @unlink($usuarioImagen);
             }
             /*fin eliminar del servidor*/
             $profesore->imagen = $fileName;
         }   
         $profesore->save();
     }

     public function getDatosInicial(Request $request){

        if (!$request->ajax()) return redirect('/');
         $profesores = Profesore::where('profesores.nivel','inicial')
        ->orderBy('id','asc')->get();
         return [ 'profesores' => $profesores];       
     }
      
 
     public function getDatosPrimaria(Request $request){
 
         //  if (!$request->ajax()) return redirect('/');
           $profesores = Profesore::where('profesores.nivel','primaria')
          ->orderBy('id','asc')->get();
           return [ 'profesores' => $profesores];       
       }
 
 
       public function getDatosSecundaria(Request $request){
 
         //  if (!$request->ajax()) return redirect('/');
           $profesores = Profesore::where('profesores.nivel','secundaria')
          ->orderBy('id','asc')->get();
           return [ 'profesores' => $profesores];       
       }
 
     
     public function destroy(Request $request){
         $profesore=Profesore::findOrFail($request->id);
         $profesore->delete();
     }
}
