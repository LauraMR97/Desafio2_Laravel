<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peticion extends Model
{
    use HasFactory;
    protected $fillable=['correo_origen','correo_destino'];
    protected $table = 'peticiones';
    protected $primaryKey = ['correo_origen,correo_destino'];
    public $incrementing = false;
    protected $keyType = ['string,string'];
}
