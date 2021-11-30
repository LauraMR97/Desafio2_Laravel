<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Genero;
class miControlador extends Controller
{
    public function crearRol(Request $val){

       Rol::create($val->all());

        return response()->json(['code'=>201,'message'=>'Datos insertados']);
    }

    public function crearGenero(Request $val){

        Genero::create($val->all());

         return response()->json(['code'=>201,'message'=>'Datos insertados']);
     }

}
