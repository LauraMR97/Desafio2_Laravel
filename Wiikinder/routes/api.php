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

//Añadir informacion
Route::post('/registroRol', [miControlador::class, 'crearRol']);
Route::post('/registroGenero', [miControlador::class, 'crearGenero']);

//Registro
Route::post('/registroPersona', [miControlador::class, 'crearPersona']);

//Login
Route::any('/login', [miControlador::class, 'login']);
Route::any('/desc', [miControlador::class, 'desconectar']);
Route::post('/tema', [miControlador::class, 'cambiarTema']);

//Contraseña Perdida
Route::post('/passwordOlvidada', [miControlador::class, 'passOlvidada']);

//Crear Formulario o crear Preferencias
Route::post('/registroPreferencia', [miControlador::class, 'crearPreferencia']);
Route::post('/formularioPreferencias', [miControlador::class, 'crearFormularioPreferencias']);

//Mostrar Preferencias
Route::any('/preferenciasUsuario', [miControlador::class, 'mostrarPreferencias']);

//Amigos (Conectados) y Peticiones
Route::post('/enviarPeti', [miControlador::class, 'enviarPeticion']);
Route::post('/borrarPeti', [miControlador::class, 'borrarPeticion']);
Route::post('/aniadirAmigo', [miControlador::class, 'addAmigo']);
Route::any('/amigos', [miControlador::class, 'mostrarAmigos']);
Route::any('/peticiones', [miControlador::class, 'mostrarPeticiones']);
Route::post('/borrarAmigo', [miControlador::class, 'delAmigo']);

//Crud Administrador
Route::get('/crudAdmin', [miControlador::class, 'mostrarCrudAdmin']);
Route::post('/borrar', [miControlador::class, 'borrarUsuario']);
Route::post('/editar', [miControlador::class, 'editarUsuario']);
Route::any('/user', [miControlador::class, 'verUser']);
Route::post('/add', [miControlador::class, 'addUsuario']);
Route::post('/alta', [miControlador::class, 'darDeAlta']);
Route::post('/baja', [miControlador::class, 'darDeBaja']);


//Perfiles de Usuario
Route::any('/miPerfil', [miControlador::class, 'verMiPerfil']);
Route::any('/perfilPersonas', [miControlador::class, 'verPerfilesOtrasPersonas']);
Route::post('/modificarPerfil', [miControlador::class, 'modificarMiPerfil']);
Route::post('/borrarPerfil', [miControlador::class, 'borrarMiCuenta']);
