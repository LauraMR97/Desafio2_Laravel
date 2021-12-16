<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Persona;
use App\Models\Genero;
use App\Models\GustoGenero;
use App\Models\Conjunto;
use App\Models\Diferencia;
use App\Models\Preferencia;
use App\Models\Peticion;
use App\Models\PersonaPreferencia;
use App\Models\Amigo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PreferenciasPersona;

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


        return response()->json([
            'message' => 'Rol creado'
        ], 201);
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

        return response()->json([
            'message' => 'Preferencia creada'
        ], 201);
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

        return response()->json([
            'message' => 'Genero creado'
        ], 201);
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
        unset($val['passRepeat']);

        if ($val->get('password') == $passRepeat) {
            Persona::create(['correo' => $val->get('correo'), 'nombre' => $val->get('nombre'), 'nick' => $val->get('nick'), 'password' => $val->get('password'), 'edad' => $val->get('edad'), 'ciudad' => $val->get('ciudad'), 'descripcion' => '', 'tema' => 'claro', 'foto' => './public/ImagenesPerfil', 'activo' => 'no', 'conectado' => 'no', 'id_genero' => $val->get('id_genero'), 'tieneHijos' => 0, 'tipoRelaccion' => 'Ninguna', 'hijosDeseados' => 0]);
            Conjunto::create(['correo' => $correo, 'id_rol' => $id_rol]);

            return response()->json([
                'message' => 'Datos insertados'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Las contraseñas son distintas'
            ], 401);
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
        $persona = Persona::where('correo', '=', $correo)->where('password', '=', $password)->first();
        $conectado = 'si';
        $r = '';
        $p='';
        $activo='';


        if ($persona) {
            foreach (Conjunto::where('correo', '=', $correo)->get() as $r) {
                $rol = $r->id_rol;
            }
           foreach(Persona::where('correo', '=', $correo)->get() as $p){
                $tema=$p->tema;
                $activo = $p->activo;
            }

            if($activo=='si'){
            Persona::where('correo', $correo)
                ->update(['conectado' => $conectado]);

            return response()->json([
                'message' => 'Datos encontrados',
                'rol' => $rol,
                'tema'=>$tema
            ], 201);
        }else{
            return response()->json([
                'message' => 'Persona no activa'
            ], 401);
        }
        } else {
            return response()->json([
                'message' => 'Datos no encontrados'
            ], 401);
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
        $correoAux = $persona->correo;

        if ($persona != null) {

            //Con esto genero una contraseña nueva y aleatoria
            $nuevaPass = Str::random(10);
            Persona::where('correo', $correoAux)->update(['password' => $nuevaPass]);

            $datos = [
                'correo' => $correoAux,
                'passwordNew' => $nuevaPass
            ];

            Mail::send('newPass', $datos, function ($message) use ($correoAux) {
                $message->to($correoAux)->subject('Wiikinder');
                $message->from('auxiliardaw2@gmail.com', 'Tu contraseña ha sido modificada');
            });

            return response()->json([
                'message' => 'Datos encontrados'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Correo no registrado'
            ], 401);
        }
    }

    /**
     * Permite añadir a una base de datos las preferencias del nuevo usuario, compararlas con el
     * resto de usuarios y añadir a esa persona junto a cada una de las personas de la base de datos
     * con su indice de diferencia.
     */

    public function crearFormularioPreferencias(Request $val)
    {

        $personaAfectada = $val->get('correo');

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

        self::calcularPreferencias($interesDeGenero,$personaAfectada,$Deportivos,$Artisticos,$Politicos,$tipoRelaccion,$quiereHijos,$tieneHijos);
        return response()->json($persona, 200);
    }
/**
 * Esta funcion me permite calcular las diferencias entre usuarios y añadirlos a una base de datos
 *
 * @param [integer] $interesDeGenero
 * @param [string] $personaAfectada
 * @param [integer] $Deportivos
 * @param [integer] $Artisticos
 * @param [integer] $Politicos
 * @param [string] $tipoRelaccion
 * @param [integer] $quiereHijos
 * @param [integer] $tieneHijos
 * @return void
 */
    public static function calcularPreferencias($interesDeGenero,$personaAfectada,$Deportivos,$Artisticos,$Politicos,$tipoRelaccion,$quiereHijos,$tieneHijos){
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
                $diferencia = $diferencia - 100;
            } else {
                $diferencia = $diferencia + 100;
            }


            //Hijos
            //Si la persona registrandose tiene hijos y la otra persona los quiere -100
            //Si es al reves -100
            if ($tieneHijos == 1 && $per->hijosDeseados > 0 || $per->tieneHijos == 1 && $quiereHijos) {
                $diferencia = $diferencia - 100;
            } else {
                //SI la persona registrandose no quiere hijos y la otra tampoco -100
                if ($quiereHijos == 0 && $per->hijosDeseados == 0) {
                    $diferencia = $diferencia - 100;
                } else {
                    //Si la persona registrandose quiere hijos y la otra tambien
                    if ($quiereHijos == 1 && $per->hijosDeseados > 0) {
                        $diferencia = $diferencia - 100;
                    } else {
                        //Si la persona registrada tiene hijos pero no quiere mas y la otra persona no tiene pero si quiere o viceversa -100
                        if ($tieneHijos == 1 && $quiereHijos == 0 && $per->tieneHijos == 0 && $per->hijosDeseados > 0 || $tieneHijos == 0 && $quiereHijos > 0 && $per->tieneHijos == 1 && $per->hijosDeseados == 0) {
                            $diferencia = $diferencia - 100;
                        } else {
                            $diferencia = $diferencia + 100;
                        }
                    }
                }
            }

            //Genero-> Como yo ya filtre por gusto de genero mas arriba, me aseguro de que si o si se gustan por lo tanto, no lo voy a contabilizar
            //Añado todo a la tabla Diferencia
            Diferencia::create(['correo1' => $personaAfectada, 'correo2' => $per->correo, 'diferencia' => $diferencia]);
        }
    }


    /**
     * Permite mostrar todos los usuarios de la base de datos
     *
     * @return void
     */
    public function mostrarCrudAdmin()
    {
        $p= array();
        foreach(Persona::all() as $persona){
            foreach(Conjunto::select('id_rol')->where('correo',$persona->correo)->get() as $r){
                $dato = [
                    'correo'=> $persona->correo,
                    'nombre'=>$persona->nombre,
                    'nick'=>$persona->nick,
                    'password'=>$persona->password,
                    'edad'=>$persona->edad,
                    'ciudad'=>$persona->ciudad,
                    'descripcion'=>$persona->descripcion,
                    'tema'=>$persona->tema,
                    'foto'=>$persona->foto,
                    'activo'=>$persona->activo,
                    'conectado'=>$persona->conectado,
                    'id_genero'=>$persona->id_genero,
                    'tieneHijos'=>$persona->tieneHijos,
                    'tipoRelaccion'=>$persona->tipoRelaccion,
                    'hijosDeseados'=>$persona->hijosDeseados,
                    'id_rol' => $r->id_rol,
                ];

                $p[]=$dato;
            }
        }
        return response()->json($p, 200);
    }


    /**
     * Esta funcion me permite mostrar a los usuarios preferentes ordenados a otro usuario
     *
     * @param Request $val
     * @return void
     */
    public function mostrarPreferencias(Request $val)
    {
        $correo = $val->get('correo');
        $personas = array();
        $gustoGenero = GustoGenero::where('correo', '=', $correo)->first();
        $diferencia = Diferencia::orderBy('diferencia', 'ASC')->where(['correo1' => $correo])->orWhere(['correo2' => $correo])->get();
        foreach ($diferencia as $d) {
            foreach (Persona::where('correo', '=', $d->correo1)->where('correo', '!=', $correo)->orWhere('correo', '=', $d->correo2)->where('correo', '!=', $correo)->get() as $p) {
                if ($p->id_genero == $gustoGenero->id) {
                    $personas[] = $p;
                }
                if ($gustoGenero->id == 3) {
                    $personas[] = $p;
                }
            }
        }
        return response($personas);
    }

    /**
     * Esta funcion me permite ver mi perfil de usuario
     *
     * @param Request $val
     * @return void
     */
    public function verMiPerfil(Request $val)
    {
        $correo = $val->get('correo');
        $persona = Persona::where('correo', $correo)->get();
        return $persona;
    }


    /**
     * Esta funcion me permite modificar mi perfil
     *
     * @param Request $val
     * @return void
     */
    public function modificarMiPerfil(Request $val)
    {
        $password1 = $val->get('password1');
        $password2 = $val->get('password2');

        if ($password1 == $password2) {
            $correoAntiguo = $val->get('correoAnt');;
            $correo = $val->get('correo');
            $nick = $val->get('nick');
            $nombre = $val->get('nombre');
            $descripcion = $val->get('descripcion');
            $ciudad = $val->get('ciudad');
            $edad = $val->get('edad');
            $tema= $val->get('tema');

            Persona::where('correo', $correoAntiguo)->update(['correo' => $correo, 'nick' => $nick, 'nombre' => $nombre, 'edad' => $edad, 'descripcion' => $descripcion, 'ciudad' => $ciudad, 'password' => $password1, 'tema' => $tema]);
            return response()->json([
                'message' => 'Perfil Modificado'
            ], 201);
        } else {

            return response()->json([
                'message' => 'Las contraseñas son distintas'
            ], 401);
        }
    }

    /**
     * Esta funcion me permite borrar mi cuenta
     *
     * @param Request $val
     * @return void
     */
    public function borrarMiCuenta(Request $val)
    {
        $correo = $val->get('correo');
        $persona = Persona::find($correo);
        $persona->delete();
    }

    /**
     * Esta funcion te permite enviar una peticion de amistad a alguien
     *
     * @param Request $val
     * @return void
     */
    public function enviarPeticion(Request $val)
    {
        $correo = $val->get('correo');
        $correoAmigo = $val->get('correoAmigo');

        $amigosExisten = Amigo::where('correo1', '=', $correo)->where('correo2', '=', $correoAmigo)->first();
        if (!$amigosExisten) {
            Peticion::create(['correo_origen' => $correo, 'correo_destino' => $correoAmigo]);
            return response()->json([
                'message' => 'Peticion enviada'
            ], 201);
        } else {
            return response()->json([
                'message' => 'Este usuario y tu ya sois amigos'
            ], 401);
        }
    }

    /**
     * Esta funcion te permite añadir a un amigo
     *
     * @param Request $val
     * @return void
     */
    public function addAmigo(Request $val)
    {
        $correo = $val->get('correo');
        $correoAmigo = $val->get('correoAmigo');


        Amigo::create(['correo1' => $correo, 'correo2' => $correoAmigo]);
        Amigo::create(['correo2' => $correo, 'correo1' => $correoAmigo]);

        Peticion::where('correo_destino', $correo)->delete();

        return response()->json([
            'message' => 'Amigo añadido'
        ], 201);
    }

    /**
     * Esta funcion sirve para mostrar a los amigos de una persona
     *
     * @param Request $val
     * @return void
     */
    public function mostrarAmigos(Request $val)
    {

        //correo de la persona que va a ver sus amigos
        $correo = $val->get('correo');
        //select de los amigos de esta persona
        $amigos = Amigo::select('correo2')->where(['correo1' => $correo])->get();
        $amigosConectados = array();

        foreach ($amigos as $a) {
            //veo de la tabla personas a los amigos del interesado
            $personas = Persona::where(['correo' => $a->correo2])->get();
            //veo si ese amigo en concreto esta conectado
            foreach ($personas as $p) {
                if ($p->conectado == 'si') {
                    $amigosConectados[] = $p;
                }
            }
        }
        return response()->json($amigosConectados, 200);
    }
    /**
     * Esta funcion sirve para ver los perfiles de otras personas
     */

    public function verPerfilesOtrasPersonas(Request $val)
    {
        $correo = $val->get('correo');
        $informacionCompacta = array();

        $persona = Persona::select('nick', 'nombre', 'edad', 'descripcion', 'id_genero', 'tieneHijos', 'tipoRelaccion', 'hijosDeseados', 'ciudad')->where('correo', '=', $correo)->get();
        $informacionCompacta[] = $persona;
        $interesGenero = GustoGenero::select('id')->where('correo', '=', $correo)->get();
        $informacionCompacta[] = $interesGenero;
        $preferenciasPersona = PersonaPreferencia::select('intensidad')->where('correo', '=', $correo)->get();
        $informacionCompacta[] = $preferenciasPersona;
        return response()->json($informacionCompacta, 200);
    }


    /**
     * Esta funcion sirve para borrar un amigo
     *
     * @param Request $val
     * @return void
     */
    public function delAmigo(Request $val)
    {
        $correo = $val->get('correo');
        $correoAmigo = $val->get('correoAmigo');

        Amigo::where('correo1', $correo)->where('correo2', $correoAmigo)->delete();
        Amigo::where('correo1', $correoAmigo)->where('correo2', $correo)->delete();

        return response()->json([
            'message' => 'Amigo borrado'
        ], 201);
    }

    /**
     * Esta funcion me permite mostrar las peticiones de amistad que le han llegado a un usuario
     *
     * @param Request $val
     * @return void
     */
    public function mostrarPeticiones(Request $val)
    {
        $correo = $val->get('correo');
        $peticiones = Peticion::select('correo_origen')->where('correo_destino', $correo)->get();
        return response()->json($peticiones, 200);
    }

    /**
     * Esta funcion me permite al administrador borrar un usuario
     *
     * @param Request $val
     * @return void
     */
    public function borrarUsuario(Request $val)
    {
        $correo = $val->get('correo');
        Persona::where('correo', $correo)->delete();

        return response()->json([
            'message' => 'Usuario borrado'
        ], 201);
    }

    /**
     * Esta funcion permite dar de alta a una persona
     *
     * @param Request $val
     * @return void
     */
    public function darDeAlta(Request $val)
    {
        $correo = $val->get('correo');
        $activo = Persona::select('activo')->where('correo', $correo)->get();

        foreach ($activo as $a) {
            if ($a->activo == 'no') {
                Persona::where('correo', $correo)->update(['activo' => 'si']);
                return response()->json([
                    'message' => 'Usuario Activo'
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Este usuario ya esta Activo'
                ], 401);
            }
        }
    }

    /**
     * Esta funcion permite dar de baja a una persona
     *
     * @param Request $val
     * @return void
     */
    public function darDeBaja(Request $val)
    {
        $correo = $val->get('correo');
        $activo = Persona::select('activo')->where('correo', $correo)->get();

        foreach ($activo as $a) {
            if ($a->activo == 'si') {
                Persona::where('correo', $correo)->update(['activo' => 'no']);
                return response()->json([
                    'message' => 'Usuario Desactivado'
                ], 201);
            } else {
                return response()->json([
                    'message' => 'Este usuario ya esta desactivado'
                ], 401);
            }
        }
    }

    /**
     * Esta funcion me permite editar un usuario
     *
     * @param Request $val
     * @return void
     */
    public function editarUsuario(Request $val)
    {
        $password1 = $val->get('password1');
        $password2 = $val->get('password2');

        if ($password1 == $password2) {
            $correoAntiguo = $val->get('correoAnt');;
            $correo = $val->get('correo');
            $rol=$val->get('id_rol');

            Persona::where('correo', $correoAntiguo)->update(['correo' => $correo, 'password' => $password1]);
            Conjunto::where('correo',$correoAntiguo)->orWhere('correo',$correo)->update(['id_rol' => $rol]);

            return response()->json([
                'message' => 'Perfil Modificado'
            ], 201);
        } else {

            return response()->json([
                'message' => 'Las contraseñas son distintas'
            ], 401);
        }
    }

    /**
     * Esta funcion me permite  mostrar el usuario que vamos a editar en cliente
     */

    public function verUser(Request $val)
    {
        $correo = $val->get('correo');
        $p= array();

        foreach(Persona::where('correo', $correo)->get() as $persona){
            foreach(Conjunto::select('id_rol')->where('correo',$persona->correo)->get() as $r){
                $dato = [
                    'correo'=> $persona->correo,
                    'nombre'=>$persona->nombre,
                    'nick'=>$persona->nick,
                    'password'=>$persona->password,
                    'edad'=>$persona->edad,
                    'ciudad'=>$persona->ciudad,
                    'descripcion'=>$persona->descripcion,
                    'tema'=>$persona->tema,
                    'foto'=>$persona->foto,
                    'activo'=>$persona->activo,
                    'conectado'=>$persona->conectado,
                    'id_genero'=>$persona->id_genero,
                    'tieneHijos'=>$persona->tieneHijos,
                    'tipoRelaccion'=>$persona->tipoRelaccion,
                    'hijosDeseados'=>$persona->hijosDeseados,
                    'id_rol' => $r->id_rol,
                ];

                $p[]=$dato;
            }
        }
        return response()->json($p, 200);
    }

