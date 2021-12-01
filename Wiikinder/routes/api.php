<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\miControlador;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/registroRol', [miControlador::class, 'crearRol']);
Route::post('/registroGenero', [miControlador::class, 'crearGenero']);

//Registro
Route::post('/registroPersona', [miControlador::class, 'crearPersona']);
//Formulario Preferencias
Route::post('/formulario', [miControlador::class, 'crearPreferencias']);



//Login
Route::post('/login', [miControlador::class, 'login']);

//Contraseña Perdida
Route::post('/passwordOlvidada', [miControlador::class, 'passOlvidada']);



