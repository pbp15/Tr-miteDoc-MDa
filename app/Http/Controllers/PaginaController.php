<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
 
    
    public function inicio()
    {
       return view('pagina');
    }

    public function nivelinicial()
    {
       return view('vistas-paginaweb\nivel-inicial');
    }




}
