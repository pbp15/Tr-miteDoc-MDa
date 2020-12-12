<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar==''){
            $personas=User::join('personas', 'users.id','=','personas.id')
            ->select('personas.id');
        }
    }
}
