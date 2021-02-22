<?php

namespace Modules\Sistema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Modules\Sistema\Entities\capitulosModel;
use Modules\Sistema\Entities\asamblea_estructuraModel;
use Modules\Sistema\Entities\eventoModel;
use Modules\Sistema\Entities\estados_asocModel;
use Modules\Sistema\Entities\documento_resultadosModel;
use Modules\Sistema\Entities\documento_envioModel;


class NewEventoController extends Controller
{
    
    public function newevento ()
    {
        $capitulos = capitulosModel::select(['IDAGEN','AGENCIA'])->where('IDAGEN','>',0)->get();
		$asamblea_estructura = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		$estados_asoc = estados_asocModel::select(['id_estado','estado'])->where('id_estado','>',0)->get();
		return view('sistema::newevento')->with('capitulos', $capitulos)->with('asamblea_estructura', $asamblea_estructura)->with('estados_asoc', $estados_asoc); 
    }	

    public function cargareventos(Request $request)
	{
           try
           {
                   $data = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo'])->where('status',1);
                   return Datatables::of($data)
                   ->addColumn('action', function ($data) {
                     return ' <button class="dropdown-item btn-danger"  onclick="Eliminar('. trim($data->id). ')"><i class="icon-book-open"></i> Eliminar</button><button class="dropdown-item btn-secondary"  onclick="Cargar('. trim($data->id). ')"><i class="icon-book-open"></i> Selecci&oacute;n</button>';
                   })
                   ->make(true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
	}
	
     public function cargardatoevento(Request $request)
     {
           try
           {
				   $buscando = $request->input('evento');
				   //dd($buscando);
                   $data = eventoModel::select(['id','nombre','rangofecha1','rangofecha2','maxvotos','capitulos','estadosasoc','status','tipo','veri_id_zoom'])->where('id',$buscando)->get();
				   //dd($data);
				   return $data;
                   return json_decode(json_encode($data),true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	
	 
	 
     public function agregarnuevoevento(Request $request)
     {
           try
           {
				   $entidad  = new eventoModel();
				   $entidad->nombre = $request->input('nombre');
				   $entidad->rangofecha1 = $request->input('rangofecha1');
				   $entidad->rangofecha2 = $request->input('rangofecha2');
				   $entidad->maxvotos = $request->input('maxvotos');
				   $entidad->tipo = $request->input('tipo');
				   $entidad->capitulos = $request->input('capitulos');
				   $entidad->estadosasoc = $request->input('estadosasoc');
           $entidad->veri_id_zoom = $request->input('idzoom');
				   $entidad->save();

				   $entidad2  = new documento_resultadosModel();
				   $entidad2->id_evento = $entidad->id;
				   $entidad2->superior = "Reemplace  este c&oacute;digo";
				   $entidad2->inferior = "Reemplace  este c&oacute;digo";
				   $entidad2->save();

				   $entidad3  = new documento_envioModel();
				   $entidad3->id_evento = $entidad->id;
				   $entidad3->asunto = "Votación";
				   $entidad3->texto = "Hola, te adjuntamos en la parte inferior del mensaje un icono con el enlace al sistema de votación";
				   $entidad3->save();

				   
				   return $entidad;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }		 
	     

																			   
     public function actualizarevento(Request $request)
     {
           try
           {
				   $id = $request->input('id');
				   $nombre = $request->input('nombre');
				   $rangofecha1 = $request->input('rangofecha1');
				   $rangofecha2 = $request->input('rangofecha2');
				   $maxvotos = $request->input('maxvotos');
				   $tipo = $request->input('tipo');
				   $capitulos = $request->input('capitulos');
				   $estadosasoc = $request->input('estadosasoc');
				   $veri_id_zoom = $request->input('idzoom');
           
           $data = eventoModel::where('id',$id)->update(['nombre'=> $nombre , 'rangofecha1'=> $rangofecha1 , 'rangofecha2'=> $rangofecha2, 'maxvotos'=> $maxvotos , 'tipo'=> $tipo , 'capitulos'=> $capitulos , 'estadosasoc'=> $estadosasoc ,'veri_id_zoom'=> $veri_id_zoom  ]);
				   
				   return $data;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	
	 
     public function eliminarevento(Request $request)
     {
           try
           {
				   $id = $request->input('evento');
                   $data = eventoModel::where('id',$id)->update(['status'=> 0 ]);
				   return $data;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	
	 

}	