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
  
  
    Route::prefix('inscripcion')->group(function() {
              Route::get('/', 'ClienteController@index');
              Route::get('/guardaasistencia', 'ClienteController@guardaasistencia');
    });
  

  
});


