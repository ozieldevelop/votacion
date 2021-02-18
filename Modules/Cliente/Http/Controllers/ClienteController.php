<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Sistema\Entities\eventoModel;

use Modules\Sistema\Entities\aspiranteModel;

use Modules\Sistema\Entities\votantesModel;
use Modules\Sistema\Entities\votosModel;
use Modules\Sistema\Entities\vtaspiranteModel;
use Modules\Cliente\Entities\files_up_Model;

use App\Services\GeneralHelper;
use App\Models\Votantes;

//use Carbon\Carbon;
use DB;
//use Illuminate\Support\Facades\Session;
use Auth;
//use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Session\Session;


use Illuminate\Support\Facades\Mail;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
  
    public function index(Request $request)
    {
   
				//Auth::logout();
				//$request->session()->flush();
				
				$cldoc_temp = $request->input('wget');
				
				$ideven = $request->input('id_evento');

				$cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0 ;
				$cldoc= GeneralHelper::lara_desencriptar( $cldoc_temp );	
				//$cldoc= 1;

				
				$ideven = isset($ideven) ? urldecode($ideven) : 0 ;
				$idevendesc=  GeneralHelper::lara_desencriptar( $ideven );	
				//$idevendesc= 5;
				
 
				//dd($cldoc."<br/>". $idevendesc  );

				$resultsxx = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id='.$idevendesc.'');


        
				if($cldoc>0 && $idevendesc>0)
				{     

					// si todo va bien 
				
							$results = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$idevendesc)->get();
							
                
							if (count($results) >0 )
							{
								
								$results2 = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$idevendesc)->where('status',1)->get();
                
								$carbon = new \Carbon\Carbon();
								$date = $carbon->now();
								$dateServer = $date->format('Y-m-d');

								$startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha1"]) )->format('Y-m-d');
								$endDate =$carbon::createFromFormat('Y-m-d H:i:s',trim($results2[0]["rangofecha2"]) )->format('Y-m-d');

								if($date > $startDate && $date < $endDate)
								{

                            
                  $xdato = DB::select("select *  from asistencia where id_evento=".$idevendesc." and num_cliente=".$cldoc."");
                  $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, agencia, ocupacion,profesion from data_clientes WHERE clasoc = ".$cldoc. " ");
									
									if (count($xdato) >0 )
									{
               
										$detalles = DB::select("SELECT num_cliente,trato,nombre,agencia from asistencia WHERE num_cliente = ".$cldoc. " AND id_evento = ".$idevendesc. "");

										$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Esta todo listo!</h3></div>";
										$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'> ".trim($datoscliente[0]->trato)."&nbsp;". trim($datoscliente[0]->nombre)."; ya su asistencia a sido recibida</div>";
                       //  dd(($request->all()));                  
										return view('cliente::confirmada_asistencia')->with('enlace', $request->all() )->with('mensaje', $mensaje)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"] )->with('id_evento', $idevendesc )->with('f_inicia', $results2[0]["rangofecha1"] )->with('f_termina', $results2[0]["rangofecha2"] )->with('num_cliente', $cldoc )->with('ocupacion', trim($datoscliente[0]->ocupacion) )->with('profesion', trim($datoscliente[0]->profesion) )->with('trato', trim($datoscliente[0]->trato) )->with('nombre', trim($datoscliente[0]->nombre) )->with('agencia', trim($datoscliente[0]->agencia) );	 										
									}
									else
									{
  
										$request->session()->put('cldoc', $cldoc);
										$request->session()->put('idevendesc', $idevendesc);
										$request->session()->put('tipoevent', $results2[0]["tipo"] );

                  
										$categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = ".$idevendesc. "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");

										$listadoaspirantes = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b on a.id_delegado = b.id_delegado where b.id_evento= ".$idevendesc. " and  a.estado=1 order by a.apellido asc");									
                    
               
                    $datosfoto = DB::select("SELECT * FROM directivos where num_cliente=".$cldoc."");

  									if (count($datosfoto) >0 )
									  {  
                      $tienefoto = 1;
                      $tipo = $datosfoto[0]->tipo;
                      $foto =  $datosfoto[0]->foto;
                    }
                    else
                    {
                      $tienefoto = 0;
                      $tipo = "data:image/png;";
                      $foto = "../../images/logo-footer.png";                    
                    }

                    //Auth::logout();
                    //$request->session()->flush();
                    //dd(auth()->user());
                  
                    Auth::loginUsingId(3);

                  
										return view('cliente::index')->with('foto', $foto)->with('aspirantes', $listadoaspirantes)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"] )->with('id_evento', $idevendesc )->with('ideven', $idevendesc )->with('max_votos', $results2[0]["maxvotos"] )->with('f_inicia', $results2[0]["rangofecha1"] )->with('f_termina', $results2[0]["rangofecha2"] )->with('num_cliente', $cldoc )->with('ocupacion', trim($datoscliente[0]->ocupacion) )->with('profesion', trim($datoscliente[0]->profesion) )->with('trato', trim($datoscliente[0]->trato) )->with('nombre', trim($datoscliente[0]->nombre) )->with('agencia', trim($datoscliente[0]->agencia) );	 										
									}
								}
								else
								{
                  $request->session()->flush();
									$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
									$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Periodo no est&aacute; dentro del rango habilitado</div>";
									return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc);
								}
							}
							else
							{
                  $request->session()->flush();
									$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
									$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Evento no existe actualmente o esta inactivo</div>";
									return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc);
							
							}

				}
				else
				{
          $request->session()->flush();
					$mensaje = "";
					$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
					if($idevendesc==0){
						$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de evento no fue reconocido</div>";
					}
					if($cldoc==0){
						$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de su número de invitaci&oacute;n</div> ";
					}

					
					return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc);
				}

        	//return view('cliente::tablero');

  
        //return view('cliente::index');
      //return view('cliente::tablero');
    }  
  
  
    public function dashboard(Request $request)
    {
   
				//Auth::logout();
				//$request->session()->flush();
				
				$cldoc_temp = $request->input('wget');
				
				$ideven = $request->input('id_evento');

				$cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0 ;
				$cldoc= GeneralHelper::lara_desencriptar( $cldoc_temp );	
				//$cldoc= 1;

				
				$ideven = isset($ideven) ? urldecode($ideven) : 0 ;
				$idevendesc=  GeneralHelper::lara_desencriptar( $ideven );	
				//$idevendesc= 5;
				
 
				//dd($cldoc."<br/>". $idevendesc  );

				$resultsxx = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id='.$idevendesc.'');


        
				if($cldoc>0 && $idevendesc>0)
				{     

					// si todo va bien 
				
							$results = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$idevendesc)->get();
							
                
							if (count($results) >0 )
							{
								
								$results2 = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$idevendesc)->where('status',1)->get();
              
                 //dd($results2);
                
								$carbon = new \Carbon\Carbon();
								$date = $carbon->now();
								$dateServer = $date->format('Y-m-d');
				

								$startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha1"]) )->format('Y-m-d');
								$endDate =$carbon::createFromFormat('Y-m-d H:i:s',trim($results2[0]["rangofecha2"]) )->format('Y-m-d');

								if($date > $startDate && $date < $endDate)
								{

									/*
                  $xdato = DB::select("select *  from votantes where id_evento=".$idevendesc." and (cast(aes_decrypt(`asociado`,'xyz123') as char charset utf8mb4)=".$cldoc.")");

									
									if (count($xdato) >0 )
									{

										$detalles = DB::select("SELECT 
											cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) AS `votante`,
											`e`.`id_area` AS `voto_id_area`,
											`c`.`area_etiqueta`AS `voto_area_etiqueta`,
											cast(aes_decrypt(`e`.`aspirante`,'xyz123') as char charset utf8mb4) AS `voto_aspirante`,
											cast(aes_decrypt(`e`.`nombre`,'xyz123') as char charset utf8mb4) AS `voto_nombre`,
											cast(aes_decrypt(`e`.`apellido`,'xyz123') as char charset utf8mb4) AS `voto_apellido`
											from `votos` `e` 
											INNER JOIN votantes AS b ON e.idvotante = b.id
											INNER JOIN conf_areas AS c ON e.id_area = c.id_area
											WHERE 
											cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) = ".$cldoc. " 
											AND `e`.`id_evento` = ".$idevendesc. " 
											ORDER BY `e`.`id_area`,voto_nombre,voto_apellido asc");
										
										//dd($categoriaspapeletas);
										$areas = DB::select("SELECT 
											`e`.`id_area` AS `voto_id_area`,
											`c`.`area_etiqueta` AS `voto_area_etiqueta`
											from `votos` `e` 
											INNER JOIN votantes AS b ON e.idvotante = b.id
											INNER JOIN conf_areas AS c ON e.id_area = c.id_area
											WHERE cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) = ".$cldoc. " 
											AND `e`.`id_evento` = ".$idevendesc. " 
											GROUP BY `e`.`id_area`,`c`.`area_etiqueta`
											ORDER BY `e`.`id_area`,`c`.`area_etiqueta` ASC");									


										$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
										$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Ya realiz&oacute; su voto para este evento</div>";
										return view('votacion::datosvotacion')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc)->with('areas', $areas)->with('detalles', $detalles);									
									}
									else
									{
                    */
              
										$request->session()->put('cldoc', $cldoc);
										$request->session()->put('idevendesc', $idevendesc);
										$request->session()->put('tipoevent', $results2[0]["tipo"] );
                    
                    $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, agencia, ocupacion,profesion from data_clientes WHERE clasoc = ".$cldoc. " ");
                    //dd($datoscliente[0]->ocupacion);
                  
                  
                    
                  $xdatoassitencia = DB::select("select *  from asistencia where id_evento=".$idevendesc." and num_cliente=".$cldoc."");
                    
                  //dd(count($xdatoassitencia));

									  if (count($xdatoassitencia) <=0 )
									  {
               
										$detalles = DB::select("SELECT num_cliente,trato,nombre,agencia from asistencia WHERE num_cliente = ".$cldoc. " AND id_evento = ".$idevendesc. "");

										$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Esta todo listo!</h3></div>";
										$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'> ".trim($datoscliente[0]->trato)."&nbsp;". trim($datoscliente[0]->nombre)."; ya su asistencia a sido recibida</div>";
                       //  dd(($request->all()));                  
										return view('cliente::index')->with('enlace', $request->all() )->with('mensaje', $mensaje)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"] )->with('id_evento', $idevendesc )->with('f_inicia', $results2[0]["rangofecha1"] )->with('f_termina', $results2[0]["rangofecha2"] )->with('num_cliente', $cldoc )->with('ocupacion', trim($datoscliente[0]->ocupacion) )->with('profesion', trim($datoscliente[0]->profesion) )->with('trato', trim($datoscliente[0]->trato) )->with('nombre', trim($datoscliente[0]->nombre) )->with('agencia', trim($datoscliente[0]->agencia) );	 										
									  }
                  
                  
                  
                  
										$categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = ".$idevendesc. "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");

										$listadoaspirantes = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b on a.id_delegado = b.id_delegado where b.id_evento= ".$idevendesc. " and  a.estado=1 order by a.apellido asc");									
                    
               
                    $datosfoto = DB::select("SELECT * FROM directivos where num_cliente=".$cldoc."");

  									if (count($datosfoto) >0 )
									  {  
                      $tienefoto = 1;
                      $tipo = $datosfoto[0]->tipo;
                      $foto =  $datosfoto[0]->foto;
                    }
                    else
                    {
                      $tienefoto = 0;
                      $tipo = "data:image/png;";
                      $foto = "../../images/logo-footer.png";                    
                    }
										return view('cliente::tablero')->with('enlace', $request->all() )->with('tienefoto', $tienefoto)->with('tipo', $tipo)->with('foto', $foto)->with('aspirantes', $listadoaspirantes)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"] )->with('id_evento', $idevendesc )->with('ideven', $idevendesc )->with('max_votos', $results2[0]["maxvotos"] )->with('f_inicia', $results2[0]["rangofecha1"] )->with('f_termina', $results2[0]["rangofecha2"] )->with('num_cliente', $cldoc )->with('ocupacion', trim($datoscliente[0]->ocupacion) )->with('profesion', trim($datoscliente[0]->profesion) )->with('trato', trim($datoscliente[0]->trato) )->with('nombre', trim($datoscliente[0]->nombre) )->with('agencia', trim($datoscliente[0]->agencia) );	 										
									//}
								}
								else
								{
									$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
									$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Periodo no est&aacute; dentro del rango habilitado</div>";
									return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc);
								}
							}
							else
							{
									$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
									$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Evento no existe actualmente o esta inactivo</div>";
									return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc);
							
							}

				}
				else
				{
					$mensaje = "";
					$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
					if($idevendesc==0){
						$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de evento no fue reconocido</div>";
					}
					if($cldoc==0){
						$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de su número de invitaci&oacute;n</div> ";
					}

					
					return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc);
				}

        	//return view('cliente::tablero');

  
        //return view('cliente::index');
      //return view('cliente::tablero');
    }
  
  
  
  
    public function guardaasistencia(Request $request)
    {
            $files = $request->input('datos');
          $osi = json_decode($files);    
								$results2 = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$osi->id_evento)->get();
                $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, agencia, ocupacion,profesion from data_clientes WHERE clasoc = ".$osi->num_cliente. " ");
      
               //dd($results2[0]["rangofecha2"]);
     // dd($datoscliente[0]->num_cliente);
          // 1ro REALIZAR LA PETICION A API DE ZOOM PARA REGISTRASE Y OBTENER LOS SIGUIENTES CAMPOS
          // URL DE O LINK DE REUNION DE ZOOM PARA PERSONALIZADO PARA ESTE USUARIO Y GUARDARLO EN TABLA ASISTENCIA IGUALMENTE UN CAMPO CON ID RE REGISTRO DE ZOOM
      

