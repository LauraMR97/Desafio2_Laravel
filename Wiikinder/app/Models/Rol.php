<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rol';
    public function conjunto(){
        return $this->hasMany('App\Models\Conjunto','id','id_rol');
    }
}
