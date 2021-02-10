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

Route::prefix('votacion')->group(function() {
  
  Route::get('/', 'VotacionController@index');
	
	Route::get('/coopexe2', 'VotacionController@coopexe2');

	Route::post('/coopexe3', 'VotacionController@coopexe3');
	
	Route::get('/coopexe4', 'VotacionController@coopexe4');
	
	Route::get('/limitevotos', 'VotacionController@limitevotos');
	
	Route::get('/gruposvoletasfiltradas', 'VotacionController@gruposvoletasfiltradas');

  Route::get('/previa', 'VotacionController@previa');
	
	Route::get('/categoriaslist', 'VotacionController@categoriaslist'); 
	
	Route::get('/finalizada', 'VotacionController@finalizada'); 

	Route::get('/verificaparticipacion', 'VotacionController@verificaparticipacion'); 

	Route::get('/contenedordetalle', 'VotacionController@contenedordetalle'); 
	
});

		
		
		