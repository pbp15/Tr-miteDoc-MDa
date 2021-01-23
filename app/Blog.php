<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable =[
        'idcategoria','titulo','fecha','imagen','descripcion'];

        public function categoria(){
            return $this->belongsTo('App\Categoria');
        }
}
