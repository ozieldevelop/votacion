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

class FormatosDocumentosController extends Controller
{
    
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

