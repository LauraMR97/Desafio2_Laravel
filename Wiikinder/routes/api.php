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

//Login
Route::post('/login', [miControlador::class, 'login']);

//Contraseña Perdida
Route::post('/passwordOlvidada', [miControlador::class, 'passOlvidada']);

//Crear Formulario o crear Preferencias
Route::post('/registroPreferencia', [miControlador::class, 'crearPreferencia']);
Route::post('/formularioPreferencias', [miControlador::class, 'crearFormularioPreferencias']);

//Mostrar Preferencias
Route::get('/preferenciasUsuario', [miControlador::class, 'mostrarPreferencias']);

//Personas Conectadas

//Crud Administrador
Route::get('/crudAdmin', [miControlador::class, 'mostrarCrudAdmin']);

//Perfiles de Usuario
Route::get('/miPerfil', [miControlador::class, 'verMiPerfil']);
Route::post('/modificarPerfil', [miControlador::class, 'modificarMiPerfil']);
Route::post('/borrarPerfil', [miControlador::class, 'borrarMiCuenta']);
