<?php

namespace Modules\Sistema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Yajra\Datatables\Datatables;


//use App\HelperServiceProvider;

//use App\Services\GmailSend;
//use App\Mail\InvitacionVotacion;

use Modules\Sistema\Entities\capitulosModel;
use Modules\Sistema\Entities\asamblea_estructuraModel;
use Modules\Sistema\Entities\eventoModel;
use Modules\Sistema\Entities\estados_asocModel;
use Modules\Sistema\Entities\vt_enviosModel;
use Modules\Sistema\Entities\documento_envioModel;

use Illuminate\Support\Facades\Mail;

use App\Services\GeneralHelper;

use DB;

class ConfEnvioController extends Controller
{
    
    public function confenvio()
    {
        $capitulos = capitulosModel::select(['IDAGEN','AGENCIA'])->where('IDAGEN','>',0)->get();
		$asamblea_estructura = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		$estados_asoc = estados_asocModel::select(['id_estado','estado'])->where('id_estado','>',0)->get();		
		$eventos = eventoModel::select(['id','nombre','rangofecha1'])->where('status',1)->orderBy('rangofecha1', 'DESC')->get();
		$tipos = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		return view('sistema::confenvio')->with('eventos', $eventos)->with('tipos', $tipos)->with('capitulos', $capitulos)->with('asamblea_estructura', $asamblea_estructura)->with('estados_asoc', $estados_asoc); 		
    }	

	public function cargarenvios(Request $request)
	{
		
           try
           {
				$buscando = $request->input('eleccion');
                $data = vt_enviosModel::select(['id_evento','IDAGEN','CLDOC','NOMBRE','CORREO','agregado','pendiente','enviados','fallido' ])->where('id_evento',$buscando);
                   return Datatables::of($data)->make(true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }


	}
	
	public function insertarnuevosavisos(Request $request)
	{
		
           try
           {
				$buscando = $request->input('eleccion');
				$results1 = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$buscando)->get();
				
				$vowels = array('[', ']', '"');
				 
				foreach ($results1 as $xdata) {
								$vowelsvalues =  ( str_replace($vowels, "", $xdata["capitulos"])  );
								$vowelsvalues2 =  ( str_replace($vowels, "", $xdata["estadosasoc"])  );
				}

				$resultsxa =DB::select('SELECT IDAGEN,CLASOC,CASE WHEN CLASOC = 0 THEN CLDOC ELSE CLASOC END as CLDOC, NOMBRE,CORREO FROM data_clientes where  id_tipo = 2 and CORREO IS NOT NULL and (TRIM(CORREO) <>"") and IDAGEN in('.$vowelsvalues.') and  id_estado in ('.$vowelsvalues2.')' );
				
				//dd($resultsxa[0]->IDAGEN);
				
				
				foreach ($resultsxa as $xcc) {
					   DB::statement('insert into envios (id_evento,IDAGEN,CLDOC,CORREO,NOMBRE) values('.$buscando .",".$xcc->IDAGEN.','.$xcc->CLASOC.',"'. $xcc->CORREO .'","'.$xcc->NOMBRE.'")' );
				}				

           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }


	}


