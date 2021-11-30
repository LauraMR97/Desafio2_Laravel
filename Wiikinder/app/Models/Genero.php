<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    public function generoDeLaPersona(){
        return $this->belongsTo('App\Models\Persona','correo','correo');
    }
}
