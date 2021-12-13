<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaPreferencia extends Model
{
    use HasFactory;

    protected $fillable=['correo','id_preferencia','intensidad'];
    protected $table = 'preferencias_persona';


    public function preferencia(){
        return $this->hasMany('App\Models\Preferencia','id_preferencia','id');
    }

    public function persona(){
        return $this->hasMany('App\Models\Persona','correo','correo');
    }
}
