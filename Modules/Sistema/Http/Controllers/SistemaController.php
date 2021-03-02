<?php

namespace Modules\Sistema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use DB;
//use Illuminate\Support\Facades\Session;
use Auth;

use Illuminate\Contracts\Session\Session;
use App\Services\GeneralHelper;
use Modules\Sistema\Entities\eventoModel;

class SistemaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('sistema::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sistema::create');
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
        return view('sistema::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('sistema::edit');
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
	

	

    public function inscripcion(Request $request)
    {
  		try
       {    
      
				Auth::logout();
				$request->session()->flush();

				$cldoc_temp = $request->input('wget');
				//
				$ideven = $request->input('id_evento');

				$cldoc_temp = isset($cldoc_temp) ? urldecode($cldoc_temp) : 0 ;

				$cldoc= GeneralHelper::lara_desencriptar( $cldoc_temp );	
   

					
				$ideven = isset($ideven) ? urldecode($ideven) : 0 ;
				$idevendesc=  GeneralHelper::lara_desencriptar( $ideven );	
   
				//$idevendesc= 5;
				
 
				//dd($cldoc."<br/>". $idevendesc  );

				$resultsxx = DB::select('SELECT tipo,nombre,maxvotos FROM evento where id='.$idevendesc.'');

        ///dd($resultsxx);
        
				if($cldoc>0 && $idevendesc>0)
				{

					// si todo va bien 
				
							$results2 = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('id',$idevendesc)->where('status',1)->get();

							if (count($results2) >0 )
							{

                
								$carbon = new \Carbon\Carbon();
								$date = $carbon->now();
								$dateServer = $date->format('Y-m-d');
				

										$request->session()->put('cldoc', $cldoc);
										$request->session()->put('idevendesc', $idevendesc);
										$request->session()->put('tipoevent', $results2[0]["tipo"] );
                    
                    $datoscliente = DB::select("SELECT clasoc as num_cliente,trato, nombre, agencia, ocupacion,profesion from data_clientes_vt WHERE clasoc = ".$cldoc. " ");
                    //dd($datoscliente[0]->ocupacion);
                  
										$categoriaspapeletas = DB::select("SELECT b.id_area,c.area_etiqueta AS nombrearea from evento_directivos AS b INNER JOIN conf_areas AS c ON b.id_area = c.id_area WHERE b.id_evento = ".$idevendesc. "  GROUP BY b.id_area,c.area_etiqueta ORDER BY b.id_evento");

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
                
										return view('sistema::inscripcion')->with('tienefoto', $tienefoto)->with('tipo', $tipo)->with('foto', $foto)->with('nombreevento', trim($results2[0]["nombre"]))->with('tipoevent', $results2[0]["tipo"] )->with('id_evento', $idevendesc )->with('ideven', $idevendesc )->with('f_inicia', $results2[0]["rangofecha1"] )->with('f_termina', $results2[0]["rangofecha2"] )->with('num_cliente', $cldoc )->with('ocupacion', trim($datoscliente[0]->ocupacion) )->with('profesion', trim($datoscliente[0]->profesion) )->with('trato', trim($datoscliente[0]->trato) )->with('nombre', trim($datoscliente[0]->nombre) )->with('agencia', trim($datoscliente[0]->agencia) );	 										

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

        	return view('cliente::tablero');
		} catch (\Throwable $th) {
			
			//throw $th;
			return view('votacion::errorencrypt', compact('th'));
		}
  

    }
  

	
}
