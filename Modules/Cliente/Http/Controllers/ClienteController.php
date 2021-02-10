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
										return view('cliente::tablero')->with('tienefoto', $tienefoto)->with('tipo', $tipo)->with('foto', $foto)->with('aspirantes', $listadoaspirantes)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"] )->with('id_evento', $idevendesc )->with('ideven', $idevendesc )->with('max_votos', $results2[0]["maxvotos"] )->with('f_inicia', $results2[0]["rangofecha1"] )->with('f_termina', $results2[0]["rangofecha2"] )->with('num_cliente', $cldoc )->with('ocupacion', trim($datoscliente[0]->ocupacion) )->with('profesion', trim($datoscliente[0]->profesion) )->with('trato', trim($datoscliente[0]->trato) )->with('nombre', trim($datoscliente[0]->nombre) )->with('agencia', trim($datoscliente[0]->agencia) );	 										
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
DB::statement("INSERT INTO asistencia 
(id_evento, tipoevent,  num_cliente, nombre, agencia, asistire, f_asistire_regis, soy_aspirante, cantidato_delegado, junta_directores, junta_vigilancia, comite_credito) 
VALUES (".$osi->id_evento.",".$osi->tipoevent.",".$osi->num_cliente.",'".$osi->nombre."','".$osi->agencia."',".$osi->asistire.",'".$osi->f_asistire_regis."',".$osi->soy_aspirante.",".$osi->cantidato_delegado.",".$osi->junta_directores.",".$osi->junta_vigilancia.",".$osi->comite_credito.")");

  
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
}
