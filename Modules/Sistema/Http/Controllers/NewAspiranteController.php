<?php

namespace Modules\Sistema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Modules\Sistema\Entities\aspiranteModel;

class NewAspiranteController extends Controller
{
    
    public function newaspirante()
    {
        return view('sistema::newaspirante');
    }	


     public function cargaraspirantes(Request $request)
     {
           try
           {
                   $data = aspiranteModel::select(['id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'])->where('estado',1);
                   return Datatables::of($data)
                   ->addColumn('action', function ($data) {
                     return ' <button class="dropdown-item btn-danger"  onclick="Eliminar('. trim($data->id_delegado). ')"><i class="icon-book-open"></i> Eliminar</button><button class="dropdown-item btn-secondary"  onclick="Cargar('. trim($data->id_delegado). ')"><i class="icon-book-open"></i> Selecci&oacute;n</button>';
                   })
                   ->make(true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }
	 
     public function cargardatoaspirante(Request $request)
     {
           try
           {
				   $buscando = $request->input('buscando');
				   //dd($buscando);
                   $data = aspiranteModel::select(['id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'])->where('id_delegado',$buscando)->get();
				   //dd($data);
				   return $data;
                   //return json_decode(json_encode($data),true);
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }
	 
     public function eliminaraspirante(Request $request)
     {
           try
           {
				   $buscando = $request->input('aspirante');
                   $data = aspiranteModel::where('id_delegado',$buscando)->update(['estado'=> 0]);
				   return $data;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	 
	 
     public function actualizaraspirante(Request $request)
     {
           try
           {
				   $id_delegado = $request->input('id_delegado');
				   $numasoc = $request->input('numasoc');
				   $nombreasoc = $request->input('nombreasoc');
				   $apellidoasoc = $request->input('apellidoasoc');

                   $data = aspiranteModel::where('id_delegado',$id_delegado)->update(['num_cliente'=> $numasoc , 'nombre'=> $nombreasoc , 'apellido'=> $apellidoasoc  ]);
				   return $data;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	

     public function agregarnuevo(Request $request)
     {
           try
           {		
				   $entidad  = new aspiranteModel();
				   $entidad->num_cliente = $request->input('numasoc');
				   $entidad->nombre = $request->input('nombreasoc');
				   $entidad->apellido = $request->input('apellidoasoc');
				   $entidad->user_audit = 'sys';
				   $entidad->save();
				   return $entidad;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }


	 
	
}