DB::statement("INSERT INTO asistencia 
(id_evento, tipoevent,  num_cliente, nombre, agencia, asistire, f_asistire_regis, soy_aspirante, cantidato_delegado, junta_directores, junta_vigilancia, comite_credito,veri_zoom_email) 
VALUES (".$osi->id_evento.",".$osi->tipoevent.",".$osi->num_cliente.",'".$osi->nombre."','".$osi->agencia."',".$osi->asistire.",'".$osi->f_asistire_regis."',".$osi->soy_aspirante.",".$osi->cantidato_delegado.",".$osi->junta_directores.",".$osi->junta_vigilancia.",".$osi->comite_credito.",'".$osi->veri_zoom_email_01."')");


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


                
								$carbon = new \Carbon\Carbon();
								$date = $carbon->now();
								$dateServer = $date->format('Y-m-d');

								$startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha1"]) )->format('Y-m-d');
								$endDate =$carbon::createFromFormat('Y-m-d H:i:s',trim($results2[0]["rangofecha2"]) )->format('Y-m-d');
      
      
					//dd($registrosenvio);
					// obtengo el asunto y cuerpo del correo de invitacion
						//dd( $documento_resultados);

					$contenido = '<!DOCTYPE html>
						<html>
						 <head>
						  <title>Confirmación</title>
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
						  
              <img src="https://portal.cooprofesionales.com.pa/mercadeo/files/333f41_newlogo1.png" style="width: 970px;">
							<h1>'.  $time. '; '.trim($datoscliente[0]->trato).' '.trim($datoscliente[0]->nombre).'. <br/> Esta es la confirmaci&oacute;n de registro para:  '.trim($results2[0]["nombre"]).' </h1>


				       <br/>
               Puedes acceder a el siguiente v&iacute;nculo para acceder al &aacute;rea de usuarios.
               <br/>
							 <a href="'.env('APP_URL', '127.0.0.1').'/cliente/?wget='. GeneralHelper::lara_encriptar( $osi->num_cliente ).'&id_evento='. GeneralHelper::lara_encriptar( $osi->id_evento  ) .'"> 
                  Enlace 
               </a>

 
						  </div>
						 </body>
						</html>';
			
			      $configuraciones=DB::select('select modo,correopruebas from conf');
          
						if($configuraciones[0]->modo == 0)
						{
							$correenviar = $configuraciones[0]->correopruebas;		
						}
						else
						{
							 $correenviar = $osi->veri_zoom_email_01;
						}

						$details =[
							'title' => 'Confirmación de registro ',
							'body' => $contenido,
							'num_cliente' => $osi->num_cliente,
							'nombre' => $osi->nombre,
							'correo' => $correenviar ,
							'contenido' => $contenido
						];
	
						Mail::send([], [], function($message) use ($details) {
							$message->from(env('MAIL_USERNAME' ));
							$message->to($details["correo"]);
							$message->subject($details["title"]);
							$message->setBody($details["contenido"] , 'text/html');
						});		        


    }
  

     public function alldatadirectivos(Request $request)
    {
           try
           {
				   $evento = $request->input('evento');
           $data = vtaspiranteModel::select(['id_evento','id_delegado','trato','num_cliente','nombre','apellido','ocupacion','profesion','img_delegado','estado','user_audit','fecha_aud','foto','tipo'])->where('id_evento',$evento)->get();

				   return $data;
                   //return json_decode(json_encode($data),true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	 
  

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cliente::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('cliente::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cliente::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
  
  
      public function cargaadjuntosScreenListar(Request $request)
    {
        try {
              $id_evento = $request->input('id_evento');
              $cldoc = $request->input('cldoc');
              $data = files_up_Model::select(['etiqueta','fecha_upload','id'])
              ->where('cldoc', '=', $cldoc )->where('id_evento', '=', $id_evento)->where('eliminado', '=', 0)->get();
              //$arreglo = json_decode(json_encode($data), true);
              $arreglo = json_encode($data, JSON_FORCE_OBJECT);
              //return $arreglo;
              return $data;
        } catch (Exception $e) {
                          return json(array('error'=> $e->getMessage()));
        }
    }
  
     public function upload(Request $request)
      {

        try 
        {
          Auth::loginUsingId(3);
          //dd(Auth::user());

          $file = $request->file('file');
          $id_evento = $request->input('up_id_evento');
          
          $nombrefile = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();

          $tipoarchivo = $file->getMimeType();

          $nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);

          //return $nombre;
          //return env('UPLOADDIR');
          
          $upload_success=$file->move(base_path('/public/adjuntos/'),$nombre);
          //$upload_success=$file->move(base_path('\adjuntos'),$file->getClientOriginalName());
          //return $upload_success;
          
   
          if ($upload_success) {
            $peso = filesize(base_path('/public/adjuntos/').$nombre);
             
            \DB::connection('mysql')->statement('call pr_subir_file (?,?,?,?,?,?,?)', array($id_evento,$request->session()->get('cldoc'),strtolower($nombrefile),strtolower($nombre),strtolower($extension),$tipoarchivo,$peso));
             return $nombre;
          }
          else {
            $response = array(
                'resabit' => '0001',
                'status' => 'Listado ERR',
                'error' => 'No se pudo adjuntar'
           );
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
