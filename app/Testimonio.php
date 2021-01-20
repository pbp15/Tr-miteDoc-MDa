<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model
{
    protected $fillable = ['nombre','universidad','descripcion','imagen'];
}
