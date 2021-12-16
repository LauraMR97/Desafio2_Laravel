<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Persona;

class PersonaFactory extends Factory
{
    protected $model = Persona::class; //Especificamos el model con el que vinculamos la factoría.
    public static $correo;
    public static $tipoRelaccion;
    public static $quiereHijos;
    public static $tieneHijos;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

     $edad= rand(18,100);
     $nombre= $this->faker->name;
     self::$tipoRelaccion=$this->faker->randomElement(['Amistad', 'Seria', 'Esporadica']);
     self::$quiereHijos=rand(0,10);
     self:: $tieneHijos=rand(0,1);
     self::$correo= $this->faker->unique()->safeEmail;

        return [
            'correo' =>self::$correo,
            'nombre' => $nombre,
            'nick'=> $this->faker->name,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'edad'=>$edad,
            'ciudad'=>$this->faker->city,
            'descripcion'=>'Hola, soy '.$nombre,
            'tema'=>'claro',
            'foto'=>'/public/ImagenesPerfil',
            'activo'=>'no',
            'conectado'=>'no',
            'id_genero'=>rand(1,3),
            'tieneHijos'=>self::$tieneHijos,
            'tipoRelaccion'=>self::$tipoRelaccion,
            'hijosDeseados'=>self::$quiereHijos,
        ];
    }
}
