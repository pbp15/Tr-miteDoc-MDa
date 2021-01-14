<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
 //protected $table = 'categorias';
    //protected $primaryKey = 'id';
    protected $fillable = ['nombre','descripcion','condicion'];

    public function contactos()
    {
        return $this->hasMany('App\Contacto');
    }
}
