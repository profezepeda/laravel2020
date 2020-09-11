<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get("/regiones", "Configuracion\RegionesController@index");

Route::get("/personas", "Operaciones\PersonasController@index");
Route::get("/personas/json/lista", "Operaciones\PersonasController@indexjson");
Route::get("/personas/editar/{idpersona}", "Operaciones\PersonasController@editar");
Route::post("/personas/guardar", "Operaciones\PersonasController@guardar");
Route::post("/personas/eliminar", "Operaciones\PersonasController@eliminar");
Route::get("/personas/contrato/editar/{idpersona}/{idcontrato}", "Operaciones\ContratosController@editar");
Route::post("/personas/contrato/guardar", "Operaciones\ContratosController@guardar");

Route::get("/evaluaciones", "Operaciones\PruebasController@index");
Route::get("/evaluaciones/editar/{idprueba}", "Operaciones\PruebasController@editar");
Route::post("/evaluaciones/guardar", "Operaciones\PruebasController@guardar");
Route::post("/evaluaciones/asistentes/agregar", "Operaciones\PruebasController@agregarasistentes");
Route::post("/evaluaciones/asistentes/quitar", "Operaciones\PruebasController@quitarasistentes");

Route::get("/usuarios/obtener",     "Gestion\UsuariosController@obtener");
