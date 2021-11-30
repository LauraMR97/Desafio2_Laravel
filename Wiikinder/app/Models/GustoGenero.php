<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GustoGenero extends Model
{
    use HasFactory;
    protected $table = 'gusto_genero';
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = 'string';   //Indicamos que la clave no es entera.


    public function personaALaQueLeGusta(){
        return $this->hasMany('App\Models\Persona','correo','correo');
    }

    public function generoQueLeGustaALaPersona(){
        return $this->hasMany('App\Models\Genero','id','id');
    }
}
