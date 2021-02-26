<?php

namespace Modules\Sistema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Modules\Sistema\Entities\aspiranteModel;
use Modules\Cliente\Entities\adjuntos_Model;
use DB;
use Validator;
use File;

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
                   $data = aspiranteModel::select(['id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo'])->where('eliminado',0);
                   return Datatables::of($data)
                   ->addColumn('action', function ($data) {
                     return ' <button class="dropdown-item btn-danger"  onclick="Eliminar('. trim($data->id_delegado). ')"><i class="icon-book-open"></i> Eliminar</button><button class="dropdown-item btn-warning"  onclick="Cargar('. trim($data->id_delegado). ')"><i class="icon-book-open"></i> Selecci&oacute;n</button>';
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
                   $data = aspiranteModel::select(['id_delegado','num_cliente','nombre','apellido','img_delegado','estado','user_audit','fecha_aud','foto','tipo','memoria','tipo','foto','adjunto'])->where('id_delegado',$buscando)->get();
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
           $files = $request->input('otrosobjetos');
           $osi = json_decode($files);
           $id_cv = $osi->{'id_cv'} ;
           
           // si la imagen cambio; borro fisicamente la anterior
             
           $datos = aspiranteModel::where('id_delegado',$id_delegado)->get();
           
           if(trim($datos[0]->foto)!=trim($osi->{'avatarBase64'}))
           {
             // la borro fisicamente
              if(File::exists(base_path('public/adjuntos')."/".trim($datos[0]->foto)))
              {
                  $bandera=File::delete(base_path('public/adjuntos')."/".trim($datos[0]->foto));
              }             
           }
           //dd($datos[0]->id_cv);  
           if(trim($datos[0]->adjunto)!=trim($osi->{'id_cv'}))
           {
              $dataxx =DB::select('select * from files_up where id='.$datos[0]->adjunto.'');
             // la borro fisicamente
              if(File::exists(base_path('public/adjuntos')."/".trim($dataxx[0]->name_system)))
              {
                  $bandera=File::delete(base_path('public/adjuntos')."/".trim($dataxx[0]->name_system));
                  if($bandera){
                    DB::select('delete from files_up where id='.$datos[0]->adjunto.'');
                  }
              }             
           }
                 
                 
           //$porcion = $osi->{'avatarBase64'};// explode("base64,",  $osi->{'avatarBase64'});
           //$avatarBase64 =  $porcion[1] ;
           $tipo_imagen =$osi->{'tipo_imagen'}; //'data:'.$osi->{'tipo_imagen'}.';' ;    
             
             //dd($files);
            $osi = json_decode($files);  
            $memoria= $osi->{'memoria'} ;
            $data = aspiranteModel::where('id_delegado',$id_delegado)->update(['num_cliente'=> $numasoc , 'nombre'=> $nombreasoc , 'apellido'=> $apellidoasoc , 'memoria'=> $memoria, 'adjunto'=> $id_cv, 'foto'=> $osi->{'avatarBase64'} ,  'tipo'=> $osi->{'tipo_imagen'} ]);
				   return $data;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }	
    
      
     public function obteneradjunto(Request $request)
     {
           try
           {
              $retorno="";
              $data =DB::select('select * from files_up where id='.$request->input('id_cv').'');
    
               if(count($data)>0)
               { 
                  $retorno='../../../adjuntos/'.$data[0]->name_system;
               }
             
             
				      return $retorno;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }           
    }
  
  
     public function agregarnuevo(Request $request)
     {
           try
           {		
          $files = $request->input('otrosobjetos');
          $osi = json_decode($files);  
          $memoria= $osi->{'memoria'} ;
          $id_cv = $osi->{'id_cv'} ;
             
          //$porcion = explode("base64,",  $osi->{'avatarBase64'});
 
          //$avatarBase64 =  $porcion[1] ;
          //$tipo_imagen = 'data:'.$osi->{'tipo_imagen'}.';' ;    

          $avatarBase64 = $osi->{'avatarBase64'} ;
          $tipo_imagen = $osi->{'tipo_imagen'} ;    
             
             $data =DB::select('select * from directivos where num_cliente='.$request->input('numasoc').'');
    
             if(count($data)==0)
             {
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
             }
             else
             {
               // $entidad = aspiranteModel::where('num_cliente',$request->input('numasoc'))->update(['nombre'=> $request->input('nombreasoc'), 'apellido'=> $request->input('apellidoasoc'), 'memoria'=> $memoria, 'adjunto'=> $id_cv, 'foto'=> $avatarBase64 ,  'tipo'=> $tipo_imagen  ]);
             }

				   return $entidad;
           } catch (Exception $e) {
                  return json(array('error'=> $e->getMessage()));
           }
     }

  
  
  
    function almacenarfile(Request $request)
    {
        $id_retorno ='';
       $validation = Validator::make($request->all(), [
        'select_file' => 'required|mimes:pdf,docx,jpeg,png,jpg,gif|max:2048'
       ]);
      
   
     if($validation->passes())
     {
      $image = $request->file('select_file');
       //dd($request->input('clasoc_id'));
      $extension = $image->getClientOriginalExtension();
      $tipoarchivo = $image->getMimeType();    
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
        //dd($new_name);
      //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);  
      //$image->move(public_path('images'), $new_name);
      $upload_success = $image->move(base_path('public/adjuntos'),$new_name);
      
      if ($upload_success) {
        
          //$nombrefile = $image->getClientOriginalName();

         //dd( $tipoarchivo );  
          //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);

          $peso = filesize(base_path('/public/adjuntos/').$new_name);
         
        	 $entidad  = new adjuntos_Model();
				   $entidad->name_system = trim($new_name);
           $entidad->cldoc = $request->input('clasoc_id');
           $entidad->etiqueta = 'Hoja de Vida';
				   $entidad->extension = $extension;
           $entidad->tipoarchivo = $tipoarchivo;
           $entidad->sizefile = $peso;
				   $entidad->save();
           //dd($entidad->id);
           // \DB::connection('mysql')->statement('call pr_subir_file (?,?,?,?,?,?,?)', array($id_evento,$request->session()->get('cldoc'),strtolower($nombrefile),strtolower($nombre),strtolower($extension),$tipoarchivo,$peso));
           $id_retorno =$entidad->id;
      }
       
       
       
      return response()->json([
       'message'   => 'Documento Adjuntado',
       'uploaded_doc' => $new_name,
       'id_uploaded_doc' => $id_retorno,        
       'class_name'  => 'alert-success'
      ]);
       
     }
     else
     {
      return response()->json([
       'message'   => $validation->errors()->all(),
       'uploaded_doc' => '',
       'id_uploaded_doc' => $id_retorno, 
       'class_name'  => 'alert-danger'
      ]);
     }
    }
	 
  
    function almacenarfotoperfil(Request $request)
    {
        $id_retorno ='';
       $validation = Validator::make($request->all(), [
        'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
       ]);
      
   
     if($validation->passes())
     {
      $image = $request->file('select_file');
      $extension = $image->getClientOriginalExtension();
      $tipoarchivo = $image->getMimeType();    
      //$new_name = rand() . '.' . $image->getClientOriginalExtension();
      $new_name = date('YmdHms') . '.' . $image->getClientOriginalExtension();
        //dd($new_name);
      //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);  
      //$image->move(public_path('images'), $new_name);
      $upload_success = $image->move(base_path('public/adjuntos'),$new_name);
      
      if ($upload_success) {
        
          //$nombrefile = $image->getClientOriginalName();

         //dd( $tipoarchivo );  
          //$nombre = strtolower(Auth::user()->id."_".date('YmdHms')."_".uniqid('file_'.uniqid()).".".$extension);

          $peso = filesize(base_path('/public/adjuntos/').$new_name);
         
        	 $entidad  = new adjuntos_Model();
				   $entidad->name_system = trim($new_name);
           $entidad->etiqueta = 'Imagen de Perfil';
				   $entidad->extension = $extension;
           $entidad->tipoarchivo = $tipoarchivo;
           $entidad->sizefile = $peso;
				   $entidad->save();
           //dd($entidad->id);
           // \DB::connection('mysql')->statement('call pr_subir_file (?,?,?,?,?,?,?)', array($id_evento,$request->session()->get('cldoc'),strtolower($nombrefile),strtolower($nombre),strtolower($extension),$tipoarchivo,$peso));
           $id_retorno =$entidad->id;
      }
       
       
       

      return response()->json([
       'message'   => 'Documento Adjuntado',
       'uploaded_doc' => $new_name,
       'tipo_imagen' => $tipoarchivo ,
       'class_name'  => 'alert-success'
      ]); 
       
     }
     else
     {
      return response()->json([
       'message'   => $validation->errors()->all(),
       'uploaded_doc' => '',
       'tipo_imagen' => $id_retorno, 
       'class_name'  => 'alert-danger'
      ]);

       
       
     }
    }
  
  
  /*
    function almacenarfotoperfil(Request $request)
    {
     $validation = Validator::make($request->all(), [
      'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
     ]);
     if($validation->passes())
     {
      $image = $request->file('select_file');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $tipoarchivo = $image->getMimeType();    

      $image = 'data:'.$tipoarchivo.';base64,'.base64_encode(file_get_contents($request->file('select_file')));

      return response()->json([
       'message'   => 'Documento Adjuntado',
       'uploaded_doc' => $image,
       'tipo_imagen' => $tipoarchivo ,
       'class_name'  => 'alert-success'
      ]);
     }
     else
     {
      return response()->json([
       'message'   => $validation->errors()->all(),
       'uploaded_doc' => '',
       'tipo_imagen' => '' ,
       'class_name'  => 'alert-danger'
      ]);
     }
    }	
    */
}