	public function enviarcolaglobal(Request $request)
	{
		
           try
           {
			  $id_evento = $request->input('id_evento');  
			  
			  
			  // datos de contenido de correo
			  $documento_resultados = documento_envioModel::select(['asunto','texto'])->where('id_evento','=',$id_evento)->get();
			  
			  
			  $configuraciones =DB::select('select modo,correopruebas from conf');
			  //$configuraciones[0]->correopruebas
			  $desarvari = "";
			  $desarvaricorreo = "";
			  
			  if($configuraciones[0]->modo == 0)
			  {
				  $desarvari =" limit 1";
			  }
			  //dd($desarvari);

			  // datos de contenido de correo
			  
			  // modo desarrollo
			  
		      $datos1 = \DB::connection('mysql')->select("select * from envios where id_evento=".$id_evento." and accion=3  ".$desarvari."");

			  $CantRegistros = count($datos1);  	
			  
			  if($CantRegistros>0)  
			  {
				  
				  
	switch((int)date("H"))
		{
		case 0:
		$time='Buenas noches';
		break;
		case 1:
		$time='Buenas noches';
		break;
		case 2:
		$time='Buenas noches';
		break;
		case 3:
		$time='Buenas noches';
		break;
		case 4:
		$time='Buenas noches';
		break;
		case 5:
		$time='Buenas noches';
		break;
		case 6:
		$time='Buenos días';
		break;
		case 7:
		$time='Buenos días';
		break;
		case 8:
		$time='Buenos días';
		break;
		case 9:
		$time='Buenos días';
		break;
		case 10:
		$time='Buenos días';
		break;
		case 11:
		$time='Buenos días';
		break;
		case 12:
		$time='Buenos días';
		break;
		case 13:
		$time='Buenas tardes';
		break;
		case 14:
		$time='Buenas tardes';
		break;
		case 15:
		$time='Buenas tardes';
		break;
		case 16:
		$time='Buenas tardes';
		break;
		case 17:
		$time='Buenas tardes';
		break;
		case 18:
		$time='Buenas tardes';
		break;
		case 19:
		$time='Buenas noches';
		break;
		case 20:
		$time='Buenas noches';
		break;
		case 21:
		$time='Buenas noches';
		break;
		case 22:
		$time='Buenas noches';
		break;
		case 23:
		$time='Buenas noches';
		break;
		}

		
				foreach ($datos1 as $registrosenvio)
				{
					//dd($registrosenvio);
					// obtengo el asunto y cuerpo del correo de invitacion
						//dd( $documento_resultados);

					$contenido = '<!DOCTYPE html>
						<html>
						 <head>
						  <title>How Send an Email in Laravel</title>
						  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
						  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
						  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
						  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

						  <!-- Styles -->
						  <style>
							  html, body {
								  background-color: #fff;
								  color: #636b6f;
								  font-family: Nunito, sans-serif;
								  font-weight: 200;
								  height: 100vh;
								  margin: 0;
							  }

							  .full-height {
								  height: 100vh;
							  } 

							  .content {
								  text-align: center;
							  }

							  .title {
								  font-size: 84px;
							  } 
						  </style>
						 </head>
						 <body>
						  <br />
						  <br />
						  <br />
						  <div class="container box" style="width: 970px;">
						
							<h1>'.  $time. ';  bienvenido   '.$registrosenvio->NOMBRE .' a '.$documento_resultados[0]->asunto .'</h1>

							<p>'.  $documento_resultados[0]->texto .'</p>

							

				
							 <a href="http://cooperativa.eaguilars.com/votacion/?wget='. GeneralHelper::lara_encriptar( $registrosenvio->CLDOC ).'&id_evento='. GeneralHelper::lara_encriptar( $id_evento  ) .'"> <img src="'.url('/images').'/accede.png"></a></p>
						  </div>
						 </body>
						</html>';
			
						if($configuraciones[0]->modo == 0)
						{
							$correenviar = $configuraciones[0]->correopruebas;		
						}
						else
						{
							 $correenviar = $registrosenvio->CORREO;
						}

						$details =[
							'title' => $documento_resultados[0]->asunto,
							'body' => $documento_resultados[0]->texto,
							'num_cliente' => $registrosenvio->CLDOC,
							'nombre' => $registrosenvio->NOMBRE,
							'correo' => $correenviar ,
							'contenido' => $contenido
						];
	
						Mail::send([], [], function($message) use ($details) {
							$message->from(env('MAIL_USERNAME' ));
							$message->to($details["correo"]);
							$message->subject($details["title"]);
							$message->setBody($details["contenido"] , 'text/html');
						});				  

						$carbon = new \Carbon\Carbon();
						$date = $carbon->now()->toDateTimeString();

								
						if( count(Mail::failures()) > 0 ) {
						    foreach(Mail::failures() as $email_address) {
							   $datos1 = \DB::connection('mysql')->select("update envios set accion= 0 , fechaenviado='".$date."' where id=".$registrosenvio->id."");
							}

						} else {
							$datos1 = \DB::connection('mysql')->select("update envios set accion= 1 , fechaenviado='".$date."' where id=".$registrosenvio->id."");
						}

				}

			  }
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }


	}
	
	
	
    public function prueba()
    {
		return view('sistema::prueba'); 		
    }	
		 

	public function cargardetalleenvios(Request $request)
	{
		
           try
           {
				$evento = $request->input('evento');
				$cldoc = $request->input('cldoc');
				$resultsxa =DB::select('select `a`.`fecha` as fechagenerado,CASE WHEN `a`.`accion` = 1 THEN "Enviados" WHEN `a`.`accion` = 0 THEN "Fallido" ELSE "Pendiente" END as Accion,`a`.`fechaenviado` AS `FechaEnvio` from `envios` `a` where `a`.`id_evento`= '. $evento .' and `a`.`CLDOC` = '. $cldoc .' order by `a`.`fecha`,`a`.`fechaenviado` desc');
				return json_decode(json_encode($resultsxa),true);				

           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }


	}


