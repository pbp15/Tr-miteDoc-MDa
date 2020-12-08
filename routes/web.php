<?php

use Illuminate\Support\Facades\Route;

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
    return view('contenido/contenido');
});
Route::get('/nosotros', 'RecetaController@hola');

/*Ofina*/
Route::get('/oficina', 'OficinaController@index');
Route::post('/oficina/registrar', 'OficinaController@store');
Route::put('/oficina/actualizar', 'OficinaController@update');
Route::put('/oficina/desactivar', 'OficinaController@desactivar');
Route::put('/oficina/activar', 'OficinaController@activar');
/*Expediente*/
Route::get('/expediente', 'ExpedienteController@index');
Route::post('/expediente/registrar', 'ExpedienteController@store');
Route::put('/expediente/actualizar', 'ExpedienteController@update');
Route::put('/expediente/desactivar', 'ExpedienteController@desactivar');
Route::put('/expediente/activar', 'ExpedienteController@activar');










Route::get('/persona', 'PersonaController@index');
Route::post('/persona/registrar', 'PersonaController@store');
Route::put('/persona/actualizar', 'PersonaController@update');

