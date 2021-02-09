<?php

namespace Modules\Sistema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Modules\Sistema\Entities\aspiranteModel;
use Modules\Sistema\Entities\eventoModel;
use Modules\Sistema\Entities\asamblea_estructuraModel;
use Modules\Sistema\Entities\vtaspiranteModel;
use Modules\Sistema\Entities\evento_directivosModel;


class ConfVotacionController extends Controller
{
    
    public function confvotacion()
    {
		$eventos = eventoModel::select(['id','nombre','rangofecha1'])->where('id','>',0)->orderBy('rangofecha1', 'DESC')->get();
		$tipos = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		return view('sistema::confvotacion')->with('eventos', $eventos)->with('tipos', $tipos); 
    }	


     public function dataeventosseleccion(Request $request)
     {
           try
           {
				   $buscando = $request->input('evento');
				   //dd($buscando);
                   $data = vtaspiranteModel::select(['id_evento','id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'])->where('id_evento',$buscando)->get();
				   //dd($data);
				   return $data;
                   //return json_decode(json_encode($data),true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	
	
	
     public function cargaraspirantesconfvota(Request $request)
     {
           try
           {
                   $data = aspiranteModel::select(['id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'])->where('estado',1);
                   return Datatables::of($data)
                   ->addColumn('action', function ($data) {
                     return ' <button class="dropdown-item btn-secondary"  onclick="Cargar('. trim($data->id_delegado). ')"><i class="icon-book-open"></i> Agregar </button>';
                   })
                   ->make(true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }

	 
     public function agregaraspiranteevento(Request $request)
     {
           try
           {
				   $entidad  = new evento_directivosModel();
				   $entidad->id_evento = $request->input('id_evento');
				   $entidad->id_delegado = $request->input('id_delegado');
				   $entidad->id_area = $request->input('id_area');
				   $entidad->save();
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }
	 
     public function dataeventosseleccionespecifica(Request $request)
     {
           try
           {
				   $evento = $request->input('evento');
				   $area = $request->input('area');
				   //dd($buscando);
                   $data = vtaspiranteModel::select(['id_evento','id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'])->where('id_evento',$evento)->where('id_area',$area)->get();
				   //dd($data);
				   return $data;
                   //return json_decode(json_encode($data),true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	
  

  
	 
     public function eliminaraspiranteevento(Request $request)
     {
           try
           {
			    //{  'id_evento': eleccion ,'id_delegado': idbd,"id_area": id_area },
				//dd($request->input());
				/*
				
					array:3 [
					  "id_evento" => "4"
					  "id_delegado" => "2"
					  "id_area" => "1"
					]				
				
				*/
				   $id_evento = $request->input('id_evento');
				   $id_area = $request->input('id_area');
				   $id_delegado = $request->input('id_delegado');
                   $data = evento_directivosModel::where('id_evento',$id_evento)->where('id_area',$id_area)->where('id_delegado',$id_delegado)->delete();
				   return $data;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	
	 
	 
     public function lookimage(Request $request)
     {	 

                 $data = $request->input('img');
                 echo trim($data);

	 }																		   
		

     public function saveimage(Request $request)
     {
           try
           {
			       $id_delegado = $request->input('aspiranteidBD');
				   $llimagen = trim($request->input('llimagen'));
				   $formato  = trim($request->input('formato'));
                   $data1 = aspiranteModel::where('id_delegado',$id_delegado)->update(['tipo'=> $formato , 'foto'=> $llimagen ]);

           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	

		
	 
}
