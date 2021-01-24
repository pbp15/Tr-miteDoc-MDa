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

    Route::get('/','Auth\LoginController@showLoginForm')->name('defect');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    /* VISTAS DE PAGINA WEB */
    Route::get('/page','PaginaController@inicio')->name('page');
    Route::get('/inicial','PaginaController@nivelinicial')->name('nivel-inicial');
    /* METODOS DE PAGINA WEB */
    Route::get('/evento/show','EventoController@getDatos');
    Route::get('/testimonio/show','TestimonioController@getDatos');    
    Route::post('/contacto/registrar', 'ContactoController@store');

    

});


Route::group(['middleware' => ['auth']], function(){

    Route::post('/logout' , 'Auth\LoginController@logout')->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::group(['middleware' => ['Gerente']], function(){
   
    
    });


    Route::group(['middleware' => ['Secretaria']], function(){
           /*Expediente*/

    });


    Route::group(['middleware' => ['Administrador']], function(){
    


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

        Route::get('/categoria', 'CategoriaController@index');
        Route::post('/categoria/registrar', 'CategoriaController@store');
        Route::put('/categoria/actualizar', 'CategoriaController@update');
        Route::put('/categoria/desactivar', 'CategoriaController@desactivar');
        Route::put('/categoria/activar', 'CategoriaController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriaController@selectCategoria');

        // Route::get('/contacto', 'ContactoController@index');
        // Route::put('/contacto/actualizar', 'ContactoController@update');

        Route::get('/evento','EventoController@index');
        Route::post('/evento/registrar', 'EventoController@store');
        Route::put('/evento/actualizar', 'EventoController@update');
        Route::put('/evento/eliminar', 'EventoController@destroy');

        Route::get('/testimonio','TestimonioController@index');
        Route::post('/testimonio/registrar', 'TestimonioController@store');
        Route::put('/testimonio/actualizar', 'TestimonioController@update');
        Route::put('/testimonio/eliminar', 'TestimonioController@destroy');

        
        Route::get('/noticia','NoticiaController@index');
        Route::post('/noticia/registrar', 'NoticiaController@store');
        Route::put('/noticia/actualizar', 'NoticiaController@update');
        Route::put('/noticia/eliminar', 'NoticiaController@destroy');

        
        Route::get('/profesor','ProfesoreController@index');
        Route::post('/profesor/registrar', 'ProfesoreController@store');
        Route::put('/profesor/actualizar', 'ProfesoreController@update');
        Route::put('/profesor/eliminar', 'ProfesoreController@destroy');


        
        Route::get('/blog','BlogController@index');
        Route::post('/blog/registrar', 'BlogController@store');
        Route::put('/blog/actualizar', 'BlogController@update');
        Route::put('/blog/eliminar', 'BlogController@destroy');
    });
        
});




//Route::get('/home', 'HomeController@index')->name('home');
