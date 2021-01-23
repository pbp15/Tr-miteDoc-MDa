<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request){
        // if (!$request->ajax()) return redirect('/');
     
         $buscar = $request->buscar;
         $criterio = $request->criterio;
         
         if ($buscar==''){
            $blogs = Blog::join('categorias','blogs.idcategoria','=','categorias.id')
            ->select('blogs.id','blogs.idcategoria','blogs.titulo','blogs.imagen','categorias.nombre as nombre_categoria','blogs.fecha','blogs.descripcion')
            ->orderBy('blogs.id', 'desc')->paginate(3);
         }
         else{
            $blogs = Blog::join('categorias','blogs.idcategoria','=','categorias.id')
            ->select('blogs.id','blogs.idcategoria','blogs.titulo','blogs.imagen','categorias.nombre as nombre_categoria','blogs.fecha','blogs.descripcion')
            ->where('blogs.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('blogs.id', 'desc')->paginate(3);           
       
         }
         
     
         return [
             'pagination' => [
                 'total'        => $blogs->total(),
                 'current_page' => $blogs->currentPage(),
                 'per_page'     => $blogs->perPage(),
                 'last_page'    => $blogs->lastPage(),
                 'from'         => $blogs->firstItem(),
                 'to'           => $blogs->lastItem(),
             ],
             'blogs' => $blogs
         ];
     }
     
     public function getDatos(){
         $blogs = Blog::orderBy('id','asc')->get();
         return [ 'blogs' => $blogs];
     }
     
     public function store(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $blog = new Blog();
         $blog->idcategoria = $request->idcategoria;
         $blog->titulo = $request->titulo;
         $blog->descripcion = $request->descripcion;
         $exploded = explode(',', $request->imagen);
         $decoded = base64_decode($exploded[1]);
     
             if (Str::contains($exploded[0], 'jpeg')) {
     
                 $extension = 'jpg';
             } else {
     
                 $extension = 'png';
             }
     
             $fileName = Str::random() . '.' . $extension;
     
             $path = public_path() . '/imagepage/blogs/' . $fileName;
     
             file_put_contents($path, $decoded);
     
             $blog->imagen = $fileName;
             $blog->fecha = $request->fecha;
             $blog->save();
     }
     
     public function update(Request $request)
     {
         if (!$request->ajax()) return redirect('/');
         $blog = Blog::findOrFail($request->id);
         $blog->idcategoria = $request->idcategoria;
         $blog->titulo = $request->titulo;
         $blog->descripcion = $request->descripcion;
         $currentPhoto = $blog->imagen;
         if ($request->imagen != $currentPhoto) {
     
             $exploded = explode(',', $request->imagen);
             $decoded = base64_decode($exploded[1]);
     
             if (Str::contains($exploded[0], 'jpeg')) {
     
                 $extension = 'jpg';
             } else {
     
                 $extension = 'png';
             }
     
             $fileName = Str::random() . '.' . $extension;
     
             $path = public_path() . '/imagepage/blogs/' . $fileName;
     
             file_put_contents($path, $decoded);
     
             /*inicio eliminar del servidor*/
             $usuarioImagen = public_path('/imagepage/blogs/') . $currentPhoto;
             if (file_exists($usuarioImagen)) {
                 @unlink($usuarioImagen);
             }
             /*fin eliminar del servidor*/
             $blog->imagen = $fileName;
             $blog->fecha = $request->fecha;
         }   
         $blog->save();
     }
     
     public function destroy(Request $request){
         $blog=Blog::findOrFail($request->id);
         $blog->delete();
     }
}
