<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = ['idcategoria', 'apellidos','nombres','email', 'telefono' , 'asunto'];
}
