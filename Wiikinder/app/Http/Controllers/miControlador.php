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
    /**
     * Permite crear un rol nuevo
     *
     * @param Request $val
     * @return void
     */
    public function crearRol(Request $val)
    {

        Rol::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    /**
     * Permite crear una preferencia
     *
     * @param Request $val
     * @return void
     */
    public function crearPreferencia(Request $val)
    {
        Preferencia::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    /**
     * Permite crear un genero
     *
     * @param Request $val
     * @return void
     */
    public function crearGenero(Request $val)
    {

        Genero::create($val->all());

        return response()->json(['code' => 201, 'message' => 'Datos insertados']);
    }

    /**
     * Permite crear una persona y añadirla a un conjunto junto a su rol
     *
     * @param Request $val
     * @return void
     */
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


    /**
     * Permite logearse a una persona
     *
     * @param Request $val
     * @return void
     */
    public function login(Request $val)
    {
        $correo=$val->get('correo');
        $password=$val->get('password');
        $persona = Persona::find(['correo'=>$correo,'password'=>$password]);
        $conectado='si';

        if($persona!=null){
            session()->put('persona',$persona);

            Persona::where('correo', $correo)
            ->update(['conectado' => $conectado]);

            return response()->json(['code' => 201, 'message' => 'Datos encontrados']);
        }else{
            return response()->json(['code' => 401, 'message' => 'Login incorrecto']);
        }
    }

    /**
     * Permite comprobar si un correo existe en la base de datos, despues enviar
     * un email a la persona con su nueva contraseña
     *
     * @param Request $val
     * @return void
     */
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

    /**
     * Permite añadir a una base de datos las preferencias del nuevo usuario y editar alguna
     * informacion del usuario nuevo con sus preferencias
     */

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
            GustoGenero::create(['id'=>$interesDeGenero,'correo'=>$personaAfectada]);
            $persona->update(['descripcion'=>$descripcion,'tieneHijos'=>$tieneHijos,'tipoRelaccion'=>$tipoRelaccion,'hijosDeseados'=>$quiereHijos]);

            return response()->json($persona, 200);

    }

    /**
     * Permite mostrar todos los usuarios de la base de datos
     *
     * @return void
     */
    public function mostrarCrudAdmin(){
        return Persona::all();
    }

}
