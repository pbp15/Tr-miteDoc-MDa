<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{

    protected $fillable = ['nombre','descripcion','condicion'];

    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }
}
