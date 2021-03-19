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


Route::group(['prefix' => 'sistema', 'middleware' => ['role:soporte']], function() {

    Route::get('/', 'SistemaController@index');
	


	
	
	/*
	
			aspirante
	
	*/
	
	Route::get('/newaspirante', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@newaspirante'] );         			// VISTA
		
	Route::get('/cargaraspirantes', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@cargaraspirantes'] );
	
	Route::get('/cargardatoaspirante', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@cargardatoaspirante'] );
	
	Route::post('/eliminaraspirante', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@eliminaraspirante'] );
	
	Route::post('/actualizaraspirante', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@actualizaraspirante'] );
	
	Route::post('/agregarnuevo', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@agregarnuevo'] );
	
	Route::post('/almacenarfile', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@almacenarfile'] );
  
	Route::post('/almacenarfilecustom', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@almacenarfilecustom'] );  
  
  Route::post('/almacenarfotoperfil', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@almacenarfotoperfil'] );
	
  Route::get('/obteneradjunto', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@obteneradjunto'] );
	
  Route::get('/newaspirantesuseventos', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@newaspirantesuseventos'] );  
  
  Route::get('/cargaraspi', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@cargaraspi'] );  
  
  Route::get('/consultaraspiranteenevento', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@consultaraspiranteenevento'] );  

  Route::get('/getaspiranteenevento', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@getaspiranteenevento'] );    

  Route::get('/consultaaspirante', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@consultaaspirante'] );  
  
  Route::post('/subirlistadoaspirantes', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@subirlistadoaspirantes'] );

  Route::post('/actualizarstatusaspirante', ['middleware' => ['permission:newaspirante'], 'uses' => 'NewAspiranteController@actualizarstatusaspirante'] );
  
  /*
	
			evento
	
	*/
	
	Route::get('/newevento', ['middleware' => ['permission:newevento'], 'uses' => 'NewEventoController@newevento'] );	         					// VISTA
		
	Route::get('/cargareventos', ['middleware' => ['permission:newevento'], 'uses' => 'NewEventoController@cargareventos'] );
	
	Route::get('/cargardatoevento', ['middleware' => ['permission:newevento'], 'uses' => 'NewEventoController@cargardatoevento'] );
	
	Route::post('/eliminarevento', ['middleware' => ['permission:newevento'], 'uses' => 'NewEventoController@eliminarevento'] );
	
	Route::post('/actualizarevento', ['middleware' => ['permission:newevento'], 'uses' => 'NewEventoController@actualizarevento'] );
	
	Route::post('/agregarnuevoevento', ['middleware' => ['permission:newevento'], 'uses' => 'NewEventoController@agregarnuevoevento'] );	
	
	
	/*
	
			asociar aspirantes a evento
	
	*/	
	Route::get('/confvotacion', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@confvotacion'] );	         		// VISTA
		
	Route::get('/dataeventosseleccion', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@dataeventosseleccion'] );	
		
	Route::get('/listareventosdrop', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@listareventosdrop'] );		
	
	Route::get('/dataeventosseleccionespecifica', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@dataeventosseleccionespecifica'] );		
  

	
	Route::get('/cargaraspirantesconfvota', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@cargaraspirantesconfvota'] );		
	
	Route::post('/agregaraspiranteevento', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@agregaraspiranteevento'] );		
  
  	Route::get('/agregaraspiranteevento', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@agregaraspiranteevento'] );	
	
	Route::post('/eliminaraspiranteevento', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@eliminaraspiranteevento'] );	
	
	Route::post('/lookimage', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@lookimage'] );	
	
  Route::post('/saveimage', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@saveimageanddatos'] );
  
	Route::post('/saveimageanddatos', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@saveimageanddatos'] );
	
	Route::post('/actualizarestadoaspirante', ['middleware' => ['permission:confvotacion'], 'uses' => 'ConfVotacionController@actualizarestadoaspirante'] );	
  
	/*
	
			documentos ckeditor
	
	*/	
	Route::get('/formatosdocumentos', ['middleware' => ['permission:formatosdocumentos'], 'uses' => 'FormatosDocumentosController@formatosdocumentos'] );	// VISTA
	Route::get('/cargarplantillasemailevento', ['middleware' => ['permission:formatosdocumentos'], 'uses' => 'FormatosDocumentosController@cargarplantillasemailevento'] );
	Route::get('/cargarplantillasresultevento', ['middleware' => ['permission:formatosdocumentos'], 'uses' => 'FormatosDocumentosController@cargarplantillasresultevento'] );	
	Route::post('/actualizarplantillasresultevento', ['middleware' => ['permission:formatosdocumentos'], 'uses' => 'FormatosDocumentosController@actualizarplantillasresultevento'] );	
  Route::post('/uploaddocumentosevento', ['middleware' => ['permission:formatosdocumentos'], 'uses' => 'FormatosDocumentosController@uploaddocumentosevento'] );	
  Route::get('/cargaadjuntosScreenListar', ['middleware' => ['permission:formatosdocumentos'], 'uses' => 'FormatosDocumentosController@cargaadjuntosScreenListar'] );	
  Route::post('/eliminaradjunto', ['middleware' => ['permission:formatosdocumentos'], 'uses' => 'FormatosDocumentosController@eliminaradjunto'] );	
  
  

	/*
	
			reportes
	
	*/
	Route::get('/reportes', ['middleware' => ['permission:reportes'], 'uses' => 'ReportesController@reportes'] );							// VISTA
	Route::get('/viewreporte', ['middleware' => ['permission:reportes'], 'uses' => 'ReportesController@viewreporte'] );
	

	Route::get('/confenvio', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@confenvio'] );						// VISTA
	Route::get('/cargarenvios', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@cargarenvios'] );					
	Route::get('/insertarnuevosavisos', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@insertarnuevosavisos'] );
	Route::get('/enviarcolaglobal', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@enviarcolaglobal'] );
	Route::get('/prueba', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@prueba'] );
	Route::post('/cargardetalleenvios', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@cargardetalleenvios'] );
	Route::post('/reinsertar', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@reinsertar'] );
	Route::post('/fnreenviarnoti', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@fnreenviarnoti'] );
	
	Route::get('/pruebaenvio', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@pruebaenvio'] );  
  
  
  
	Route::get('/vistaenviocapitular', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@vistaenviocapitular'] );						// VISTA
  	Route::get('/vistaenvioasamblea', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@vistaenvioasamblea'] );						// VISTA
 	Route::get('/vistaenviosoporte', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@vistaenviosoporte'] );						// VISTA
  
  
	Route::post('/upload', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@upload'] );		
	Route::post('/uploadsoporte', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@uploadsoporte'] );	
	Route::get('/generaReporte', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@generateReporte'] )->name('generaReporte');	
	Route::post('/eliminardelhistorialenvio', ['middleware' => ['permission:confenvio'], 'uses' => 'ConfEnvioController@eliminardelhistorialenvio'] );		
  
  
});


    

