<?php

namespace App\Http\Controllers;

use Mail;
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
        $id_rol = 2;
        $passRepeat = $val->get('passRepeat');
        $diferencia = 0;
        unset($val['passRepeat']);

        if ($val->get('password') == $passRepeat) {
            session()->put($correo, 'personaRegistrandose');
            Persona::create(['correo' => $val->get('correo'), 'nombre' => $val->get('nombre'), 'nick' => $val->get('nick'), 'password' => $val->get('password'), 'edad' => $val->get('edad'), 'ciudad' => $val->get('ciudad'), 'descripcion' => '', 'tema' => 'claro', 'foto' => './public/ImagenesPerfil', 'activo' => 'no', 'conectado' => 'no', 'id_genero' => $val->get('id_genero'), 'tieneHijos' => 0, 'tipoRelaccion' => 'Ninguna', 'hijosDeseados' => 0]);
            Conjunto::create(['correo' => $correo, 'id_rol' => $id_rol]);
            return response()->json(['code' => 201, 'message' => 'Datos insertados']);
        } else {
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
        $correo = $val->get('correo');
        $password = $val->get('password');
        $persona=Persona::where('correo','=',$correo)->where('password','=',$password)->first();
        $conectado = 'si';

        if ($persona) {

            session()->put('persona', $persona);

            Persona::where('correo', $correo)
                ->update(['conectado' => $conectado]);

            return response()->json(['code' => 201, 'message' => 'Datos encontrados']);
        } else {
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
        $correo = $val->get('correo');
        $persona = Persona::find($correo);

        $datos = [
            'correo' => $correo
        ];

        if ($persona != null) {

            /*Mail::send('welcome', $datos, function($message) use ($correo)
            {
                $message->to($correo)->subject('Envio');
                $message->from('AuxiliarDAW2@gmail.com', 'Envio');
            });*/
            return response()->json(['code' => 201, 'message' => 'Datos encontrados']);
        } else {
            return response()->json(['code' => 401, 'message' => 'correo no registrado']);
        }
    }

    /**
     * Permite añadir a una base de datos las preferencias del nuevo usuario y editar alguna
     * informacion del usuario nuevo con sus preferencias
     */

    public function crearFormularioPreferencias(Request $val)
    {

        //$personaAfectada=session()->get('personaRegistrandose');
        $personaAfectada = 'Esther@gmail.com';

        //del 0 al 100
        $Deportivos = $val->get('deporte');
        $Artisticos = $val->get('arte');
        $Politicos = $val->get('politica');

        PersonaPreferencia::create(['correo' => $personaAfectada, 'id_preferencia' => 1, 'intensidad' => $Deportivos]);
        PersonaPreferencia::create(['correo' => $personaAfectada, 'id_preferencia' => 2, 'intensidad' => $Artisticos]);
        PersonaPreferencia::create(['correo' => $personaAfectada, 'id_preferencia' => 3, 'intensidad' => $Politicos]);


        //Otros Caracteres
        $tipoRelaccion = $val->get('tipoRelaccion');
        $tieneHijos = $val->get('numHijos');
        $quiereHijos = $val->get('quiereHijos');
        $interesDeGenero = $val->get('generoPreferido');
        $descripcion = $val->get('descripcion');


        $persona = Persona::find($personaAfectada);
        GustoGenero::create(['id' => $interesDeGenero, 'correo' => $personaAfectada]);
        $persona->update(['descripcion' => $descripcion, 'tieneHijos' => $tieneHijos, 'tipoRelaccion' => $tipoRelaccion, 'hijosDeseados' => $quiereHijos]);


        //Solo pillo a las personas que por genero le molan a la persona que se esta
        //creando excepto la que se esta creando
        $personas = '';
        $diferencia = 0;

        if ($interesDeGenero == 1 || $interesDeGenero == 2) {
            $personas = Persona::where('id_genero', $interesDeGenero)->get();
            $personas = $personas->except(['correo' => $personaAfectada]);
        } else {
            $personas = Persona::all();
            $personas = $personas->except(['correo' => $personaAfectada]);
        }

        //Recorro a las personas de la BBDD excepto a la que ha rellenado el formulario
        foreach ($personas as $per) {
            //Miro sus preferencias y las comparo con la persona que rellena el formulario
            foreach (PersonaPreferencia::where('correo', '=', $per->correo)->get() as $preferencia) {
                //Gustos Deporte
                if ($preferencia->id_preferencia == 1) {
                    if ($Deportivos > $preferencia->intensidad) {
                        $diferencia = $diferencia + $Deportivos - $preferencia->intensidad;
                    } else {
                        $diferencia = $diferencia + $preferencia->intensidad - $Deportivos;
                    }
                }

                //Gustos Arte
                if ($preferencia->id_preferencia == 2) {
                    if ($Artisticos > $preferencia->intensidad) {
                        $diferencia = $diferencia + $Artisticos - $preferencia->intensidad;
                    } else {
                        $diferencia = $diferencia + $preferencia->intensidad - $Artisticos;
                    }
                }

                //Gustos Politica
                if ($preferencia->id_preferencia == 3) {
                    if ($Politicos > $preferencia->intensidad) {
                        $diferencia = $diferencia + $Politicos - $preferencia->intensidad;
                    } else {
                        $diferencia = $diferencia + $preferencia->intensidad - $Politicos;
                    }
                }
            }

            //Tipo de relaccion. vale x100

            if ($tipoRelaccion == $per->tipoRelaccion) {
                $diferencia = $diferencia + 100;
            } else {
                $diferencia = $diferencia - 100;
            }


            //Hijos
            //Si la persona registrandose tiene hijos y la otra persona los quiere +100
            //Si es al reves +100
            if ($tieneHijos == 1 && $per->hijosDeseados > 0 || $per->tieneHijos == 1 && $quiereHijos) {
                $diferencia = $diferencia + 100;
            } else {
                //SI la persona registrandose no quiere hijos y la otra tampoco +100
                if ($quiereHijos == 0 && $per->hijosDeseados == 0) {
                    $diferencia = $diferencia + 100;
                } else {
                    //Si la persona registrandose quiere hijos y la otra tambien
                    if ($quiereHijos == 1 && $per->hijosDeseados > 0) {
                        $diferencia = $diferencia + 100;
                    } else {
                        //Si la persona registrada tiene hijos pero no quiere mas y la otra persona no tiene pero si quiere o viceversa +100
                        if ($tieneHijos == 1 && $quiereHijos == 0 && $per->tieneHijos == 0 && $per->hijosDeseados > 0 || $tieneHijos == 0 && $quiereHijos > 0 && $per->tieneHijos == 1 && $per->hijosDeseados == 0) {
                            $diferencia = $diferencia + 100;
                        } else {
                            $diferencia = $diferencia - 100;
                        }
                    }
                }
            }

            //Genero-> Como yo ya filtre por gusto de genero mas arriba, me aseguro de que si o si se gustan por lo tanto, no lo voy a contabilizar
            //Añado todo a la tabla Diferencia
            Diferencia::create(['correo1' => $personaAfectada, 'correo2' => $per->correo, 'diferencia' => $diferencia]);
        }
        return response()->json($persona, 200);
    }


    /**
     * Permite mostrar todos los usuarios de la base de datos
     *
     * @return void
     */
    public function mostrarCrudAdmin()
    {
        return Persona::all();
    }



    public function mostrarPreferencias()
    {
        $personaLogeada = session()->get('personaRegistrandose');

        return Diferencia::orderBy('diferencia', 'ASC')->where(['correo1' => $personaLogeada])->get();
    }


    public function verMiPerfil()
    {
        $persona = session()->get('persona');

        return $persona;
    }


    public function modificarMiPerfil(Request $val)
    {
        $password1 = $val->get('password1');
        $password2 = $val->get('password2');

        if ($password1 == $password2) {
            //$personaAntigua = session()->get('persona');
            //$correoAntiguo = $personaAntigua->correo;
            $correoAntiguo='Lola@gmail.com';
            $correo = $val->get('correo');
            $nick = $val->get('nick');
            $nombre = $val->get('nombre');
            $descripcion = $val->get('descripcion');
            $ciudad = $val->get('ciudad');

            Persona::where('correo',$correoAntiguo)->update(['correo'=>$correo,'nick'=>$nick,'nombre'=>$nombre,'descripcion'=>$descripcion,'ciudad'=>$ciudad]);
        } else {
            return response()->json(['code' => 401, 'message' => 'Las contraseñas son distintas']);
        }
    }

    public function borrarMiCuenta(Request $val){
        $correo=$val->get('correo');
        $persona = Persona::find($correo);
        $persona->delete();
    }

}
