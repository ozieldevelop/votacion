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

Route::prefix('cliente')->group(function() 
{

    Route::get('/', 'ClienteController@index');
    Route::get('/dashboard', 'ClienteController@dashboard');
    Route::get('/alldatadirectivos', 'ClienteController@alldatadirectivos');
    Route::get('/alldatadirectivosgroup', 'ClienteController@alldatadirectivosgroup');  
    Route::post('upload', array( 'uses' => 'ClienteController@upload'));
    Route::get('cargaadjuntosScreenListar', array( 'uses' => 'ClienteController@cargaadjuntosScreenListar')); 
    Route::post('almacenarfilecv', array( 'uses' => 'ClienteController@almacenarfilecv')); 
    Route::post('almacenarfotoperfil', array( 'uses' => 'ClienteController@almacenarfotoperfil')); 
    Route::get('descargarfile/{adjuntoviewid?}', array( 'uses' => 'ClienteController@getDownload'));
  
  
  
    Route::prefix('inscripcion')->group(function() {
        Route::get('/', 'ClienteController@index');
        Route::post('/guardaasistencia', 'ClienteController@guardaasistencia');
        Route::post('/guardaasistenciaasamblea', 'ClienteController@guardaasistenciaasamblea');
    });
  
    Route::get('/registro', [App\Http\Controllers\HomeController::class, 'showRegistro'])->name('showRegistro');
    Route::post('/registro', [App\Http\Controllers\HomeController::class, 'postRegistro'])->name('postRegistro');
  
});

/**
 * Grupo de Rutas para el Orden de la palabra
 */
Route::prefix('ordenpab')->group(function() {

    Route::get('/', 'OrdenPalabraController@index')->name('ordendash');
    
    //Pantalla Crear Temas
    Route::get('/crear', 'OrdenPalabraController@create')->name('orden.create');
    
    //Ruta para el draw and drop
    Route::post('/reorder', 'OrdenPalabraController@postIndex')->name('orden.reorder');
    
    //Ruta guardar tema
    Route::post('/insert', 'OrdenPalabraController@store')->name('orden.insert');

    //Ruta actualizar tema
    Route::put('/update', 'OrdenPalabraController@postEdit')->name('orden.update');

    //Ruta eliminar tema
    Route::delete('/delete', 'OrdenPalabraController@postDelete')->name('orden.delete');

    //Ruta Suscribir a Temas
    Route::get('/suscriptores', 'OrdenPalabraController@suscriptoresHome')->name('orden.suscriptores');
    //Ruta Agregar Suscriptor al tema
    Route::post('/suscriptores/add', 'OrdenPalabraController@suscriptoresAdd')->name('orden.suscriptores.add');

    //Ruta Trackear tiempo
    Route::any('/suscriptores/tiempo/subs/{id_suscriptor}/cldoc/{cldoc}', 'OrdenPalabraController@trackTime')->name('orden.suscriptores.tiempo');

    //Ruta Trakear tiempo post ajax
    Route::post('/traking', 'OrdenPalabraController@trakingTime')->name('orden.traking');

});


