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

use Illuminate\Contracts\Session\Session;
use App\Models\DataClientes;
use Auth;
use DB;
use Config;

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
              $tipo_invitacion = $request->input('tipo_invitacion');
              $data = vt_enviosModel::select(['id_evento','IDAGEN','CLDOC','NOMBRE','CORREO','agregado','pendiente','enviados','fallido','tipo_invitacion' ])->where('id_evento',$buscando)->where('tipo_invitacion',$tipo_invitacion);
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

				$resultsxa =DB::select('SELECT IDAGEN,AGENCIA,CLASOC,CASE WHEN CLASOC = 0 THEN CLDOC ELSE CLASOC END as CLDOC, NOMBRE,CORREO,trato,fecha_nac FROM data_clientes where  id_tipo = 2 and CORREO IS NOT NULL and (TRIM(CORREO) <>"") and IDAGEN in('.$vowelsvalues.') and  id_estado in ('.$vowelsvalues2.')' );
				
				//dd($resultsxa);
				
				
				foreach ($resultsxa as $xcc) {
          
            $xdato = DB::select("select * from asistencia where id_evento=".$buscando ." and num_cliente= '".$xcc->CLASOC ."'" );
            if (count($xdato)==0 )
            {  
                DB::statement('INSERT INTO asistencia (id_evento, tipoevent, num_cliente, trato,nombre, agencia, fecha_nacimiento, asistire) VALUES ('.$buscando.','. $results1[0]->tipo .', '.$xcc->CLASOC.', "'.$xcc->trato.'", "'.$xcc->NOMBRE.'", "'.$xcc->AGENCIA.'", "'.$xcc->fecha_nac.'" , 0);');
            }

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
             
             
             //dd("2");
			  $id_evento = $request->input('id_evento');  
			  $tipo_envio = trim($request->input('tipo_invitacion'));  
        $tipo_envio = filter_var( $tipo_envio, FILTER_SANITIZE_NUMBER_INT);
        $tipo_envio = intval(  $tipo_envio );   
             
        switch($tipo_envio)
          {
          case 1:
              $etiquetatipoenvio = "Formulario previo al evento - ";
              $laimagenicono ="";
          break;
          case 2:
              $etiquetatipoenvio = "Acceso al evento - ";
              $laimagenicono ="<br/><img style='height:328px;width:352px' src='http://cooperativa.eaguilars.com/images/accede.png'>";
          break;   
        }
			  
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
			  
		      $datos1 = \DB::connection('mysql')->select("select * from envios where tipo_envio=".$tipo_envio." and id_evento=".$id_evento." and accion=3  order by cldoc desc ".$desarvari." ");

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
						  <div class="container box" style="width: 100%;">
						  
              <img src="https://portal.cooprofesionales.com.pa/mercadeo/files/333f41_newlogo1.png" style="width: 470px;">
						
							<br/><label style="font-size:20px;color:#202020;font-style: italic;">'.  $time. '; '.$registrosenvio->NOMBRE .' <br/> Te damos la bienvenida al siguiente evento:   '.$etiquetatipoenvio .' &nbsp;'.$documento_resultados[0]->asunto .'</label>';



              switch($tipo_envio)
                {
                case 1:
                    $contenido .= '<a href="'.env('APP_URL', '127.0.0.1').'/cliente/?wget='. GeneralHelper::lara_encriptar( $registrosenvio->CLDOC ).'&id_evento='. GeneralHelper::lara_encriptar( $id_evento  ) .'"> '.  $documento_resultados[0]->texto .''. $laimagenicono .'</a>';
                break;
                case 2:
                    $contenido .= '<a href="'.env('APP_URL', '127.0.0.1').'/cliente/dashboard?wget='. GeneralHelper::lara_encriptar( $registrosenvio->CLDOC ).'&id_evento='. GeneralHelper::lara_encriptar( $id_evento  ) .'"> '.  $documento_resultados[0]->texto .''. $laimagenicono .'</a>';
                break;   
              }
               
               
               
              $contenido .= '</p>
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
      
          
/*
MAIL_MAILER=smtp
MAIL_HOST=email-smtp.us-east-2.amazonaws.com
MAIL_PORT=587
MAIL_USERNAME=AKIAUTPSZXQIX4YM5UHV
MAIL_PASSWORD=BG1YHD0tnaG3eCJbeqUZNVpCmJE62s9IgmqqfMjf6i4U
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=digital@cooprofesionales.com.pa
MAIL_FROM_NAME="Cooperativa Profesionales, R.L."
*/
          
            Config::set('mail.encryption',env('MAIL_MAILER'));
            Config::set('mail.host',env('MAIL_HOST'));
            Config::set('mail.port',env('MAIL_PORT'));
            Config::set('mail.username',env('MAIL_USERNAME'));
            Config::set('mail.password',env('MAIL_PASSWORD'));
            Config::set('mail.from',  ['address' => env('MAIL_FROM_ADDRESS') , 'name' =>  env('MAIL_FROM_NAME')]);
          
          
						$details =[
							'title' => $documento_resultados[0]->asunto,
							'body' => $documento_resultados[0]->texto,
							'num_cliente' => $registrosenvio->CLDOC,
							'nombre' => $registrosenvio->NOMBRE,
							'correo' => $correenviar ,
							'contenido' => $contenido
						];
	
						Mail::send([], [], function($message) use ($details) {
							$message->from(env('MAIL_FROM_ADDRESS'),  env('MAIL_FROM_NAME'));
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
        $tipo_invitacion = $request->input('tipo_invitacion');
				$resultsxa =DB::select('select `a`.`fecha` as fechagenerado,CASE WHEN `a`.`accion` = 1 THEN "Enviados" WHEN `a`.`accion` = 0 THEN "Fallido" ELSE "Pendiente procesar cola global" END as Accion,`a`.`fechaenviado` AS `FechaEnvio` from `envios` `a` where  tipo_envio='. $tipo_invitacion .' and `a`.`id_evento`= '. $evento .' and `a`.`CLDOC` = '. $cldoc .' order by `a`.`fecha`,`a`.`fechaenviado` desc');
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
			  
         $desarvari =" limit 1";    


        
				$evento = $request->input('id_evento');
				$cldoc = $request->input('cldoc');
        $tipo_invitacion = $request->input('tipo_invitacion');
        
				$resultsxa =DB::select('insert into envios (id_evento,IDAGEN,CLDOC,CORREO,NOMBRE) select b.id_evento,b.IDAGEN,b.CLDOC,b.CORREO,b.NOMBRE from vt_envios as b where b.id_evento ='.$evento.' and b.CLDOC='.$cldoc .' AND b.tipo_invitacion ='.$tipo_invitacion.' '.$desarvari.'');
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
     }
	}
	
	public function fnreenviarnoti(Request $request)
	{
	
           try
           {
            //dd("1");
			  $cldoc = $request->input('cldoc');   
			  $id_evento = $request->input('id_evento');  
			  $tipo_envio = trim($request->input('tipo_invitacion'));  
        $tipo_envio = filter_var( $tipo_envio, FILTER_SANITIZE_NUMBER_INT);
        $tipo_envio = intval(  $tipo_envio );   
             
        switch($tipo_envio)
          {
          case 1:
              $etiquetatipoenvio = "Formulario previo al evento - ";
              $laimagenicono ="";
          break;
          case 2:
              $etiquetatipoenvio = "Acceso al evento - ";
              $laimagenicono ="<br/><img style='height:328px;width:352px' src='http://cooperativa.eaguilars.com/images/accede.png'>";
          break;   
        }
             
             
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
		      $datos1 = \DB::connection('mysql')->select("select * from envios where id_evento=".$_REQUEST['id_evento']." and cldoc=".$cldoc." and accion=3 and tipo_envio=".$tipo_envio." ".$desarvari."");
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
						  <title>Cooperativa Profesionales R.L</title>
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
						  <div class="container box" style="width: 100%;">
						  
              <img src="https://portal.cooprofesionales.com.pa/mercadeo/files/333f41_newlogo1.png" style="width: 470px;">
						
							<br/>
              
              <label style="font-size:20px;color:#202020;font-style: italic;">'.  $time. '; '.$registrosenvio->NOMBRE .' <br/> Te damos la bienvenida al siguiente evento:   '.$etiquetatipoenvio .' &nbsp;'.$documento_resultados[0]->asunto .'</label>';

              switch($tipo_envio)
                {
                case 1:
                   $contenido .= '<a href="'.env('APP_URL', '127.0.0.1').'/cliente/dashboard?wget='. GeneralHelper::lara_encriptar( $registrosenvio->CLDOC ).'&id_evento='. GeneralHelper::lara_encriptar( $id_evento  ) .'"> '.  $documento_resultados[0]->texto .''. $laimagenicono .'</a>';
                break;
                case 2:
                    $contenido .= '<a href="'.env('APP_URL', '127.0.0.1').'/cliente/dashboard?wget='. GeneralHelper::lara_encriptar( $registrosenvio->CLDOC ).'&id_evento='. GeneralHelper::lara_encriptar( $id_evento  ) .'"> '.  $documento_resultados[0]->texto .''. $laimagenicono .'</a>';
                break;   
              }

               $contenido.='</p>
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

            Config::set('mail.encryption',env('MAIL_MAILER'));
            Config::set('mail.host',env('MAIL_HOST'));
            Config::set('mail.port',env('MAIL_PORT'));
            Config::set('mail.username',env('MAIL_USERNAME'));
            Config::set('mail.password',env('MAIL_PASSWORD'));
            Config::set('mail.from',  ['address' => env('MAIL_FROM_ADDRESS') , 'name' =>  env('MAIL_FROM_NAME')]);
          						 
          
						$details =[
							'title' => $documento_resultados[0]->asunto,
							'body' => $documento_resultados[0]->texto,
							'num_cliente' => $registrosenvio->CLDOC,
							'nombre' => $registrosenvio->NOMBRE,
							'correo' => $correenviar ,
							'contenido' => $contenido
						];
	
						Mail::send([], [], function($message) use ($details) {
							$message->from(env('MAIL_FROM_ADDRESS'),  env('MAIL_FROM_NAME'));     
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
  
  
  
	public function eliminardelhistorialenvio(Request $request)
	{
	
           try
           {
            //dd("1");
			  $cldoc = $request->input('cldoc');   
			  $id_evento = $request->input('id_evento');  
			  $tipo_envio = trim($request->input('tipo_invitacion'));  
        $tipo_envio = filter_var( $tipo_envio, FILTER_SANITIZE_NUMBER_INT);
        $tipo_envio = intval(  $tipo_envio );   
             
        DB::statement('delete from  envios where id_evento='. $id_evento .'  and tipo_envio='.$tipo_envio.' and CLDOC='.$cldoc.'' );
             
             


       } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
       }

	}
  
  
  
    public function vistaenviocapitular()
    {
        $capitulos = capitulosModel::select(['IDAGEN','AGENCIA'])->where('IDAGEN','>',0)->get();
        $asamblea_estructura = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
        $estados_asoc = estados_asocModel::select(['id_estado','estado'])->where('id_estado','>',0)->get();		
        $eventos = eventoModel::select(['id','nombre','rangofecha1'])->where('tipo',1)->where('status',1)->orderBy('rangofecha1', 'DESC')->get();
        $tipos = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
        return view('sistema::confenviocapitular')->with('eventos', $eventos)->with('tipos', $tipos)->with('capitulos', $capitulos)->with('asamblea_estructura', $asamblea_estructura)->with('estados_asoc', $estados_asoc); 		
    }	
  
    public function vistaenvioasamblea()
    {
        $capitulos = capitulosModel::select(['IDAGEN','AGENCIA'])->where('IDAGEN','>',0)->get();
        $asamblea_estructura = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
        $estados_asoc = estados_asocModel::select(['id_estado','estado'])->where('id_estado','>',0)->get();		
        $eventos = eventoModel::select(['id','nombre','rangofecha1'])->where('tipo',2)->where('status',1)->orderBy('rangofecha1', 'DESC')->get();
        $tipos = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
        return view('sistema::confenvioasamblea')->with('eventos', $eventos)->with('tipos', $tipos)->with('capitulos', $capitulos)->with('asamblea_estructura', $asamblea_estructura)->with('estados_asoc', $estados_asoc); 		
    }	  
  
  public function trabajo($id_evento,$codigos)
  {

    //dd($codigos);
    
    foreach($codigos as $items){
      // echo gettype (trim($items))."<br/>";
      echo trim($items)."<br/>";
      // echo 'INSERT INTO temporal (id_evento,cldoc) VALUES ('.$id_evento.','.(int)$items.');';
         //DB::statement('INSERT INTO temporal (id_evento, cldoc) VALUES (?,?)',array($id_evento,$items));
      echo (int) trim($items)."<br/>";;
      /*
              $id_directivo = DB::table('temporal')-> insertGetId(
                array(
                      'id_evento' => $id_evento,
                      'cldoc' => echo (int) trim($items);
                     )
              );
      
      echo ($id_directivo)."<br/>";
      */
    }
    
   // DB::statement('call pr_genera_inscripcion_asamblea()');
    // $datoscliente = DB::table('data_clientes')->whereIn('clasoc',$codigos );
    // var_dump ($datoscliente );
    
    // $eventos = eventoModel::select(['*'])->where('id',$id_evento)->get();
    //
    
    // $datoscliente = DataClientes::select(['*'])->where('CLASOC',$elcldoc)->toSql();
    // $datoscliente = DB::select("select *  from data_clientes where CLASOC='".$elcldoc."'" )->toArray();
    
    // $datoscliente = DB::select('select * from data_clientes where clasoc= ?', array($elcldoc));
    
    // $datoscliente = DataClientes::select('*');
    // $datoscliente = DataClientes::whereRaw('clasoc = ?', array($elcldoc))->toSql();
    // var_dump ($datoscliente );
    // echo $id_evento."-".$elcldoc."<br/>";
   
  }

  public function upload(Request $request)
     {
       try 
       {
             
             $file = $request->file('file');
             $id_evento =$request->input('up_id_evento');  
             $tipo_invitacion =$request->input('tipo_invitacion');  
             //dd($tipo_invitacion);
         
             $nombrefile = $file->getClientOriginalName();
             $extension = $file->getClientOriginalExtension();
             $tipoarchivo = $file->getMimeType();
             //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);
             $nombre = strtolower(uniqid('file_' . uniqid()) . "." . $extension);
             //$upload_success=$file->move(env('UPLOADDIR'),$nombre);
             $upload_success = $file->move(base_path('public/adjuntos') , $nombre);
             $eventos = eventoModel::select(['*'])->where('id',$id_evento)->get();
             
             $siasistencia =0;
         
         

              
              
         /*
             if($eventos[0]->tipo==2)
             {
               $siasistencia =1;
             }
         */
         
         
             // GUARDA EN cooplab/public/storage
             if ($upload_success) {
                if (($handle = fopen (base_path('/public/adjuntos/').$nombre, 'r' )) !== FALSE) {

                     while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) 
                     {
                                  //echo('->'. $data [0]. '<-<br/>');
                                  //dd($data);
                                  $parametros = explode (";",$data [0]);
                       
                                  $elcldoc = filter_var($parametros [0], FILTER_SANITIZE_NUMBER_INT);
                                  $correo_new = trim($parametros [1]);   
                       
                                  $elcldocval = intval( $elcldoc );
                                  
                                  //$unionx =  $elcldocval. " -  ". $correo_new;
                        
                                  //dd($unionx);
                       
                                  $datoscliente = DataClientes::select(['CLASOC','IDAGEN','AGENCIA','NOMBRE','TELEFONO','CORREO','VALF1','VALF2','id_tipo','tipo','celular','fecha_nac','fecha_ingreso','fecha_retiro','fecha_exp','fecha_reingreso1','fecha_reingreso2','id_sexo','id_estado','estado','id_ocupacion','ocupacion','id_profesion','profesion','id_pais','send_mail','send_mail_coop','send_ec','send_tarj','send_ec_mail','trato'])->where('CLASOC',$elcldocval)->get();

                                  if (count($datoscliente)>=1 )
                                  {  
                                      //dd($datoscliente[0]->AGENCIA);

                                        $xdato = DB::select("select * from asistencia where id_evento=".$id_evento ." and num_cliente= '".$elcldocval ."'" );

                                        if (count($xdato)==0 )
                                        {  
                                          DB::statement('INSERT INTO asistencia (id_evento, tipoevent, num_cliente, trato,nombre, agencia, fecha_nacimiento, asistire) VALUES ('.$id_evento.','. $eventos[0]->tipo .', '.$elcldocval.', "'.$datoscliente[0]->trato.'", "'.$datoscliente[0]->NOMBRE.'", "'.$datoscliente[0]->AGENCIA.'", "'.$datoscliente[0]->fecha_nac.'" , '.$siasistencia.');');
                                        }
                                     
                                    
                                     DB::statement('insert into envios (id_evento,IDAGEN,CLDOC,CORREO,NOMBRE,tipo_envio) values('. $id_evento  .','. $datoscliente[0]->IDAGEN .','. $elcldocval .',"'. $correo_new .'","'.$datoscliente[0]->NOMBRE.'",'.$tipo_invitacion.')' );

                                  }
                     }
                     fclose ( $handle );
                 }

               DB::statement('update asistencia set veri_id_zoom="'.$eventos[0]->veri_id_zoom.'" where id_evento='.$id_evento.'' );
               
               return $nombre;
             }
        } catch (Exception $e) {
                     $response = array(
                         'resabit' => '0001',
                         'status' => 'Listado ERR',
                         'error' => $e->getMessage()
                    );
        }
   }
  
  
  
  
  

}
