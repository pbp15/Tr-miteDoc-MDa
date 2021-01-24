<?php

namespace App\Http\Controllers;


class PaginaController extends Controller
{
 
    
    public function inicio()
    {
       return view('pagina');
    }

    public function nivelinicial()
    {
       return view('vistas-paginaweb\niveles\nivel-inicial');
    }

    public function nosotros()
    {
       return view('vistas-paginaweb\nosotros\nosotros');
    }




}
