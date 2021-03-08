<?php
namespace Modules\Votacion\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Sistema\Entities\eventoModel;

use Modules\Sistema\Entities\aspiranteModel;

use Modules\Sistema\Entities\votantesModel;
use Modules\Sistema\Entities\votosModel;

use App\Services\GeneralHelper;
use App\Models\Votantes;

//use Carbon\Carbon;
use DB;
//use Illuminate\Support\Facades\Session;
use Auth;

use Illuminate\Contracts\Session\Session;

use Illuminate\Support\Facades\Mail;

use Config;

use App\Models\Votos;
use App\Models\LogAsistenciaVotacion;

class VotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
  
    public function test1(Request $request)
    {
        try
        {
          
            $request->session()
                ->flush();

            // dd(auth()->user());
            $cldoc_temp = $request->input('wget');
            $ideven = $request->input('id_evento');

            $cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0;
            $cldoc = GeneralHelper::lara_desencriptar($cldoc_temp);

            $ideven = isset($ideven) ? urldecode($ideven) : 0;
            $idevendesc = GeneralHelper::lara_desencriptar($ideven);
          
           $results2 = eventoModel::select(['id', 'nombre', 'rangofecha1', 'rangofecha2', 'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo'])->where('id', $idevendesc)->where('status', 1)->get();        
           $configuraciones = DB::select('select modo,correopruebas from conf');
          
          
           Auth::loginUsingId(3);

           $request->session()->put('cldoc', $cldoc);
           $request->session()->put('idevendesc', $idevendesc);
           $request->session()->put('tipoevent', $results2[0]["tipo"]);

           $categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = " . $idevendesc . "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");

           $listadoaspirantes = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b on a.id_delegado = b.id_delegado where b.id_evento= " . $idevendesc . " and  a.estado=1 and  a.eliminado=0 order by a.apellido,a.nombre asc");

           return view('votacion::index2')->with('mododeveloper', $configuraciones[0]->modo)
                                ->with('enlace', $request->all())
                                ->with('aspirantes', $listadoaspirantes)->with('categoriaspapeletas', $categoriaspapeletas)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"])->with('id_evento', $idevendesc)->with('ideven', $idevendesc)->with('max_votos', $results2[0]["maxvotos"]);

          
          
            return view('votacion::index2');
        }
        catch(\Throwable $th)
        {

            //throw $th;
            return view('votacion::errorencrypt', compact('th'));
        }
    } 
  
  
  
    public function existente(Request $request)
    { 
      
       $nombre_evento = $request->input('nombre');
           $mensaje = "";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>ya se registro se encuentra en nuestra base de datos !</div> ";

            return view('votacion::existente')
                ->with('mensaje', $mensaje)
                ->with('nombre', '')
                ->with('enlace', $request->all());

    }

    public function satisfactorio(Request $request)
    { 
      
       $nombre_evento = $request->input('nombre');
           $mensaje = "";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Su inscripción de candidatos a puestos directivos fue guardada !</div> ";

            return view('votacion::existente')
                ->with('mensaje', $mensaje)
                ->with('nombre', '')
                ->with('enlace', $request->all());

    }
  

    public function index(Request $request)
    {
        try
        {
            //Auth::logout();
            $request->session()
                ->flush();

            // dd(auth()->user());
            $cldoc_temp = $request->input('wget');
            $ideven = $request->input('id_evento');

            $cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0;
            $cldoc = GeneralHelper::lara_desencriptar($cldoc_temp);

            $ideven = isset($ideven) ? urldecode($ideven) : 0;
            $idevendesc = GeneralHelper::lara_desencriptar($ideven);

            $resultsxx = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id=' . $idevendesc . '');

            if ($cldoc > 0 && $idevendesc > 0)
            {

                // si todo va bien
                $results = eventoModel::select(['id', 'nombre', 'rangofecha1', 'rangofecha2', 'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo'])->where('id', $idevendesc)->get();

                if (count($results) > 0)
                {

                    $results2 = eventoModel::select(['id', 'nombre', 'rangofecha1', 'rangofecha2', 'maxvotos', 'capitulos', 'estadosasoc', 'status', 'tipo'])->where('id', $idevendesc)->where('status', 1)
                        ->get();

                    $carbon = new \Carbon\Carbon();
                    $date = $carbon->now();
                    $dateServer = $date->format('Y-m-d');

                    $startDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha1"]))->format('Y-m-d');
                    $endDate = $carbon::createFromFormat('Y-m-d H:i:s', trim($results2[0]["rangofecha2"]))->format('Y-m-d');

                    if ($date > $startDate && $date < $endDate)
                    {

                        $configuraciones = DB::select('select modo,correopruebas from conf');

                        if ($configuraciones[0]->modo == 0)
                        {
                            Auth::loginUsingId(3);

                            $request->session()
                                ->put('cldoc', $cldoc);
                            $request->session()
                                ->put('idevendesc', $idevendesc);
                            $request->session()
                                ->put('tipoevent', $results2[0]["tipo"]);

                            $categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = " . $idevendesc . "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");

                            $listadoaspirantes = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b on a.id_delegado = b.id_delegado where b.id_evento= " . $idevendesc . " and  a.estado=1 and  a.eliminado=0 order by a.apellido,a.nombre asc");

                            return view('votacion::index')->with('mododeveloper', $configuraciones[0]->modo)
                                ->with('enlace', $request->all())
                                ->with('aspirantes', $listadoaspirantes)->with('categoriaspapeletas', $categoriaspapeletas)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"])->with('id_evento', $idevendesc)->with('ideven', $idevendesc)->with('max_votos', $results2[0]["maxvotos"]);

                        }

                        $xdato = DB::select("select *  from votantes where id_evento=" . $idevendesc . " and (cast(aes_decrypt(`asociado`,'xyz123') as char charset utf8mb4)=" . $cldoc . ")");
                        
          
                      
                        if (count($xdato) > 0)
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
                                  cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) = " . $cldoc . " 
                                  AND `e`.`id_evento` = " . $idevendesc . " 
                                  ORDER BY `e`.`id_area`,voto_nombre,voto_apellido asc");

                                        //dd($categoriaspapeletas);
                                        $areas = DB::select("SELECT 
                                  `e`.`id_area` AS `voto_id_area`,
                                  `c`.`area_etiqueta` AS `voto_area_etiqueta`
                                  from `votos` `e` 
                                  INNER JOIN votantes AS b ON e.idvotante = b.id
                                  INNER JOIN conf_areas AS c ON e.id_area = c.id_area
                                  WHERE cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) = " . $cldoc . " 
                                  AND `e`.`id_evento` = " . $idevendesc . " 
                                  GROUP BY `e`.`id_area`,`c`.`area_etiqueta`
                                  ORDER BY `e`.`id_area`,`c`.`area_etiqueta` ASC");

                                $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                                    $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Ya realiz&oacute; su voto para este evento</div>";
                                    return view('votacion::datosvotacion')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)
                                        ->with('ideven', $idevendesc)->with('areas', $areas)->with('detalles', $detalles);

                               /* $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Ya su voto fue realizado; muchas gracias !</div>";
                                return view('votacion::advertencia')->with('enlace', $request->all())->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)
                                    ->with('ideven', $idevendesc);*/
                          
                          
                        }
                        else
                        {

                            Auth::loginUsingId(3);

                            $request->session()
                                ->put('cldoc', $cldoc);
                            $request->session()
                                ->put('idevendesc', $idevendesc);
                            $request->session()
                                ->put('tipoevent', $results2[0]["tipo"]);

                            $categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = " . $idevendesc . "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");

                            $listadoaspirantes = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b on a.id_delegado = b.id_delegado where b.id_evento= " . $idevendesc . " and  a.estado=1 and  a.eliminado=0 order by a.apellido,a.nombre asc");

                            return view('votacion::index')->with('mododeveloper', $configuraciones[0]->modo)
                                ->with('enlace', $request->all())
                                ->with('aspirantes', $listadoaspirantes)->with('categoriaspapeletas', $categoriaspapeletas)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"])->with('id_evento', $idevendesc)->with('ideven', $idevendesc)->with('max_votos', $results2[0]["maxvotos"]);

                        }

                    }
                    else
                    {
                        $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                        $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Periodo no est&aacute; dentro del rango habilitado</div>";
                        return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)
                            ->with('ideven', $idevendesc);
                    }
                }
                else
                {
                    $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                    $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Evento no existe actualmente o esta inactivo</div>";
                    return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)
                        ->with('ideven', $idevendesc);

                }

            }
            else
            {
                $mensaje = "";
                $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
                if ($idevendesc == 0)
                {
                    $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de evento no fue reconocido</div>";
                }
                if ($cldoc == 0)
                {
                    $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Identifici&oacute;n de su número de invitaci&oacute;n</div> ";
                }

                return view('votacion::advertencia')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)
                    ->with('ideven', $idevendesc);
            }

            return view('votacion::index');
        }
        catch(\Throwable $th)
        {

            //throw $th;
            return view('votacion::errorencrypt', compact('th'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('votacion::create');
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
        return view('votacion::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('votacion::edit');
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

    public function coopexe2(Request $request)
    {
        try
        {
            $indice = $request->input('indice');
            $data = aspiranteModel::select(['id_delegado', 'num_cliente', 'nombre', 'apellido', 'img_delegado', 'estado', 'user_audit', 'fecha_aud', 'foto', 'tipo'])->where('id_delegado', $indice)->orderBy('apellido', 'desc')
                ->get();
            return json_decode(json_encode($data) , true);
        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function coopexe3(Request $request)
    {
        try
        {

            $id_evento = $request->session()
                ->get('idevendesc');
            $usuario = $request->session()
                ->get('cldoc');
            $files = $request->input('campos');

            $osi = json_decode($files); /// ESTOS SON LOS VOTOS
            
/*
            $entidad = new LogAsistenciaVotacion();
            $entidad->idterminal = trim(GeneralHelper::getRealIP());
            $entidad->id_evento = $id_evento;
            $entidad->asociado = trim("AES_ENCRYPT(".$usuario.",'xyz123')");
            //$entidad->json_data = $files;
            $entidad->save();
            $entidad->id;
 */         
            $detalles = DB::select("insert into votantes(idterminal,id_evento,asociado) values ('".trim(GeneralHelper::getRealIP())."',".$id_evento.",cast(AES_ENCRYPT(".$usuario.",'xyz123') as CHAR charset UTF8MB4 )); ");
            $detalles2 = DB::select("SELECT LAST_INSERT_ID() AS ultimoid;");


          
            DB::statement( "update votantes set json_data=cast(AES_ENCRYPT('".$files."','xyz123') as CHAR charset UTF8MB4) where id= ".$detalles2[0]->ultimoid."");

            $canti = count($osi) - 1;
          //dd($canti);
            for ($i = 0;$i <= $canti;$i++)
            {
                DB::statement("insert into votos(idvotante,id_evento,id_area,aspirante,nombre,apellido) values (".$detalles2[0]->ultimoid.",".$id_evento.",".$osi[$i]->{'id_area'}.",cast(AES_ENCRYPT(".$osi[$i]->{'num_cliente'}.",'xyz123') as CHAR charset UTF8MB4 ),cast(AES_ENCRYPT('".$osi[$i]->{'nombre'}."','xyz123') as CHAR charset UTF8MB4 ),cast(AES_ENCRYPT('".$osi[$i]->{'apellido'}."','xyz123') as CHAR charset UTF8MB4 )); ");
            }

        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function coopexe4(Request $request)
    {
        try
        {
            $id_evento = $request->session()
                ->get('idevendesc');
            //dd("sss" );
            $buscando = $request->input('buscando');

            $results = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b 
on a.id_delegado = b.id_delegado 
where b.id_evento= " . $id_evento . " and  a.estado=1 
and (num_cliente like '%" . $buscando . "%' or nombre like '%" . $buscando . "%' or apellido like '%" . $buscando . "%' ) order by a.apellido asc");

            return json_decode(json_encode($results) , true);
        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function limitevotos(Request $request)
    {
        try
        {
            $id_evento = $request->session()
                ->get('idevendesc');
            $results = DB::select('SELECT maxvotos FROM evento where id=' . $id_evento . '');

            return json_decode(json_encode($results) , true);
        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function gruposvoletasfiltradas(Request $request)
    {
        try
        {
            $buscando = $request->input('buscando');

            $id_evento = $request->session()
                ->get('idevendesc');

            $categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = " . $id_evento . "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");

            $listadoaspirantes = DB::select("SELECT * FROM directivos as a inner join evento_directivos as b 
on a.id_delegado = b.id_delegado 
where b.id_evento= " . $id_evento . " and  a.estado=1 
and (num_cliente like '%" . $buscando . "%' or nombre like '%" . $buscando . "%' or apellido like '%" . $buscando . "%' ) order by a.apellido asc");

            return view('votacion::changetofilter')->with('aspirantes', $listadoaspirantes)->with('categoriaspapeletas', $categoriaspapeletas);

        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function previa(Request $request)
    {
        try
        {
            $id_evento = $request->session()
                ->get('idevendesc');
            $results = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id=' . $id_evento . '');

            return view('votacion::previa')->with('enlace', $request->all())
                ->with('ideven', $id_evento)->with('id_evento', $id_evento)->with('tipo', $results[0]->tipo)
                ->with('nombre', $results[0]->nombre)
                ->with('maxvotos', $results[0]->maxvotos);

        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function categoriaslist(Request $request)
    {
        try
        {
            $id_evento = $request->session()
                ->get('idevendesc');
            $categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = " . $id_evento . "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");
            return json_decode(json_encode($categoriaspapeletas) , true);
        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function finalizada(Request $request)
    {
        try
        {
            $usuario = $request->session()
                ->get('cldoc');
            $id_evento = $request->session()
                ->get('idevendesc');

            $datos1 = DB::select("select * from data_clientes_vt where clasoc=" . $usuario);
            $documento_resultados = DB::select("select * from evento where id=" . $id_evento);

            $CantRegistros = count($datos1);

            $configuraciones = DB::select('select modo,correopruebas from conf');

            if ($CantRegistros > 0)
            {

                switch ((int)date("H"))
                {
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
						
            
              <img src="https://portal.cooprofesionales.com.pa/mercadeo/files/333f41_newlogo1.png" style="width: 470px;">
						
							<br/>
              
							<h1>Agradecemos su participaci&oacute;n en las votaciones del evento:<br/>  ' . $documento_resultados[0]->nombre . '</h1>

			
						
						  </div>
						 </body>
						</html>';

                    if ($configuraciones[0]->modo == 0)
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
                    'title' => "Participación en Votación Finalizada",
                    'body' => '',
                    'num_cliente' => $registrosenvio->CLASOC,
                    'nombre' => $registrosenvio->NOMBRE,
                    'correo' => $correenviar ,
                    'contenido' => $contenido
                    ];
                    
                    Mail::send([], [], function($message) use ($details) {
                    $message->from(env('MAIL_FROM_ADDRESS'),  env('APP_AUTOR'));
                    $message->to($details["correo"]);
                    $message->subject($details["title"]);
                    $message->setBody($details["contenido"] , 'text/html');
                    });
                    
                    
       

                }
            }

            $results = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id=' . $id_evento . '');

            $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Su votaci&oacute;n se ha realizado con &eacute;xito</h3></div>";
            $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Gracias por su participaci&oacute;n</div>";
            return view('votacion::advertencia')->with('enlace', $request->all())
                ->with('mensaje', $mensaje)->with('nombre', $results[0]->nombre)
                ->with('ideven', $id_evento);
        }
        catch(Exception $e)
        {
            return json(array(
                'error' => $e->getMessage()
            ));
        }
    }

    public function verificaparticipacion(Request $request)
    {
        $usuario = $request->session()
            ->get('cldoc');
        $id_evento = $request->session()
            ->get('idevendesc');

        //$usuario = $request->input('cldoc');
        //$id_evento = $request->input('idevendesc');
        $xdato = DB::select("select *  from votantes where id_evento=" . $id_evento . " and (cast(aes_decrypt(`asociado`,'xyz123') as char charset utf8mb4)=" . $usuario . ")");

        return count($xdato);

    }

    public function contenedordetalle(Request $request)
    {
        $cldoc = $request->session()
            ->get('cldoc');
        $idevendesc = $request->session()
            ->get('idevendesc');

        $resultsxx = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id=' . $idevendesc . '');
        $detalles = DB::select("SELECT 
											cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) AS `votante`,
											`e`.`id_area` AS `voto_id_area`,
											`c`.`area_etiqueta`AS `voto_area_etiqueta`,
											cast(aes_decrypt(`e`.`aspirante`,'xyz123') as char charset utf8mb4) AS `voto_aspirante`,
											cast(aes_decrypt(`e`.`nombre`,'xyz123') as char charset utf8mb4) AS `voto_nombre`,
											cast(aes_decrypt(`e`.`apellido`,'xyz123') as char charset utf8mb4) AS `voto_apellido`
											from `votos` `e` 
											INNER JOIN votantes AS b ON e.idvotante = e.idvotante
											INNER JOIN conf_areas AS c ON e.id_area = c.id_area
											WHERE 
											cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) = " . $cldoc . " 
											AND `e`.`id_evento` = " . $idevendesc . " 
											ORDER BY `e`.`id_area`,voto_nombre,voto_apellido asc");

        //dd($categoriaspapeletas);
        $areas = DB::select("SELECT 
											`e`.`id_area` AS `voto_id_area`,
											`c`.`area_etiqueta` AS `voto_area_etiqueta`
											from `votos` `e` 
											INNER JOIN votantes AS b ON e.idvotante = e.idvotante
											INNER JOIN conf_areas AS c ON e.id_area = c.id_area
											WHERE cast(aes_decrypt(`b`.`asociado`,'xyz123') as char charset utf8mb4) = " . $cldoc . " 
											AND `e`.`id_evento` = " . $idevendesc . " 
											GROUP BY `e`.`id_area`,`c`.`area_etiqueta`
											ORDER BY `e`.`id_area`,`c`.`area_etiqueta` ASC");

        $mensaje = "<div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>";
        $mensaje .= "<div class='col-xs-4 text-center' style='vertical-align: middle;'>Ya realiz&oacute; su voto para este evento</div>";
        return view('votacion::datosvotacion')->with('mensaje', $mensaje)->with('nombre', $resultsxx[0]->nombre)
            ->with('ideven', $idevendesc)->with('areas', $areas)->with('detalles', $detalles);

    }

}

