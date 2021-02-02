<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Expediente;
use App\UserExpediente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DB;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $expedientes = DB::table('expedientes as e')
                    ->join('user_expedientes as ue','e.id','=','ue.idexpediente')
                    ->join('users as u','u.id','=','ue.iduser')
                    ->join('personas as p','p.id','=','u.id')
                    ->select('e.codigo_expediente','p.nombre','e.cabecera_documento','e.tipo_documento','e.asunto','e.prioridad','e.nro_folios','e.file','ue.fecha','e.condicion')
                    ->orderBy('ue.id','desc')
                    ->paginate(10);
        
        return [
            'pagination' => [
                'total' => $expedientes->total(),
                'current_page' => $expedientes->currentPage(),
                'per_page' => $expedientes->perPage(),
                'last_page' => $expedientes->lastPage(),
                'from' => $expedientes->firstItem(),
                'to' => $expedientes->lastItem(),
            ],
            'expedientes' => $expedientes
        ];
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        /*Tabla expedientes*/
        $expedientes = new Expediente();

        //codigo de expediente
        $id = DB::table('expedientes as e')
            ->select(DB::raw('max(id) as id'))
            ->value('id');

        if ($id + 1  < 10) {
            $codigo = 'MDA00000'.($id+1);
        }elseif ($id + 1 < 100) {
            $codigo = 'MDA0000'.($id+1);
        }elseif ($id + 1 < 1000) {
            $codigo = 'MDA000'.($id+1);
        }elseif ($id + 1 < 10000) {
            $codigo = 'MDA00'.($id+1);
        }elseif ($id + 1 < 100000) {
            $codigo = 'MDA0'.($id+1);
        }else {
            $codigo = 'MDA'.($id+1);
        }

        $expedientes-> codigo_expediente = $codigo;
        $expedientes-> cabecera_documento = $request -> cabecera_documento;
        $expedientes-> tipo_documento = $request -> tipo_documento;
        $expedientes-> asunto = $request -> asunto;
        $expedientes-> prioridad = $request -> prioridad;
        $expedientes-> nro_folios = $request -> nro_folios;
        //Inicio expediente
        $exploded = explode(',', $request->file);
        $decoded = base64_decode($exploded[1]);
        if (Str::contains($exploded[0], 'pdf')) {
            $extension = 'pdf';
        } elseif(Str::contains($exploded[0], 'doc')) {
            $extension = 'doc';
        } else{
            $extension = 'rar';
        }
        $nombredoc = time().'.'.$extension;
        $path = public_path() . '/file/docs/' . $nombredoc;
        file_put_contents($path, $decoded);
        $expedientes-> file = $nombredoc;
        //fin expediente
        $mytime = Carbon::now();
        $expedientes-> fecha_tramite = $mytime;
        $expedientes-> condicion = '1';
        $expedientes-> save();

        /*Tabla intermedia usuario_expediente*/
        $userExpedientes = new UserExpediente();
        $userExpedientes-> iduser = auth()->user()->id;
        $userExpedientes-> idexpediente = $expedientes-> id;
        $userExpedientes-> idoficina = '1';
        $userExpedientes-> estado = 'Enviado';
        $userExpedientes-> fecha = $mytime;
        $userExpedientes-> save();

    }

    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $expedientes = Expediente::findOrFail($request->id);
        $expedientes-> codigo_expediente = $request -> codigo_expediente;
        $expedientes-> cabecera_documento = $request -> cabecera_documento;
        $expedientes-> tipo_documento = $request -> tipo_documento;
        $expedientes-> asunto = $request -> asunto;
        $expedientes-> prioridad = $request -> prioridad;
        $expedientes-> nro_folios = $request -> nro_folios;

        $currentFile = $expedientes->file;
        if ($request->file != $currentFile) {
            $exploded = explode(',', $request->file);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'pdf')) {

                $extension = 'pdf';
            } elseif(Str::contains($exploded[0], 'doc')) {

                $extension = 'doc';
            } else{
                $extension = 'rar';
            }

            $nombredoc = time() . '.' . $extension;

            $path = public_path() . '/file/docs/' . $nombredoc;

            file_put_contents($path, $decoded);

            //inicio eliminar del servidor
            $usuarioFile = public_path('/file/docs/') . $currentFile;
            if (file_exists($usuarioFile)) {
                @unlink($usuarioFile);
            }
            //fin eliminar del servidor
            $expedientes->file = $nombredoc;
        }

        
        $mytime = Carbon::now();
        $expedientes-> fecha_tramite = $mytime;
        $expedientes-> condicion = '1';
        $expedientes-> save();
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $expedientes = Expediente::findOrFail($request->id);
        $expedientes-> condicion = '0';
        $expedientes-> save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $expedientes = Expediente::findOrFail($request->id);
        $expedientes-> condicion = '1';
        $expedientes-> save();
    }

    public function id()
    {
        $id = DB::table('expedientes as e')
            ->select(DB::raw('max(id) as id'))
            ->value('id');

        return $id;
    }
}
