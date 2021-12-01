<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Genero;
use App\Models\GustoGenero;
use App\Models\Conjunto;
use App\Models\Diferencia;
use App\Models\Preferencia;
use App\Models\PersonaPreferencia;

class miControlador extends Controller
{
    public function crearRol(Request $val)
    {

        Rol::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    public function crearPreferencia(Request $val)
    {
        Preferencia::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    public function crearGenero(Request $val)
    {

        Genero::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    public function crearPersona(Request $val)
    {
        //return response($val);
        //correo , nombre, nick ,password , edad, ciudad, descripcion, tema, foto, activo, conectado, id_genero, quiereHijos,tipoRelaccion, hijosDeseados
        $correo = $val->get('correo');
        $id_rol=2;
        $passRepeat=$val->get('passRepeat');
        unset($val['passRepeat']);

        if($val->get('password')==$passRepeat){
            session()->put($correo,'personaRegistrandose');
            Persona::create(['correo'=>$val->get('correo'),'nombre'=>$val->get('nombre'),'nick'=>$val->get('nick'),'password'=>$val->get('password'),'edad'=>$val->get('edad'),'ciudad'=>$val->get('ciudad'),'descripcion'=>'','tema'=>'claro','foto'=>'./public/ImagenesPerfil','activo'=>'no','conectado'=>'no','id_genero'=>$val->get('id_genero'),'tieneHijos'=>0,'tipoRelaccion'=>'Ninguna','hijosDeseados'=>0]);
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

    public function crearFormularioPreferencias(Request $val){

        //$personaAfectada=session()->get('personaRegistrandose');
        $personaAfectada='Paco@gmail.com';
        //del 0 al 100
            $Deportivos=$val->get('deporte');
            $Artisticos=$val->get('arte');
            $Politicos=$val->get('politica');

            PersonaPreferencia::create(['correo'=>$personaAfectada,'id_preferencia'=>1,'intensidad'=>$Deportivos]);
            PersonaPreferencia::create(['correo'=>$personaAfectada,'id_preferencia'=>2,'intensidad'=>$Artisticos]);
            PersonaPreferencia::create(['correo'=>$personaAfectada,'id_preferencia'=>3,'intensidad'=>$Politicos]);


        //Otros Caracteres
            $tipoRelaccion=$val->get('tipoRelaccion');
            $tieneHijos=$val->get('numHijos');
            $quiereHijos=$val->get('quiereHijos');
            $interesDeGenero=$val->get('generoPreferido');
            $descripcion=$val->get('descripcion');


            $persona = Persona::find($personaAfectada);
            GustoGenero::created(['id'=>$interesDeGenero,'correo'=>$personaAfectada]);
            $persona->update(['descripcion'=>$descripcion,'tieneHijos'=>$tieneHijos,'tipoRelaccion'=>$tipoRelaccion,'hijosDeswados'=>$quiereHijos]);

            return response()->json($persona, 200);

    }

    public function mostrarCrudAdmin(){
        return Persona::all();
    }

}
