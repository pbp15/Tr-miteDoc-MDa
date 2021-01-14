<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunicado extends Model
{
    protected $fillable = ['titulo','descripcion','fecha'];
}
