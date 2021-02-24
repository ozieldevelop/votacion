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
    Route::post('upload', array( 'uses' => 'ClienteController@upload'));
    Route::get('cargaadjuntosScreenListar', array( 'uses' => 'ClienteController@cargaadjuntosScreenListar')); 
    Route::post('almacenarfilecv', array( 'uses' => 'ClienteController@almacenarfilecv')); 
    Route::post('almacenarfotoperfil', array( 'uses' => 'ClienteController@almacenarfotoperfil')); 
    Route::get('descargarfile/{adjuntoviewid?}', array( 'uses' => 'ClienteController@getDownload'));
  
  
  
    Route::prefix('inscripcion')->group(function() {
        Route::get('/', 'ClienteController@index');
        Route::post('/guardaasistencia', 'ClienteController@guardaasistencia');
    });
  
    Route::get('/registro', [App\Http\Controllers\HomeController::class, 'showRegistro'])->name('showRegistro');
    Route::post('/registro', [App\Http\Controllers\HomeController::class, 'postRegistro'])->name('postRegistro');
  
});


