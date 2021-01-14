<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $fillable = ['nombre','nivel','codigo_modular', 'imagen'];
}
