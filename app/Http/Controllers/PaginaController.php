<?php

namespace App\Http\Controllers;


class PaginaController extends Controller
{
 
    
    public function inicio()
    {
       return view('pagina');
    }

    

    //MENU DE QUIENES SOMOS
    public function bienvenida()
    {
       return view('vistas-paginaweb\quienes-somos\bienvenida');
    }

    public function historia()
    {
       return view('vistas-paginaweb\quienes-somos\historia');
    }

    public function visionmision()
    {
       return view('vistas-paginaweb\quienes-somos\vision-mision');
    }

   //MENU DE QUE OFRECEMOS
   public function propuesta()
   {
      return view('vistas-paginaweb\que-ofrecemos\propuesta');
   }

   public function metodologia()
   {
      return view('vistas-paginaweb\que-ofrecemos\metodologia');
   }

   public function niveles()
   {
      return view('vistas-paginaweb\que-ofrecemos\niveles');
   }

   public function servicios()
   {
      return view('vistas-paginaweb\que-ofrecemos\servicios');
   }


  

   //  SECCION COMUNIDAD

  public function eventos()
    {
       return view('vistas-paginaweb\comunidad\eventos');
    }

    public function testimonios()
    {
       return view('vistas-paginaweb\comunidad\testimonios');
    }

    public function noticias()
    {
       return view('vistas-paginaweb\comunidad\noticias');
    }


    public function blogs()
    {
       return view('vistas-paginaweb\comunidad\blogs');
    }

    // MENU ADMISION

  public function ficha()
    {
       return view('vistas-paginaweb\admision\ficha');
    }

    public function requisitos()
    {
       return view('vistas-paginaweb\admision\requisitos');
    }

    public function admision()
    {
       return view('vistas-paginaweb\admision\admision');
    }

    // MENU CONTACTANOS
    public function contactanos()
    {
       return view('vistas-paginaweb\contactanos\contactanos');
    }


}
