<?php

namespace App\Http\Controllers;

use App\Expediente;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //if (!$request->ajax()) return redirect('/');
        $expedientes = Expediente::paginate(5);
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
        $expedientes = new Expediente();
        $expedientes-> codigo_expediente = $request -> codigo_expediente;
        $expedientes-> cabecera_documento = $request -> cabecera_documento;
        $expedientes-> tipo_documento = $request -> tipo_documento;
        $expedientes-> asunto = $request -> asunto;
        $expedientes-> prioridad = $request -> prioridad;
        $expedientes-> nro_folios = $request -> nro_folios;
        $expedientes-> file = $request -> file;
        $mytime = Carbon::now();
        $expedientes-> fecha_tramite = $mytime;
        $expedientes-> condicion = '1';
        $expedientes-> save();
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
        $expedientes-> file = $request -> file;
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

    //Extras
    public function documento(Request $request)
    {
        $documento = $request->file('file');
        $nombredoc = time().'.'.$documento->extension();
        $documento->move(public_path('storage/documentos'), $nombredoc);

        return response()->json(['correcto'=> $nombredoc]);
    }

}
