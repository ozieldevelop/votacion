<?php

namespace Modules\Sistema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sistema\Entities\capitulosModel;
use Modules\Sistema\Entities\asamblea_estructuraModel;
use Modules\Sistema\Entities\eventoModel;
use Modules\Sistema\Entities\estados_asocModel;
use Modules\Sistema\Entities\documento_resultadosModel;
use Modules\Sistema\Entities\documento_envioModel;
use Modules\Cliente\Entities\files_up_Model;
use Auth;
use Validator;

class FormatosDocumentosController extends Controller
{
   
  
    public function uploaddocumentosevento(Request $request)
      {

        try 
        {

         $id_retorno ='';
         $validation = Validator::make($request->all(), [
          'select_file' => 'required|mimes:pdf,docx,jpeg,png,jpg,gif|max:2048'
         ]);

   
         if($validation->passes())
         {
                 dd($request->input('up_id_evento'));
          $image = $request->file('file');
          $extension = $image->getClientOriginalExtension();
          $tipoarchivo = $image->getMimeType();    
          $new_name = rand() . '.' . $image->getClientOriginalExtension();
          $id_evento = $request->input('up_id_evento');

         

          //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);

          //return $nombre;
          //return env('UPLOADDIR');
          
          $upload_success=$file->move(base_path('/public/adjuntos/'),$new_name);
          //$upload_success=$file->move(base_path('\adjuntos'),$file->getClientOriginalName());
          //return $upload_success;
          
   
          if ($upload_success) {
            $peso = filesize(base_path('/public/adjuntos/').$nombre);
            
             dd($peso);
             /*
            
                $entidad  = new aspiranteModel();
                $entidad->num_cliente = $request->input('numasoc');
                $entidad->nombre = $request->input('nombreasoc');
                $entidad->apellido = $request->input('apellidoasoc');
                $entidad->user_audit = 'sistema';
                $entidad->tipo = $tipo_imagen;   
                $entidad->foto = $avatarBase64;               
                $entidad->memoria =  $memoria;
                $entidad->adjunto =  $id_cv;
                $entidad->save(); 
            */
            
            \DB::connection('mysql')->statement('call pr_subir_file (?,?,?,?,?,?,?)', array($id_evento,0,strtolower($nombrefile),strtolower($nombre),strtolower($extension),$tipoarchivo,$peso));
             return $nombre;
          }
          else {
            $response = array(
                'resabit' => '0001',
                'status' => 'Listado ERR',
                'error' => 'No se pudo adjuntar'
           );
          }
    

         }
          
          
          
         } catch (Exception $e) {
                      $response = array(
                          'resabit' => '0001',
                          'status' => 'Listado ERR',
                          'error' => $e->getMessage()
                     );
          }



    }
  
       public function cargaadjuntosScreenListar(Request $request)
    {
        try {
              $id_evento = $request->input('id_evento');

              $data = files_up_Model::select(['etiqueta','fecha_upload','id'])->where('id_evento', '=', $id_evento)->where('cldoc', '=', 0)->where('eliminado', '=', 0)->get();
              //$arreglo = json_decode(json_encode($data), true);
              $arreglo = json_encode($data, JSON_FORCE_OBJECT);
              //return $arreglo;
              return $data;
        } catch (Exception $e) {
                          return json(array('error'=> $e->getMessage()));
        }
    }   
  
    public function formatosdocumentos()
    {
        $capitulos = capitulosModel::select(['IDAGEN','AGENCIA'])->where('IDAGEN','>',0)->get();
		$asamblea_estructura = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		$estados_asoc = estados_asocModel::select(['id_estado','estado'])->where('id_estado','>',0)->get();		
		$eventos = eventoModel::select(['id','nombre','rangofecha1'])->where('status',1)->orderBy('rangofecha1', 'DESC')->get();
		$tipos = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		return view('sistema::formatosdocumentos')->with('eventos', $eventos)->with('tipos', $tipos)->with('capitulos', $capitulos)->with('asamblea_estructura', $asamblea_estructura)->with('estados_asoc', $estados_asoc); 		

    }	

	
    public function cargarplantillasresultevento(Request $request)
    {	
	
		$buscando = $request->input('evento');
		$documento_resultados = documento_resultadosModel::select(['superior','inferior'])->where('id_evento','=',$buscando)->get();
		
		if( count($documento_resultados)<=0 )
		{
			
				   $entidad  = new documento_resultadosModel();
				   $entidad->id_evento = $buscando;
				   $entidad->superior = "Reemplace  este c&oacute;digo";
				   $entidad->inferior = "Reemplace  este c&oacute;digo";
				   $entidad->save();
		}

		$documento_resultados = documento_resultadosModel::select(['id_evento','superior','inferior'])->where('id_evento','=',$buscando)->get();
		echo json_encode($documento_resultados);
	}
	
	
    public function cargarplantillasemailevento (Request $request)
    {	
	
		$buscando = $request->input('evento');
		$documento_resultados = documento_envioModel::select(['asunto','texto'])->where('id_evento','=',$buscando)->get();
		
		if( count($documento_resultados)<=0 )
		{
			
				   $entidad  = new documento_envioModel();
				   $entidad->id_evento = $buscando;
				   $entidad->asunto = "Reemplace  este c&oacute;digo";
				   $entidad->texto = "Reemplace  este c&oacute;digo";
				   $entidad->save();
		}

		$documento_resultados = documento_envioModel::select(['asunto','texto'])->where('id_evento','=',$buscando)->get();
		echo json_encode($documento_resultados);
	}


    public function actualizarplantillasresultevento (Request $request)
    {	
	
		$buscando = $request->input('id_evento');
		$files = $request->input('campos');
		$osi = json_decode($files);
		$aa = $osi->{'asuntoemail'} ;
		$bb = $osi->{'contenidoemail'} ;
		$data1 = documento_envioModel::where('id_evento',$buscando)->update(['asunto'=>$aa, 'texto'=> $bb ]);
		$data2 = documento_resultadosModel::where('id_evento',$buscando)->update(['superior'=> $osi->{'resultadoheader'} , 'inferior'=> $osi->{'resultadofooter'} ]);
		
		
	}

	
}

