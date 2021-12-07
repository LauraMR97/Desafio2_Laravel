<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigo extends Model
{
    use HasFactory;
    protected $fillable=['correo1','correo2'];
    protected $table = 'amigos';
    protected $primaryKey = ['correo1,correo2'];  //Por defecto el campo clave es 'id', entero y autonumérico.
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = ['string,string'];   //Indicamos que la clave no es entera.
}