	public function reinsertar(Request $request)
	{
           try
           {
			  $configuraciones =DB::select('select modo,correopruebas from conf');
			  //$configuraciones[0]->correopruebas
			  $desarvari = "";
			  $desarvaricorreo = "";
			  
			  if($configuraciones[0]->modo ==0)
			  {
				  $desarvari =" limit 1";
			  }

			  
				$evento = $request->input('id_evento');
				$cldoc = $request->input('cldoc');
				$resultsxa =DB::select('insert into envios (id_evento,IDAGEN,CLDOC,CORREO,NOMBRE) select b.id_evento,b.IDAGEN,b.CLDOC,b.CORREO,b.NOMBRE from vt_envios as b where b.id_evento ='.$evento.' and b.CLDOC='.$cldoc .' '.$desarvari.'');
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
	}
	
	public function fnreenviarnoti(Request $request)
	{
	
           try
           {
			  $id_evento = $request->input('id_evento');  
			  $cldoc = $request->input('cldoc');
			  
			  
			  $configuraciones =DB::select('select modo,correopruebas from conf');
			  //$configuraciones[0]->correopruebas
			  $desarvari = "";
			  $desarvaricorreo = "";
			  
			  if($configuraciones[0]->modo ==0)
			  {
				  $desarvari =" limit 1";
			  }
			  
			  // datos de contenido de correo
			  $documento_resultados = documento_envioModel::select(['asunto','texto'])->where('id_evento','=',$id_evento)->get();
			 // dd($documento_resultados);
			  // datos de contenido de correo
		      $datos1 = \DB::connection('mysql')->select("select * from envios where id_evento=".$_REQUEST['id_evento']." and cldoc=".$cldoc." and accion=3 ".$desarvari."");
				//dd( $datos1 );
			  $CantRegistros = count($datos1);  	
			  
			  if($CantRegistros>0)  
			  {
				  
				  
				switch((int)date("H"))
					{
					case 0:
					$time='Buenas noches';
					break;
					case 1:
					$time='Buenas noches';
					break;
					case 2:
					$time='Buenas noches';
					break;
					case 3:
					$time='Buenas noches';
					break;
					case 4:
					$time='Buenas noches';
					break;
					case 5:
					$time='Buenas noches';
					break;
					case 6:
					$time='Buenos días';
					break;
					case 7:
					$time='Buenos días';
					break;
					case 8:
					$time='Buenos días';
					break;
					case 9:
					$time='Buenos días';
					break;
					case 10:
					$time='Buenos días';
					break;
					case 11:
					$time='Buenos días';
					break;
					case 12:
					$time='Buenos días';
					break;
					case 13:
					$time='Buenas tardes';
					break;
					case 14:
					$time='Buenas tardes';
					break;
					case 15:
					$time='Buenas tardes';
					break;
					case 16:
					$time='Buenas tardes';
					break;
					case 17:
					$time='Buenas tardes';
					break;
					case 18:
					$time='Buenas tardes';
					break;
					case 19:
					$time='Buenas noches';
					break;
					case 20:
					$time='Buenas noches';
					break;
					case 21:
					$time='Buenas noches';
					break;
					case 22:
					$time='Buenas noches';
					break;
					case 23:
					$time='Buenas noches';
					break;
					}

		
				foreach ($datos1 as $registrosenvio)
				{
					//dd($registrosenvio);
					// obtengo el asunto y cuerpo del correo de invitacion
						//dd( $documento_resultados);

					$contenido = '<!DOCTYPE html>
						<html>
						 <head>
						  <title>How Send an Email in Laravel</title>
						  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
						  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
						  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
						  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

						  <!-- Styles -->
						  <style>
							  html, body {
								  background-color: #fff;
								  color: #636b6f;
								  font-family: Nunito, sans-serif;
								  font-weight: 200;
								  height: 100vh;
								  margin: 0;
							  }

							  .full-height {
								  height: 100vh;
							  } 

							  .content {
								  text-align: center;
							  }

							  .title {
								  font-size: 84px;
							  } 
						  </style>
						 </head>
						 <body>
						  <br />
						  <br />
						  <br />
						  <div class="container box" style="width: 970px;">
						
							<h1>'.  $time. ';  bienvenido   '.$registrosenvio->NOMBRE .' a '.$documento_resultados[0]->asunto .'</h1>

							<p>'.  $documento_resultados[0]->texto .'</p>

							

				
							 <a href="http://cooperativa.eaguilars.com/votacion/?wget='. GeneralHelper::lara_encriptar( $registrosenvio->CLDOC ).'&id_evento='. GeneralHelper::lara_encriptar( $id_evento  ) .'"> <img src="'.url('/images').'/accede.png"></a></p>
						  </div>
						 </body>
						</html>';
			
			
						if($configuraciones[0]->modo == 0)
						{
							$correenviar = $configuraciones[0]->correopruebas;		
						}
						else
						{
							 $correenviar = $registrosenvio->CORREO;
						}

						$details =[
							'title' => $documento_resultados[0]->asunto,
							'body' => $documento_resultados[0]->texto,
							'num_cliente' => $registrosenvio->CLDOC,
							'nombre' => $registrosenvio->NOMBRE,
							'correo' => $correenviar ,
							'contenido' => $contenido
						];
	
						Mail::send([], [], function($message) use ($details) {
							$message->from(env('MAIL_USERNAME' ));
							$message->to($details["correo"]);
							$message->subject($details["title"]);
							$message->setBody($details["contenido"] , 'text/html');
						});				  

						$carbon = new \Carbon\Carbon();
						$date = $carbon->now()->toDateTimeString();


								
						if( count(Mail::failures()) > 0 ) {
						    foreach(Mail::failures() as $email_address) {
							   $datos1 = \DB::connection('mysql')->select("update envios set accion= 0 , fechaenviado='".$date."' where id=".$registrosenvio->id."");
							}
						} else {
							$datos1 = \DB::connection('mysql')->select("update envios set accion= 1 , fechaenviado='".$date."' where id=".$registrosenvio->id."");
						}

						

				}
			  }
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }

	}

}
