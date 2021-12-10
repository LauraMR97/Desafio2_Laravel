<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable=['correo','nombre','nick','password','edad','ciudad','descripcion','tema','foto','activo','conectado','id_genero','tieneHijos','tipoRelaccion','hijosDeseados'];
    protected $table = 'personas';
    protected $primaryKey = 'correo';  //Por defecto el campo clave es 'id', entero y autonumérico.
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = 'string';   //Indicamos que la clave no es entera.


    public function conjunto(){
       return $this->hasMany('App\Models\Conjunto','correo','correo');
    }

    public function diferencia(){
        return $this->hasMany('App\Models\Diferencia','correo','correo1');
    }

    public function diferencia2(){
        return $this->hasMany('App\Models\Diferencia','correo','correo2');
    }
}
