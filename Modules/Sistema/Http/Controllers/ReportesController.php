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

class ReportesController extends Controller
{
    
    public function reportes()
    {
		
        $capitulos = capitulosModel::select(['IDAGEN','AGENCIA'])->where('IDAGEN','>',0)->get();
		$asamblea_estructura = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		$estados_asoc = estados_asocModel::select(['id_estado','estado'])->where('id_estado','>',0)->get();		
		$eventos = eventoModel::select(['id','nombre','rangofecha1'])->where('status',1)->orderBy('rangofecha1', 'DESC')->get();
		$tipos = asamblea_estructuraModel::select(['id_ae','etiqueta'])->where('id_ae','>',0)->get();
		return view('sistema::reportes')->with('eventos', $eventos)->with('tipos', $tipos)->with('capitulos', $capitulos)->with('asamblea_estructura', $asamblea_estructura)->with('estados_asoc', $estados_asoc); 		
    }	

	
	
	
	
	
	
      public function viewreporte(Request $request)
        {
		  $id_evento = $request->input('id_evento');
		  
		  $evento = eventoModel::select(['id','nombre','tipo'])->where('id',$id_evento)->get();

		  
          $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp','mode' => 'utf-8', 'format' => 'A4', 'setAutoTopMargin' => 'stretch','autoMarginPadding' => 5]);
          $stylesheet = file_get_contents(url("css").'/reporte.css');
		  
          $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
          $mpdf->allow_charset_conversion = true;
          $mpdf->charset_in = 'iso-8859-4';
          $mpdf->defaultheaderline=1;
          $mpdf->defaultfooterline=1;
		  
				 $header='
				   <table id="firmas1">
						 <tr>
							 <td align="center" >'. date("Y-m-d").'</td>
						 </tr>
				   </table>';
		   
		   
				$html ='<!DOCTYPE html><html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head>
                <div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;">
                <img src="../../assets/images/header.jpg" style="margin: 0;" /></div><br>';
				
				$dataa = documento_resultadosModel::select(['superior','inferior'])->where('id_evento',$id_evento)->get();
						  
				$html .= $dataa[0]['superior'];

                //$html .='<div style="text-align:justify;"><p>Fueron electos :</p></div>';




          $data = \DB::connection('mysql')->select('SELECT * from vt_totales as a
			where a.id_evento = '.$id_evento.'');


          $CantRegistros = count($data);                        // CANTIDAD de Registros

          if($CantRegistros>0)  
          {
				  
		      $datos1 = \DB::connection('mysql')->select('SELECT id_evento,id_area,area_etiqueta from vt_totales WHERE id_evento='.$id_evento.'  GROUP BY id_evento,id_area');

				foreach ($datos1 as $grupovotacion)
				{
					
					$datos2 = \DB::connection('mysql')->select('SELECT * from vt_totales as a where a.id_evento = '.$id_evento.' and  a.id_area = '.$grupovotacion->id_area.' order by a.id_area,cantidadvotos DESC');
					
				  
					$html.='<table border="1" style="border-collapse: collapse;width:100%;padding:15px;">
					<tr><td colspan=3> '.htmlentities($grupovotacion->area_etiqueta).' </td></tr>
					<tr>
						 <td style="width:310px;text-align:center;padding:7px;">Delegado</td>
                         <td style="width:75px;text-align:center;padding:7px;">No. Asoc</td>
						 <td style="width:135px;text-align:center;padding:7px;">Cantidad de Votos</td>
					</tr>';
	
					  foreach ($datos2 as $registrosvotacion)
					  {

								$html.='<tr>
								<td>&nbsp;'.htmlentities($registrosvotacion->nombre).' &nbsp;  '.htmlentities($registrosvotacion->apellido).'</td>
								<td  style="width:75;text-align:center;padding:7px;">'.$registrosvotacion->aspirante.'</td>
								<td style="width:135px;text-align:center;padding:7px;">'.$registrosvotacion->cantidadvotos.'</td>
								</tr>';					
					
						} 
						$html .='</table><br/>';						
				}
		  }


					

					
				$html .=  $dataa[0]['inferior'];

                $html .='<div style="position: fixed; bottom: 0;"> <img src="../../assets/images/footer.jpg" style="margin: 0; width:100%;" /></div>';
				
				$html .= '</html>';
			//dd($html);	
		  $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
		  
          $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

          $mpdf->SetHeader($header);

          $mpdf->SetProtection(array('print'));
          $mpdf->SetTitle("Reporte Votacion Cooperativa");
          $mpdf->SetAuthor("Cooperativa Profesionales");
          $mpdf->SetDisplayMode('fullpage');
          $nombre = "ReporteVotacion".date("YmdHms").".pdf";
          $mpdf->Output($nombre, 'I');
  }

  
}