/**
 * Esta funcion me permite borrar una peticion de amistad
 *
 * @param Request $val
 * @return void
 */
    public function borrarPeticion(Request $val){
        $correo = $val->get('correo');
        $correoAmigo = $val->get('correoAmigo');

        Peticion::where('correo_destino', $correo)->where('correo_origen', $correoAmigo)->delete();

        return response()->json([
            'message' => 'Amigo añadido'
        ], 201);
    }
/**
 * Esta funcion me permite añadir un usuario completo
 *
 * @return void
 */
    public function addUsuario(Request $val){
        $password1=$val->get('password1');
        $password2=$val->get('password2');

        if($password1==$password2){

            //Generico
            $nombre=$val->get('nombre');
            $nick=$val->get('nick');
            $correo=$val->get('correo');
            $edad=$val->get('edad');
            $ciudad=$val->get('ciudad');
            $id_genero=$val->get('id_genero');
            //Preferencias
            $tipoRelaccion = $val->get('tipoRelaccion');
            $tieneHijos = $val->get('numHijos');
            $quiereHijos = $val->get('quiereHijos');
            $interesDeGenero = $val->get('generoPreferido');
            $descripcion = $val->get('descripcion');
            $Deportivos = $val->get('deporte');
            $Artisticos = $val->get('arte');
            $Politicos = $val->get('politica');
            $rol=$val->get('id_rol');

        Persona::create(['correo' => $correo, 'nombre' => $nombre, 'nick' => $nick, 'password' => $password1, 'edad' => $edad, 'ciudad' => $ciudad, 'descripcion' => $descripcion, 'tema' => 'claro', 'foto' => './public/ImagenesPerfil', 'activo' => 'no', 'conectado' => 'no', 'id_genero' => $id_genero, 'tieneHijos' => $tieneHijos, 'tipoRelaccion' => $tipoRelaccion, 'hijosDeseados' => $quiereHijos]);
        GustoGenero::create(['id' => $interesDeGenero, 'correo' => $correo]);
        PersonaPreferencia::create(['correo' => $correo, 'id_preferencia' => 1, 'intensidad' => $Deportivos]);
        PersonaPreferencia::create(['correo' => $correo, 'id_preferencia' => 2, 'intensidad' => $Artisticos]);
        PersonaPreferencia::create(['correo' => $correo, 'id_preferencia' => 3, 'intensidad' => $Politicos]);
        Conjunto::create(['correo' => $correo, 'id_rol' => $rol]);


        self::calcularPreferencias($interesDeGenero,$correo,$Deportivos,$Artisticos,$Politicos,$tipoRelaccion,$quiereHijos,$tieneHijos);

            return response()->json([
                'message' => 'Usuario Añadido'
            ], 201);

        }else{
            return response()->json([
                'message' => 'Las contraseñas son distintas'
            ], 401);
        }


    }

    /**
     * Esta funcion sirve para desconectar un usuario
     *
     * @param Request $val
     * @return void
     */
    public function desconectar(Request $val){

        $correo= $val->get('correo');
        Persona::where('correo', $correo)->update(['conectado' => 'no']);

        return response()->json([
            'message' => 'Usuario Desconectado'
        ], 201);
    }

    /**
     * Cambiar tema de la persona
     *
     * @param Request $val
     * @return void
     */
    public function cambiarTema(Request $val){
        $correo= $val->get('correo');
        foreach(Persona::where('correo', '=', $correo)->get() as $p){
            $tema=$p->tema;
            if($tema=='claro'){
                Persona::where('correo', $correo)->update(['tema' => 'oscuro']);
            }else{
                Persona::where('correo', $correo)->update(['tema' => 'claro']);
            }
        }
        return response()->json([
            'message' => 'Tema modificado'
        ], 201);
    }

}
