<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Genero;
use App\Models\Conjunto;

class miControlador extends Controller
{
    public function crearRol(Request $val)
    {

        Rol::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    public function crearGenero(Request $val)
    {

        Genero::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    public function crearPersona(Request $val)
    {
        $correo = $val->get('correo');
        $id_rol=2;
        $passRepeat=$val->get('passRepeat');
        unset($val['passRepeat']);

        if($val->get('password')==$passRepeat){
            Persona::create($val->all());
            Conjunto::create(['correo'=>$correo,'id_rol'=>$id_rol]);

            return response()->json(['code' => 201, 'message' => 'Datos insertados']);
        }else{
            return response()->json(['code' => 401, 'message' => 'Las contraseñas son distintas']);
        }

    }


    public function login(Request $val)
    {
        $correo=$val->get('correo');
        $password=$val->get('password');
        $persona = Persona::find(['correo'=>$correo,'password'=>$password]);

        if($persona!=null){
            session()->put('persona',$persona);
            return response()->json(['code' => 201, 'message' => 'Datos encontrados']);
        }else{
            return response()->json(['code' => 401, 'message' => 'Login incorrecto']);
        }
    }

    public function passOlvidada(Request $val)
    {
        $correo=$val->get('correo');
        $persona = Persona::find($correo);

        if($persona!=null){
            return response()->json(['code' => 201, 'message' => 'Datos encontrados']);
        }else{
            return response()->json(['code' => 401, 'message' => 'correo no registrado']);
        }
    }
}
