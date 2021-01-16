<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = ['idcategoria', 'apellidos','nombres','email', 'telefono' , 'asunto'];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
