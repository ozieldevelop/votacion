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
use Modules\Cliente\Entities\adjuntos_Model;
use DB;
use Auth;
use Illuminate\Contracts\Session\Session;
use Config;
use Illuminate\Support\Facades\Mail;
use Validator;
use Storage;
use Response;

class ClienteController extends Controller
{

  

    public function index(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $dateServer = $date->format('Y-m-d');

        //$cldoc_temp = $request->input('wget');

        $ideven = $request->input('id_evento');

        //$cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0;
        //$cldoc = GeneralHelper::lara_desencriptar($cldoc_temp);
        
        $cldoc = 0;

       // $ideven = isset($ideven) ? urldecode($ideven) : 0;
        //$idevendesc = GeneralHelper::lara_desencriptar($ideven);
      
        $idevendesc = 1;

        $results = eventoModel::select(['id', 'nombre', 'preinscripActivo', 'rangofecha1', 'rangofecha2', 'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo'])
            ->where('id', $idevendesc)
            ->where('status', 1)
            ->get();

        $startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results[0]["rangofecha1"]))->format('Y-m-d H:i:s');
        $endDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results[0]["rangofecha2"]))->format('Y-m-d H:i:s');

        if ($date > $startDate && $date < $endDate) {
            $periactico = 1;
        } else {
            $periactico = 0;
        }

              if ( $results[0]["preinscripActivo"] == 1) 
              {
                  $periacticoFormulario = 1;
              } else {
                  $periacticoFormulario = 0;
                  $request->session()->flush();
                  $mensaje = "";
                  $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                  $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>El periodo de inscripci&oacute;n a puestos directivos ha finalizado.</div> ";
                  return view('votacion::advertencia')
                      ->with('mensaje', $mensaje)
                      ->with('enlace', $request->all())
                      ->with('nombre', '')
                      ->with('ideven', '');
              }                        
    //dd($cldoc ."  " .$idevendesc);

    if ($cldoc == 0 && $idevendesc > 0) {

            if (count($results) > 0) {

                //$results2 = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$idevendesc)->where('status',1)->get();
                if ($results[0]["tipo"] == 1) {



                    $xdato2 = DB::select("select * from asistencia where id_evento=" . $idevendesc . " and num_cliente=" . $cldoc . " and asistire = 1  ");

                    //$direccionimagenperfil = "../../images/logo-footer.png";
                    

                    Auth::loginUsingId(3);
                  
                    return view('cliente::confirmada_asistencia_capitular')
                        ->with('periactico', $periactico)
                        ->with('enlace', $request->all())
                        ->with('mensaje', $mensaje)
                        ->with('nombreevento', trim($results[0]["nombre"]))
                        ->with('tipoevent', $results[0]["tipo"])
                        ->with('id_evento', $idevendesc)
                        ->with('f_inicia', $results[0]["rangofecha1"])
                        ->with('f_termina', $results[0]["rangofecha2"]);

                        /*  return view('cliente::confirmada_asistencia_capitular')
                              ->with('periactico', $periactico)
                              ->with('cldoc', $cldoc)
                              ->with('existecuentazoom', $existecuentazoom)
                              ->with('cuentazoom', $cuentazoom)
                              ->with('existencia', $elasistira)
                              ->with('foto', $direccionimagenperfil)
                              ->with('enlace', $request->all())
                              ->with('mensaje', $mensaje)
                              ->with('nombreevento', trim($results[0]["nombre"]))
                              ->with('tipoevent', $results[0]["tipo"])
                              ->with('id_evento', $idevendesc)
                              ->with('f_inicia', $results[0]["rangofecha1"])
                              ->with('f_termina', $results[0]["rangofecha2"])
                              ->with('num_cliente', $cldoc)
                              ->with('ocupacion', trim($datoscliente[0]->ocupacion))
                              ->with('profesion', trim($datoscliente[0]->profesion))
                              ->with('trato', trim($datoscliente[0]->trato))
                              ->with('nombre', trim($datoscliente[0]->NOMBRE))
                              ->with('fecha_nac', trim($datoscliente[0]->fecha_nac))
                              ->with('agencia', trim($datoscliente[0]->AGENCIA));
                        */

               
                } else {

                    $mensaje = "";
                    $elasistira = 1;

                    $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;font-size:33px;font-weight: bold;'>REGISTRO A PUESTOS DIRECTIVOS</div>";

                    Auth::loginUsingId(3);


                    return view('cliente::confirmada_asistencia_asamblea')
                        //->with('id_delegado', $referenciafoto[0]->id_sec)
                        //->with('asistire', $xdato[0]->asistire)
                        //->with('id_asistencia', $xdato[0]->id_asistencia)
                        //->with('soy_aspirante', $xdato[0]->soy_aspirante)
                        //->with('cantidato_delegado', $xdato[0]->cantidato_delegado)
                        //->with('junta_directores', $xdato[0]->junta_directores)
                        //->with('junta_vigilancia', $xdato[0]->junta_vigilancia)
                        //->with('comite_credito', $xdato[0]->comite_credito)
                        //->with('veri_zoom_email', $xdato[0]->veri_zoom_email)
                        ->with('periactico', $periactico)
                        //->with('cldoc', $cldoc)
                        //->with('existecuentazoom', $existecuentazoom)
                        //->with('cuentazoom', $cuentazoom)
                        //->with('foto', $direccionimagenperfil)
                        ->with('enlace', $request->all())
                        ->with('mensaje', $mensaje)
                        ->with('nombreevento', trim($results[0]["nombre"]))
                        ->with('tipoevent', $results[0]["tipo"])
                        ->with('id_evento', $idevendesc)
                        ->with('f_inicia', $results[0]["rangofecha1"])
                        ->with('f_termina', $results[0]["rangofecha2"]);
                        //->with('num_cliente', $cldoc)
                        //->with('ocupacion', trim($datoscliente[0]->ocupacion))
                        //->with('profesion', trim($datoscliente[0]->profesion))
                       // ->with('trato', trim($datoscliente[0]->trato))
                       // ->with('nombre', trim($datoscliente[0]->NOMBRE))
                       // ->with('agencia', trim($datoscliente[0]->AGENCIA));
                }
            } 
            else 
            {
                $request->session()->flush();
                $mensaje = "";
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Evento no exite o esta desactivado</div> ";
                return view('votacion::advertencia')
                    ->with('mensaje', $mensaje)
                    ->with('enlace', $request->all())
                    ->with('nombre', '')
                    ->with('ideven', '');
            }
        } else {
            $request->session()->flush();
            $mensaje = "sssss";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
            if ($idevendesc == 0) {
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de evento no fue reconocido</div>";
            }
            return view('votacion::advertencia')
                ->with('mensaje', $mensaje)
                ->with('enlace', $request->all())
                ->with('nombre', "")
                ->with('ideven', $idevendesc);
        }

    }
  
  
  
  /*
    public function index(Request $request)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $dateServer = $date->format('Y-m-d');

        $cldoc_temp = $request->input('wget');

        $ideven = $request->input('id_evento');

        $cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0;
        $cldoc = GeneralHelper::lara_desencriptar($cldoc_temp);

        $ideven = isset($ideven) ? urldecode($ideven) : 0;
        $idevendesc = GeneralHelper::lara_desencriptar($ideven);

        $results = eventoModel::select(['id', 'nombre', 'preinscripActivo', 'rangofecha1', 'rangofecha2', 'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo'])
            ->where('id', $idevendesc)
            ->where('status', 1)
            ->get();

        $startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results[0]["rangofecha1"]))->format('Y-m-d H:i:s');
        $endDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results[0]["rangofecha2"]))->format('Y-m-d H:i:s');

        if ($date > $startDate && $date < $endDate) {
            $periactico = 1;
        } else {
            $periactico = 0;
        }

              if ( $results[0]["preinscripActivo"] == 1) 
              {
                  $periacticoFormulario = 1;
              } else {
                  $periacticoFormulario = 0;
                  $request->session()->flush();
                  $mensaje = "";
                  $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                  $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Periodo de actualización de datos a expirado</div> ";
                  return view('votacion::advertencia')
                      ->with('mensaje', $mensaje)
                      ->with('enlace', $request->all())
                      ->with('nombre', '')
                      ->with('ideven', '');
              }                        


        if ($cldoc > 0 && $idevendesc > 0) {

            if (count($results) > 0) {


                $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, agencia, ocupacion,profesion, fecha_nac from data_clientes_vt WHERE clasoc = " . $cldoc . " ");

                //$results2 = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$idevendesc)->where('status',1)->get();
                if ($results[0]["tipo"] == 1) {

                    $xdato = DB::select("select * from asistencia where id_evento=" . $idevendesc . " and num_cliente=" . $cldoc . "  ");
                    
                    if (count($xdato) > 0) {
                        $existecuentazoom = "";
                        if (strlen(trim($xdato[0]->veri_zoom_email)) > 0) {
                            $cuentazoom = $xdato[0]->veri_zoom_email;
                            $existecuentazoom = 1;
                        } else {
                            $cuentazoom = '';
                            $existecuentazoom = 0;
                        }
                    } else {
                        $cuentazoom = '';
                        $existecuentazoom = 0;
                    }

                    $xdato2 = DB::select("select * from asistencia where id_evento=" . $idevendesc . " and num_cliente=" . $cldoc . " and asistire = 1  ");

                    
                    if (count($xdato2) > 0) 
                    {
                          $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h2>Muchas gracias por confirmar tu asistencia!</h2></div>";
                          $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h4>Te esperamos</h4></div>";                      
                          $elasistira = 1;
                    } 
                    else {                        
                          $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h2>Confirma tu asistencia!</h2></div>";
                          $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h4>Estas cordialmente invitado,</h4></div>";
                          $elasistira = 0;
                    }

                    $direccionimagenperfil = "../../images/logo-footer.png";
                    $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'> <h3><i> " . trim($datoscliente[0]->trato) ."." ."&nbsp;" . trim($datoscliente[0]->NOMBRE) . "</i></h3></div>";

                    Auth::loginUsingId(3);
                    return view('cliente::confirmada_asistencia_capitular')
                        ->with('periactico', $periactico)
                        ->with('cldoc', $cldoc)
                        ->with('existecuentazoom', $existecuentazoom)
                        ->with('cuentazoom', $cuentazoom)
                        ->with('existencia', $elasistira)
                        ->with('foto', $direccionimagenperfil)
                        ->with('enlace', $request->all())
                        ->with('mensaje', $mensaje)
                        ->with('nombreevento', trim($results[0]["nombre"]))
                        ->with('tipoevent', $results[0]["tipo"])
                        ->with('id_evento', $idevendesc)
                        ->with('f_inicia', $results[0]["rangofecha1"])
                        ->with('f_termina', $results[0]["rangofecha2"])
                        ->with('num_cliente', $cldoc)
                        ->with('ocupacion', trim($datoscliente[0]->ocupacion))
                        ->with('profesion', trim($datoscliente[0]->profesion))
                        ->with('trato', trim($datoscliente[0]->trato))
                        ->with('nombre', trim($datoscliente[0]->NOMBRE))
                        ->with('fecha_nac', trim($datoscliente[0]->fecha_nac))
                        ->with('agencia', trim($datoscliente[0]->AGENCIA));

               
                } else {

                    $mensaje = "";
                    $elasistira = 1;

                    $referenciafoto = DB::select(
                        "SELECT id_delegado as id_sec,COUNT(num_cliente) AS existencia , num_cliente as cldoc,CASE WHEN foto IS NULL THEN 0 WHEN foto IS NOT NULL THEN 1 END AS tienefoto,foto,tipo from directivos WHERE num_cliente = " .
                            $cldoc .
                            " "
                    );
                    

                  
                    $xdato = DB::select("select * from asistencia where id_evento=" . $idevendesc . " and num_cliente=" . $cldoc . "  ");

                    if ($xdato[0]->asistire == 1) {
                        $existecuentazoom = "";
                        if (strlen(trim($xdato[0]->veri_zoom_email)) > 0) {
                            $cuentazoom = $xdato[0]->veri_zoom_email;
                            $existecuentazoom = 1;
                        } else {
                            $cuentazoom = '';
                            $existecuentazoom = 0;
                        }
                        $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;font-size:33px;font-weight: bold;'>Sus datos estar&aacute;n siendo revisados; para luego ser incluidos</div>";

                    } else {
                        $cuentazoom = '';
                        $existecuentazoom = 0;
                        $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;font-size:33px;font-weight: bold;'>REGISTRO A PUESTOS DIRECTIVOS</div>";
                    }

                    if ($referenciafoto[0]->tienefoto == 1) {
                        $direccionimagenperfil = $referenciafoto[0]->tipo . "base64," . $referenciafoto[0]->foto;
                    } else {
                        $direccionimagenperfil = "../../images/logo-footer.png";
                    }


                    $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'> " . trim($datoscliente[0]->trato) . "&nbsp;" . trim($datoscliente[0]->NOMBRE) . "</div>";
                    Auth::loginUsingId(3);


                    return view('cliente::confirmada_asistencia_asamblea')
                        ->with('id_delegado', $referenciafoto[0]->id_sec)
                        ->with('asistire', $xdato[0]->asistire)
                        ->with('id_asistencia', $xdato[0]->id_asistencia)
                        ->with('soy_aspirante', $xdato[0]->soy_aspirante)
                        ->with('cantidato_delegado', $xdato[0]->cantidato_delegado)
                        ->with('junta_directores', $xdato[0]->junta_directores)
                        ->with('junta_vigilancia', $xdato[0]->junta_vigilancia)
                        ->with('comite_credito', $xdato[0]->comite_credito)
                        ->with('veri_zoom_email', $xdato[0]->veri_zoom_email)
                        ->with('periactico', $periactico)
                        ->with('cldoc', $cldoc)
                        ->with('existecuentazoom', $existecuentazoom)
                        ->with('cuentazoom', $cuentazoom)
                        ->with('foto', $direccionimagenperfil)
                        ->with('enlace', $request->all())
                        ->with('mensaje', $mensaje)
                        ->with('nombreevento', trim($results[0]["nombre"]))
                        ->with('tipoevent', $results[0]["tipo"])
                        ->with('id_evento', $idevendesc)
                        ->with('f_inicia', $results[0]["rangofecha1"])
                        ->with('f_termina', $results[0]["rangofecha2"])
                        ->with('num_cliente', $cldoc)
                        ->with('ocupacion', trim($datoscliente[0]->ocupacion))
                        ->with('profesion', trim($datoscliente[0]->profesion))
                        ->with('trato', trim($datoscliente[0]->trato))
                        ->with('nombre', trim($datoscliente[0]->NOMBRE))
                        ->with('agencia', trim($datoscliente[0]->AGENCIA));
                }
            } else {
                $request->session()->flush();
                $mensaje = "";
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Evento no exite o esta desactivado</div> ";
                return view('votacion::advertencia')
                    ->with('mensaje', $mensaje)
                    ->with('enlace', $request->all())
                    ->with('nombre', '')
                    ->with('ideven', '');
            }
        } else {
            $request->session()->flush();
            $mensaje = "";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
            if ($idevendesc == 0) {
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de evento no fue reconocido</div>";
            }
            if ($cldoc == 0) {
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de su número de invitaci&oacute;n</div> ";
            }

            return view('votacion::advertencia')
                ->with('mensaje', $mensaje)
                ->with('enlace', $request->all())
                ->with('nombre', $resultsxx[0]->nombre)
                ->with('ideven', $idevendesc);
        }

    }
  */

    function almacenarfilecv(Request $request)
    {
        $id_retorno = '';

        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:pdf,docx,jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validation->passes()) {
            $image = $request->file('select_file');
            $extension = $image->getClientOriginalExtension();
            $tipoarchivo = $image->getMimeType();
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);
            //$image->move(public_path('images'), $new_name);
            $upload_success = $image->move(base_path('public/adjuntos'), $new_name);

            if ($upload_success) {
                //$nombrefile = $image->getClientOriginalName();

                //dd( $tipoarchivo );
                //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);

                $peso = filesize(base_path('/public/adjuntos/') . $new_name);

                $entidad = new adjuntos_Model();
                $entidad->name_system = trim($new_name);
                $entidad->etiqueta = 'Hoja de Vida';
                $entidad->extension = $extension;
                $entidad->tipoarchivo = $tipoarchivo;
                $entidad->sizefile = $peso;
                $entidad->save();
                //dd($entidad->id);
                // \DB::connection('mysql')->statement('call pr_subir_file (?,?,?,?,?,?,?)', array($id_evento,$request->session()->get('cldoc'),strtolower($nombrefile),strtolower($nombre),strtolower($extension),$tipoarchivo,$peso));
                $id_retorno = $entidad->id;
            }

            return response()->json([
                'message' => 'Documento Adjuntado',
                'uploaded_doc' => '../../../adjuntos/' . $new_name,
                'id_uploaded_doc' => $id_retorno,
                'class_name' => 'alert-success',
            ]);
        } else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'uploaded_doc' => '',
                'id_uploaded_doc' => $id_retorno,
                'class_name' => 'alert-danger',
            ]);
        }
    }

    public function dashboard(Request $request)
    {
        //Auth::logout();
        //$request->session()->flush();

        //                        Auth::loginUsingId(3);
        $cldoc_temp = $request->input('wget');

        $ideven = $request->input('id_evento');

        $cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0;
        $cldoc = GeneralHelper::lara_desencriptar($cldoc_temp);
        //$cldoc= 1;
      
        $ideven = isset($ideven) ? urldecode($ideven) : 0;
        $idevendesc = GeneralHelper::lara_desencriptar($ideven);
        //$idevendesc= 5;

        //dd($cldoc."<br/>". $idevendesc  );

        $resultsxx = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id=' . $idevendesc . '');

        if ($cldoc > 0 && $idevendesc > 0) {
            // si todo va bien

            $results = eventoModel::select(['id', 'nombre',  'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo'])
                ->where('id', $idevendesc)
                ->get();

            if (count($results) > 0) {
                $results2 = eventoModel::select(['id', 'nombre',  'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo'])
                    ->where('id', $idevendesc)
                    ->where('status', 1)
                    ->get();

              
  
              
                   if ($results2[0]["votacionActivo"]==1)
                   {   
                       $pactivo = 1;
                   } else {
                       $pactivo = 0;
                   } 
                     
                //dd($results2);

                /*$carbon = new \Carbon\Carbon();
                $date = $carbon->now();
                $dateServer = $date->format('Y-m-d');
        
                $startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha1"]))->format('Y-m-d');
                $endDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha2"]))->format('Y-m-d');
                $pactivo = 0;
                if ($date > $startDate && $date < $endDate) {
                    $pactivo = 1;
                } else {
                    $pactivo = 0;
                }*/

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
                $request->session()->put('tipoevent', $results2[0]["tipo"]);

                $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, agencia, ocupacion,profesion from data_clientes_vt WHERE clasoc = " . $cldoc . " ");
                //dd($datoscliente[0]->ocupacion);
          
                /*
                $xdatoassitencia = DB::select("select *  from asistencia where id_evento=" . $idevendesc . " and num_cliente=" . $cldoc . "");


                if (count($xdatoassitencia) <= 0) {
                    $detalles = DB::select("SELECT num_cliente,trato,nombre,agencia from asistencia WHERE num_cliente = " . $cldoc . " AND id_evento = " . $idevendesc . "");

                    $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Esta todo listo!</h3></div>";
                    $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'> " . trim($datoscliente[0]->trato) . "&nbsp;" . trim($datoscliente[0]->NOMBRE) . "; ya su asistencia a sido recibida</div>";
                    //  dd(($request->all()));
                    return view('cliente::index')
                        ->with('enlace', $request->all())
                        ->with('mensaje', $mensaje)
                        ->with('nombreevento', trim($results2[0]["nombre"]))
                        ->with('tipoevent', $results2[0]["tipo"])
                        ->with('id_evento', $idevendesc)
                        ->with('f_inicia', $results2[0]["rangofecha1"])
                        ->with('f_termina', $results2[0]["rangofecha2"])
                        ->with('num_cliente', $cldoc)
                        ->with('ocupacion', trim($datoscliente[0]->ocupacion))
                        ->with('profesion', trim($datoscliente[0]->profesion))
                        ->with('trato', trim($datoscliente[0]->trato))
                        ->with('nombre', trim($datoscliente[0]->NOMBRE))
                        ->with('agencia', trim($datoscliente[0]->AGENCIA));
                }
                */

                $categoriaspapeletas = DB::select(
                    "SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = " .
                        $idevendesc .
                        "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento"
                );

                $listadoaspirantes = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b on a.id_delegado = b.id_delegado where b.id_evento= " . $idevendesc . " and  a.estado=1 GROUP BY num_cliente order by a.apellido asc");
                
                //dd($listadoaspirantes);
                $datosfoto = DB::select("SELECT * FROM directivos where num_cliente=" . $cldoc . "");

                if (count($datosfoto) > 0) {
                    $tienefoto = 1;
                    $tipo = $datosfoto[0]->tipo;
                    $foto = $datosfoto[0]->foto;
                } else {
                    $tienefoto = 0;
                    $tipo = "data:image/png;";
                    $foto = "../../images/logo-footer.png";
                }
                //dd($pactivo);
                return view('cliente::tablero')
                    ->with('periodoactivo', $pactivo)
                    ->with('enlace', $request->all())
                    ->with('tienefoto', $tienefoto)
                    ->with('tipo', $tipo)
                    ->with('foto', $foto)
                    ->with('aspirantes', $listadoaspirantes)
                    ->with('nombreevento', trim($results2[0]["nombre"]))
                    ->with('tipoevent', $results2[0]["tipo"])
                    ->with('id_evento', $idevendesc)
                    ->with('ideven', $idevendesc)
                    ->with('max_votos', $results2[0]["maxvotos"])
                    ->with('f_inicia', $results2[0]["rangofecha1"])
                    ->with('f_termina', $results2[0]["rangofecha2"])
                    ->with('num_cliente', $cldoc)
                    ->with('ocupacion', trim($datoscliente[0]->ocupacion))
                    ->with('profesion', trim($datoscliente[0]->profesion))
                    ->with('trato', trim($datoscliente[0]->trato))
                    ->with('nombre', trim($datoscliente[0]->NOMBRE))
                    ->with('agencia', trim($datoscliente[0]->AGENCIA));
                //}
                /*}
								else
								{
									$mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
									$mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Periodo no est&aacute; dentro del rango habilitado</div>";
									return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)->with('ideven', $idevendesc);
								}*/
            } else {
                $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Evento no existe actualmente o esta inactivo</div>";
                return view('votacion::advertencia')
                    ->with('mensaje', $mensaje)
                  ->with('enlace', $request->all())
                    ->with('nombre', $resultsxx[0]->nombre)
                    ->with('ideven', $idevendesc);
            }
        } else {
            $mensaje = "";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
            if ($idevendesc == 0) {
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de evento no fue reconocido</div>";
            }
            if ($cldoc == 0) {
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de su número de invitaci&oacute;n</div> ";
            }

            return view('votacion::advertencia')
                ->with('mensaje', $mensaje)
              ->with('enlace', $request->all())
                ->with('nombre', $resultsxx[0]->nombre)
                ->with('ideven', $idevendesc);
        }

        //return view('cliente::tablero');

        //return view('cliente::index');
        //return view('cliente::tablero');
    }

  
  
  



    public function guardaasistenciaasamblea(Request $request)
    {
        // recibo los parametros

        $files = $request->input('datos');//dd($files);
        $osi = json_decode($files);
        
        //dd($osi);
      
        $memoria = $osi->memoria ? $osi->memoria : '';
        $experiencia =  $osi->experiencia ? $osi->experiencia : '' ;
      
        $id_cv = $osi->id_cv;
        $avatarBase64 =$osi->avatarBase64 ? $osi->avatarBase64 : '' ;
        $tipo_imagen = $osi->tipo_imagen;
        $elnombre = $osi->nombre_asoc;
      
        $retorno = "";
      
        $results2 = eventoModel::select(['id', 'nombre', 'rangofecha1', 'rangofecha2', 'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo', 'veri_id_zoom'])
            ->where('id', $osi->id_evento)
            ->get();
        
        $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, fecha_nac, agencia, ocupacion,profesion from data_clientes_vt WHERE clasoc = " . $osi->num_cliente . " ");
      
        $xdato = DB::select("select * from asistencia where id_evento=" .$osi->id_evento . " and num_cliente=" . $osi->num_cliente . "");

        if (count($xdato) == 0) 
        {
            
        $valjd = 0;
        $valjv = 0;
        $valcc = 0;
      
          if ($osi->junta_directores == 1) {
              $valjd = 1;
          }
          if ($osi->junta_vigilancia == 1) {
              $valjv = 1;
          }
          if ($osi->comite_credito == 1) {
              $valcc = 1;
          }  
          
            DB::statement(
                "INSERT INTO asistencia (id_evento, tipoevent,  num_cliente, nombre, agencia, trato, fecha_nacimiento, asistire,junta_directores,junta_vigilancia,comite_credito) VALUES (" .
                    $osi->id_evento.
                    "," .
                    $osi->tipoevent .
                    "," .
                    $osi->num_cliente .
                    ",'" .
                    $elnombre .
                    "','" .
                    $datoscliente[0]->AGENCIA .
                    "','" .
                    $datoscliente[0]->trato .
                    "','" .
                     $datoscliente[0]->fecha_nac .
                    "',1,".$valjd.",".$valjv.",".$valcc.")"
            );
        }
      
        $xdato2 = DB::select("select *  from directivos where num_cliente=" . $osi->num_cliente . "");

      
        if (count($xdato2) == 0) {  
             
                $id_directivo = DB::table('directivos')->insertGetId([
                            'num_cliente' => $osi->num_cliente ,
                            'nombre' => $elnombre,
                            'apellido' => "",
                            'estado' => 0,
                            'user_audit' => 'usuario',
                            'tipo' => $tipo_imagen,
                            'foto' => $avatarBase64,
                            'memoria' => $memoria,
                            'experiencia' => $experiencia,
                            'adjunto' => $id_cv,
                 ]);

         }
            
          
         DB::statement("DELETE from evento_directivos where id_evento = " .$osi->id_evento  . " and id_delegado=" . $id_directivo . "");
        
       // dd($osi->junta_directores);
      
          if ($osi->junta_directores == 1) {
              DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $osi->id_evento . ", " . $id_directivo . ", 2)");
          }
          if ($osi->junta_vigilancia == 1) {
              DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $osi->id_evento . ", " . $id_directivo . ", 3)");
          }
          if ($osi->comite_credito == 1) {
              DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" .$osi->id_evento . ", " . $id_directivo . ", 4)");
          }   
      
        //$retorno = $xdato2[0]->id_delegado;
        return $retorno;

    }
  
  
    public function guardaasistencia(Request $request)
    {
        // recibo los parametros

        $files = $request->input('datos');//dd($files);
        // $osi = json_decode($files);

        if ( $files['tipoevent'] == 2 ) {            
            $memoria = $files['memoria'];
            $experiencia = $files['experiencia'];
            $id_cv = $files['id_cv'];
            $porcion = explode("base64,", $files['avatarBase64']);
            $avatarBase64 = $porcion[1];
            $tipo_imagen = 'data:' . $files['tipo_imagen'] . ';';
        } else {
            $memoria = '';
            $id_cv = '';
            $porcion = '';
            $avatarBase64 = '';
            $tipo_imagen = '';
        }

        //aspiranteModel::where('num_cliente',$osi->num_cliente)->update(['nombre'=> $elnombre, 'apellido'=> $elapellido, 'memoria'=> $memoria, 'adjunto'=> $id_cv, 'foto'=> $id_cv , 'adjunto'=> $id_cv  , 'tipo'=> $tipo_imagen, 'foto' => $avatarBase64   ]);

        // $pieces = explode(" ", $osi->nombre);
        // if (count($pieces) > 0) {
        //     $elnombre = $pieces[0];
        //     $elapellido = $pieces[1];
        // } else {
        //     $elnombre = $osi->nombre;
        //     $elapellido = "_";
        // }

        $elnombre = $files['nombre_asoc'];
        // $elapellido = $files['apellido_asoc'];

        $retorno = "";

        // obtengo los datos del evento

        $results2 = eventoModel::select(['id', 'nombre', 'rangofecha1', 'rangofecha2', 'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo', 'veri_id_zoom'])
            ->where('id', $files['id_evento'])
            ->get();

        // obtengo los datos del master de cliente



        $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, agencia, ocupacion,profesion from data_clientes_vt WHERE clasoc = " . $files['numero_asoc'] . " ");


        // 1ro REALIZAR LA PETICION A API DE ZOOM PARA REGISTRASE Y OBTENER LOS SIGUIENTES CAMPOS
        // URL DE O LINK DE REUNION DE ZOOM PARA PERSONALIZADO PARA ESTE USUARIO Y GUARDARLO EN TABLA ASISTENCIA IGUALMENTE UN CAMPO CON ID RE REGISTRO DE ZOOM

        // CONSULTO SI ESTA EN TABLA -> ASISTENCIA

        $xdato = DB::select("select *  from asistencia where id_evento=" . $files['id_evento'] . " and num_cliente=" . $files['numero_asoc'] . "");
        // dd($xdato);
        if (count($xdato) == 0) {
            // SI NO EXISTE LO INSERTO
            DB::statement(
                "INSERT INTO asistencia (id_evento, tipoevent,  num_cliente, nombre, agencia, trato, fecha_nacimiento, veri_zoom_email,asistire) VALUES (" .
                    $files['id_evento'] .
                    "," .
                    $files['tipoevent'] .
                    "," .
                    $files['numero_asoc'] .
                    ",'" .
                    $files['nombre_asoc'] .
                    "','" .
                    $files['agencia'] .
                    "','" .
                    $files['trato'] .
                    "','" .
                    $files['fecha_nac'] .
                    "','" .
                    // $files['asistire'] .
                    // ",'" .
                    // $files['soy_aspirante'] .
                    // "," .
                    // $files['cantidato_delegado'] .
                    // "," .
                    // $files['junta_directores'] .
                    // "," .
                    // $files['junta_vigilancia'] .
                    // "," .
                    // $files['comite_credito'] .
                    // ",'" .
                    $files['email_confirmation'] . //*
                    "',1)"
            );
        } else {
            // EN CASO DE EXISTIR LO ACTUALIZO - EN TERORIA NO DEBE EXISTIR AQUI YA QUE LA PERSONA UNA VEZ REGISTRADO SOLO TIENE ACCESO PARA ENTRAR EN EL DASHBOARD
            DB::statement(
                "UPDATE asistencia set asistire=" .
                    $files['asistire'] .
                    ", f_asistire_regis='" .
                    $files['f_asistire_regis'] .
                    "',veri_zoom_email='" .
                    $files['email_confirmation'] . //*
                    "' where id_evento=" .
                    $files['id_evento'] .
                    " and num_cliente=" .
                    $files['numero_asoc'] .
                    ""
            );
        }

        DB::statement('update asistencia set veri_id_zoom="' . $results2[0]->veri_id_zoom . '" where id_evento=' . $files['id_evento'] . '');

        if ($files['tipoevent'] == 2) {
            // CONSULTO SI ESTA EN TABLA -> DIRECTIVOS PARA CREARLO AUTOMATICAMENTE PERO MANTENERLO EN US STATUS PENDIENTE
            if ($files['junta_directores'] == 1 || $files['junta_vigilancia'] == 1 || $files['comite_credito'] == 1) {

                $xdato2 = DB::select("select *  from directivos where num_cliente=" . $files['numero_asoc'] . "");

                if (count($xdato2) == 0) {
                    // SI NO EXISTE LO INSERTO
                    //DB::statement("INSERT INTO directivos (num_cliente, nombre,  user_audit) VALUES (".$osi->num_cliente.", '".$osi->nombre."',0, 'sistema')");
                    $id_directivo = DB::table('directivos')->insertGetId([
                        'num_cliente' => $files['numero_asoc'],
                        'nombre' => $elnombre,
                        'apellido' => $elapellido,
                        'estado' => 0,
                        'user_audit' => 'sistema',
                        'tipo' => $tipo_imagen,
                        'foto' => $avatarBase64,
                        'memoria' => $memoria,
                        'experiencia' => $experiencia,
                        'adjunto' => $id_cv,
                    ]);
                    // CONSULTO QUE TIPO DE EVENTO ES
                    if ($files['tipoevent'] == 1) {
                        //DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (".$osi->id_evento.", ".$id_directivo.", 1)" );
                    } else {
                        aspiranteModel::where('num_cliente', $files['numero_asoc'])->update(['experiencia' => $memoria,'memoria' => $memoria, 'adjunto' => $id_cv, 'foto' => $avatarBase64, 'tipo' => $tipo_imagen]);
                        DB::statement("DELETE from evento_directivos where id_evento = " . $files['id_evento'] . " and id_delegado=" . $id_directivo . "");
                        if ($files['junta_directores'] == 1) {
                            DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $files['id_evento'] . ", " . $id_directivo . ", 2)");
                        }
                        if ($files['junta_vigilancia'] == 1) {
                            DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $files['id_evento'] . ", " . $id_directivo . ", 3)");
                        }
                        if ($files['comite_credito'] == 1) {
                            DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $files['id_evento'] . ", " . $id_directivo . ", 4)");
                        }
                    }
                    $retorno = $id_directivo;
                } else {
                    aspiranteModel::where('num_cliente', $files['num_cliente'])->update(['memoria' => $memoria, 'adjunto' => $id_cv, 'foto' => $avatarBase64, 'tipo' => $tipo_imagen]);
                    DB::statement("DELETE from evento_directivos where id_evento = " . $files['id_evento'] . " and id_delegado=" . $xdato2[0]->id_delegado . "");
                    if ($files['junta_directores'] == 1) {
                        DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $files['id_evento'] . ", " . $xdato2[0]->id_delegado . ", 2)");
                    }
                    if ($files['junta_vigilancia'] == 1) {
                        DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $files['id_evento'] . ", " . $xdato2[0]->id_delegado . ", 3)");
                    }
                    if ($files['comite_credito'] == 1) {
                        DB::statement("INSERT INTO evento_directivos (id_evento, id_delegado, id_area) VALUES (" . $files['id_evento'] . ", " . $xdato2[0]->id_delegado . ", 4)");
                    }
                    $retorno = $xdato2[0]->id_delegado;
                }
            }
        }

      /*
        switch ((int) date("H")) {
            case 0:
                $time = 'Buenas noches';
                break;
            case 1:
                $time = 'Buenas noches';
                break;
            case 2:
                $time = 'Buenas noches';
                break;
            case 3:
                $time = 'Buenas noches';
                break;
            case 4:
                $time = 'Buenas noches';
                break;
            case 5:
                $time = 'Buenas noches';
                break;
            case 6:
                $time = 'Buenos días';
                break;
            case 7:
                $time = 'Buenos días';
                break;
            case 8:
                $time = 'Buenos días';
                break;
            case 9:
                $time = 'Buenos días';
                break;
            case 10:
                $time = 'Buenos días';
                break;
            case 11:
                $time = 'Buenos días';
                break;
            case 12:
                $time = 'Buenos días';
                break;
            case 13:
                $time = 'Buenas tardes';
                break;
            case 14:
                $time = 'Buenas tardes';
                break;
            case 15:
                $time = 'Buenas tardes';
                break;
            case 16:
                $time = 'Buenas tardes';
                break;
            case 17:
                $time = 'Buenas tardes';
                break;
            case 18:
                $time = 'Buenas tardes';
                break;
            case 19:
                $time = 'Buenas noches';
                break;
            case 20:
                $time = 'Buenas noches';
                break;
            case 21:
                $time = 'Buenas noches';
                break;
            case 22:
                $time = 'Buenas noches';
                break;
            case 23:
                $time = 'Buenas noches';
                break;
        }

        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $dateServer = $date->format('Y-m-d');

        $startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha1"]))->format('Y-m-d');
        $endDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha2"]))->format('Y-m-d');

        //dd($registrosenvio);
        // obtengo el asunto y cuerpo del correo de invitacion
        //dd( $documento_resultados);

        $contenido =
            '<!DOCTYPE html>
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
							<br/> <label style="font-size:20px;color:#202020;font-style: italic;">' .
            $time .
            '; ' .
            trim($datoscliente[0]->trato) .
            ' ' .
            trim($datoscliente[0]->NOMBRE) .
            '. <br/> Esta es la confirmaci&oacute;n de registro para:  ' .
            trim($results2[0]["nombre"]) .
            ' 


				       <br/>
               Puedes acceder a el siguiente v&iacute;nculo para acceder al &aacute;rea de usuarios.
               <br/>
               
               </label>
							 <a href="' .
            env('APP_URL', '127.0.0.1') .
            '/cliente/?wget=' .
            GeneralHelper::lara_encriptar($files['numero_asoc']) .
            '&id_evento=' .
            GeneralHelper::lara_encriptar($files['id_evento']) .
            '"> 
                  Enlace 
               </a>

 
						  </div>
						 </body>
						</html>';

        $configuraciones = DB::select('select modo,correopruebas from conf');

        if ($configuraciones[0]->modo == 0) {
            $correenviar = $configuraciones[0]->correopruebas;
        } else {
            $correenviar = $files['email_confirmation'];
        }

        Config::set('mail.encryption', env('MAIL_MAILER'));
        Config::set('mail.host', env('MAIL_HOST'));
        Config::set('mail.port', env('MAIL_PORT'));
        Config::set('mail.username', env('MAIL_USERNAME'));
        Config::set('mail.password', env('MAIL_PASSWORD'));
        Config::set('mail.from', ['address' => env('MAIL_FROM_ADDRESS'), 'name' => env('MAIL_FROM_NAME')]);

        $details = [
            'title' => 'Confirmación de registro ',
            'body' => $contenido,
            'num_cliente' => $files['numero_asoc'],
            'nombre' => $files['nombre_asoc'],
            'correo' => $correenviar,
            'contenido' => $contenido,
        ];

        Mail::send([], [], function ($message) use ($details) {
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_AUTOR'));
            $message->to($details["correo"]);
            $message->subject($details["title"]);
            $message->setBody($details["contenido"], 'text/html');
        });
      */
        return $retorno;
    }

    public function alldatadirectivos(Request $request)
    {
        try {
            $evento = $request->input('evento');
            $data = vtaspiranteModel::select(['id_evento', 'id_delegado', 'trato', 'num_cliente', 'nombre', 'apellido', 'ocupacion', 'profesion', 'img_delegado', 'estado', 'user_audit', 'fecha_aud', 'foto', 'tipo', 'memoria'])
                ->where('id_evento', $evento)
                ->get();

            return $data;
            //return json_decode(json_encode($data),true);
        } catch (Exception $e) {
            return json(['error' => $e->getMessage()]);
        }
    }

      public function alldatadirectivosgroup(Request $request)
    {
        try {
            $evento = $request->input('evento');
            $data = vtaspiranteModel::select(['id_evento', 'id_delegado', 'trato', 'num_cliente', 'nombre', 'apellido', 'ocupacion', 'profesion', 'img_delegado', 'estado', 'user_audit', 'fecha_aud', 'foto', 'tipo', 'memoria'])
                ->where('id_evento', $evento)
                ->groupBy('num_cliente')  
                ->get();

            return $data;
            //return json_decode(json_encode($data),true);
        } catch (Exception $e) {
            return json(['error' => $e->getMessage()]);
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

            $data = files_up_Model::select(['etiqueta', 'fecha_upload', 'id'])
                ->where('cldoc', '=', 0)
                ->where('id_evento', '=', $id_evento)
                ->where('eliminado', '=', 0)
                ->get();
            //$arreglo = json_decode(json_encode($data), true);
            $arreglo = json_encode($data, JSON_FORCE_OBJECT);
            //return $arreglo;
            return $data;
        } catch (Exception $e) {
            return json(['error' => $e->getMessage()]);
        }
    }

    public function upload(Request $request)
    {
        try {
            Auth::loginUsingId(3);
            //dd(Auth::user());

            $file = $request->file('file');
            $id_evento = $request->input('up_id_evento');

            $nombrefile = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $tipoarchivo = $file->getMimeType();

            $nombre = strtolower(Auth::user()->id . "_" . date('YmdHms') . "_" . uniqid('file_' . uniqid()) . "." . $extension);

            //return $nombre;
            //return env('UPLOADDIR');

            $upload_success = $file->move(base_path('/public/adjuntos/'), $nombre);
            //$upload_success=$file->move(base_path('\adjuntos'),$file->getClientOriginalName());
            //return $upload_success;

            if ($upload_success) {
                $peso = filesize(base_path('/public/adjuntos/') . $nombre);

                \DB::connection('mysql')->statement('call pr_subir_file (?,?,?,?,?,?,?)', [$id_evento, $request->session()->get('cldoc'), strtolower($nombrefile), strtolower($nombre), strtolower($extension), $tipoarchivo, $peso]);
                return $nombre;
            } else {
                $response = [
                    'resabit' => '0001',
                    'status' => 'Listado ERR',
                    'error' => 'No se pudo adjuntar',
                ];
            }
        } catch (Exception $e) {
            $response = [
                'resabit' => '0001',
                'status' => 'Listado ERR',
                'error' => $e->getMessage(),
            ];
        }
    }

    function almacenarfotoperfil(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($validation->passes()) {
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $tipoarchivo = $image->getMimeType();
            //$image = 'data:'.$tipoarchivo.';base64,'.base64_encode(file_get_contents($request->file('select_file')));
            $image = 'data:' . $tipoarchivo . ';base64,' . base64_encode(file_get_contents($request->file('select_file')));

            //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);
            //$image->move(public_path('images'), $new_name);
            //$image->move(base_path('public/adjuntos'),$new_name);
            return response()->json([
                'message' => 'Documento Adjuntado',
                'uploaded_doc' => $image,
                'tipo_imagen' => $tipoarchivo,
                'class_name' => 'alert-success',
            ]);
        } else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'uploaded_doc' => '',
                'tipo_imagen' => '',
                'class_name' => 'alert-danger',
            ]);
        }
    }

    function getDownload($adjuntoviewid)
    {
        try {
            // desencriptar
            //$adjuntoviewid= GeneralHelper::lara_desencriptar( $adjuntoviewid );
            $idadjunto = $adjuntoviewid;
            //dd($idadjunto);
            $data = DB::select("select * from files_up where id = " . $idadjunto . "");
            //dd($data);

            // $file= env('UPLOADDIR'). $data[0]->name_system;

            $file = public_path() . "/adjuntos/" . $data[0]->name_system;
            $headers = ['Content-Type: ' . $data[0]->tipoarchivo];
            return Response::download($file, $data[0]->name_system, $headers);
        } catch (Exception $e) {
            return json(['error' => $e->getMessage()]);
        }
    }

    public function adminDashboard()
    {
        return view('cliente::admin');
    }
}
