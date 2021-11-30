<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conjunto extends Model
{
    use HasFactory;
    protected $table = 'conjuntos';
    protected $primaryKey = ['id_rol,correo'];  //Por defecto el campo clave es 'id', entero y autonumérico.
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = ['int,string'];   //Indicamos que la clave no es entera.


    public function usuarios(){
        return $this->hasMany('App\Models\Persona','correo','correo');
    }

    public function rol(){
        return $this->hasMany('App\Models\Rol','id_rol','id');
    }
}
