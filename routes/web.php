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

Route::group(['middleware' => ['guest']], function(){

    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('/register','Auth\RegisterController@showRegister');

});


Route::group(['middleware' => ['auth']], function(){

    Route::post('/logout' , 'Auth\LoginController@logout')->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Gerente']], function(){
           /*Expediente*/
        Route::get('/expediente', 'ExpedienteController@index');
        Route::post('/expediente/registrar', 'ExpedienteController@store');
        Route::put('/expediente/actualizar', 'ExpedienteController@update');
        Route::put('/expediente/desactivar', 'ExpedienteController@desactivar');
        Route::put('/expediente/activar', 'ExpedienteController@activar');
        Route::post('/expediente/documento', 'ExpedienteController@documento');
    
    });


    Route::group(['middleware' => ['Secretaria']], function(){
           /*Expediente*/
        Route::get('/expediente', 'ExpedienteController@index');
        Route::post('/expediente/registrar', 'ExpedienteController@store');
        Route::put('/expediente/actualizar', 'ExpedienteController@update');
        Route::put('/expediente/desactivar', 'ExpedienteController@desactivar');
        Route::put('/expediente/activar', 'ExpedienteController@activar');
        Route::post('/expediente/documento', 'ExpedienteController@documento');
    });


    Route::group(['middleware' => ['Administrador']], function(){
    
           /*Expediente*/
        Route::get('/expediente', 'ExpedienteController@index');
        Route::post('/expediente/registrar', 'ExpedienteController@store');
        Route::put('/expediente/actualizar', 'ExpedienteController@update');
        Route::put('/expediente/desactivar', 'ExpedienteController@desactivar');
        Route::put('/expediente/activar', 'ExpedienteController@activar');
        Route::post('/expediente/documento', 'ExpedienteController@documento');

        /*Oficina*/
        Route::get('/oficina', 'OficinaController@index');
        Route::post('/oficina/registrar', 'OficinaController@store');
        Route::put('/oficina/actualizar', 'OficinaController@update');
        Route::put('/oficina/desactivar', 'OficinaController@desactivar');
        Route::put('/oficina/activar', 'OficinaController@activar');

        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');

        Route::get('/rol', 'RolController@index');
        Route::get('/rol/selectRol', 'RolController@selectRol');
        
        
        Route::get('/persona', 'PersonaController@index');
        Route::post('/persona/registrar', 'PersonaController@store');
        Route::put('/persona/actualizar', 'PersonaController@update');
    });
        
});




//Route::get('/home', 'HomeController@index')->name('home');
