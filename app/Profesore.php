<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesore extends Model
{
    protected $fillable = ['nombres','curso_cargo','nivel','imagen'];
}
