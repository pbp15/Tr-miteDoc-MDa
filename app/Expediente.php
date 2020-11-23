<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $fillable = 
    [
        'codigo_expediente',
        'cabecera_documento',
        'tipo_documento',
        'asunto',
        'prioridad',
        'nro_folios',
        'file',
        'fecha_tramite',
    ];
}
