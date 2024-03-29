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
    
    Route::get('/admin/dashboard', 'ClienteController@AdminDashboard');

    Route::get('/propuestas', 'PropuestaController@index');
    Route::get('/propuestas/{id}', 'PropuestaController@getPropuestas');

    Route::prefix('/propuesta')->group( function() {
        Route::post('/store', 'PropuestaController@store');
        Route::put('/{id}', 'PropuestaController@update');
        Route::delete('/{id}', 'PropuestaController@destroy');
    });
});


