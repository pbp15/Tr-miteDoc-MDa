<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $fillable = 
    [
        'nombre_oficina',
        'responsable',
        'condicion'
    ];
}
