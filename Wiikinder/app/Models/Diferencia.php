<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diferencia extends Model
{
    use HasFactory;

    protected $fillable=['correo1','correo2','diferencia'];
    protected $table = 'diferencias';


    public function persona(){
            return $this->hasMany('App\Models\Persona','correo1','correo');
    }

    public function persona2(){
        return $this->hasMany('App\Models\Persona','correo2','correo');
}
}
