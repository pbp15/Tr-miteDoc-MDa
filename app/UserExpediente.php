<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExpediente extends Model
{
    protected $fillable = 
    [
        'iduser',
        'idexpediente',
        'idoficina',
        'estado',
        'fecha',
        'condicion'
    ];
}
