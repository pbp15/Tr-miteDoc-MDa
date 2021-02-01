<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\UserExpediente;
use App\Expediente;
use Carbon\Carbon;
use App\Persona;
use App\User;

class UserExpedienteController extends Controller
{
    public function registrar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        /*Tabla expedientes*/
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

        /*Tabla intermedia usuario_expediente*/
        $userExpedientes = new UserExpediente();
        //obtenre id usuario
        $idUser = auth()->user()->id; 
        $userExpedientes-> iduser = $iduser;
        /*obtener id expediente
        $idexpediente = 
        $userExpedientes-> idexpediente*/
        $userExpedientes-> idoficina = '1';
        $userExpedientes-> estado = 'Enviado';
        $userExpedientes-> fecha = $mytime;
        $userExpedientes-> condicion = '1';
    }
}
