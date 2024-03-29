@extends('cliente::layouts.master')


@section('content')

<div class="row">

</div>

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <div class="col-sm-12 col-md-12 col-lg-12">

                        {!! $mensaje !!}

                </div>
         
                <h3 class="profile-username text-center">{{ $nombreevento }}</h3>

                <p class="text-center"> </p> <p class="text-muted text-center">DIA DEL EVENTO {{ $f_inicia }}</p>
             

                @if($existecuentazoom==0)
                <ul class="list-group list-group-unbordered mb-3"  id="widget1">
                  
                   <li class="list-group-item">
 
                    <b style="color:blue" class=" float-left">Ingresa tu cuenta de correo con la que utilizar&aacute;s la plataforma Zoom</b><b style="color:red">*</b>
                    
                    <div class="input-group col-sm-12 col-md-4 col-lg-4 float-right ">
                            <div class="input-group-prepend">
                                  <span class="input-group-text">@</span>
                            </div>
                            <input type="text"  id="veri_zoom_email_01" data-bindto="parametros.veri_zoom_email_01"  name="veri_zoom_email_01" class="form-control "  value="" /> 
        
                    </div>
                    
                    
                  </li>  
                  
                  <li class="list-group-item">

                    <b style="color:blue" class=" float-left">Confirma la cuenta de correo de zoom escrita anteriormente para validar que este bien</b><b style="color:red">*</b>
                    
                    <div class="input-group col-sm-12 col-md-4 col-lg-4 float-right ">
                            <div class="input-group-prepend">
                                  <span class="input-group-text">@</span>
                            </div>
                            <input type="text"  id="veri_zoom_email_02" data-bindto="parametros.veri_zoom_email_02"  name="veri_zoom_email_02" class="form-control "  value="" /> 
                    </div>
                  </li>  

                </ul>
                 @else
                <ul class="list-group list-group-unbordered mb-3" >

                  
                  <li class="list-group-item">

                    <b style="color:blue" class=" float-left">Cuenta de correo de zoom proporcionada!</b>
                    
                    <div class="input-group col-sm-12 col-md-4 col-lg-4 float-right ">
                            <div class="input-group-prepend">
                                  <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control " disabled  value="{{ $cuentazoom }}" /> 
                    </div>
                  </li>  

                </ul>                  
                @endif
                
    
                @if($existecuentazoom==0)
                <a type="button" href="#" onclick="guardarasistencia()" class="btn btn-block btn-success" >CONFIRMA TU ASISTENCIA AQUI</a>
                @endif          
                               
                @if($existecuentazoom==1 && $periactico)
                <a type="button"style="" href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block btn-success" >INGRESAR EN PANEL</a>
                @endif      
                
                
              </div>
            </div>
       </div> 



<div class="col-sm-12 col-md-12 col-lg-12" style="display:none">
       <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                DEVELOPER
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo" class="p-3">
                
                
              </textarea>
            </div>
            <div class="card-footer">
            
            </div>
      </div>
</div>



@endsection

  
@section('page-script')

<link rel="stylesheet" href="../dist/css/adminlte.min.css">

<script>

  $( document ).ready(function() {
  
     $("#submit-btn").click(function () {
        beforeSubmit();
    });


  });     
  

  
  
  var modelo = {
    'id_evento':'{{ $id_evento }}',
    'tipoevent':'{{ $tipoevent }}',
    'nombre_evento':'{{ $nombreevento }}',
    'f_inicia':'{{ $f_inicia }}',
    'f_termina':'{{ $f_termina }}',
    'num_cliente':'{{ $num_cliente }}',
    'ocupacion':'{{ $ocupacion }}',
    'profesion':'{{ $profesion }}',
    'trato':'{{ $trato }}',
    'nombre':'{{ $nombre }}',
    'agencia':'{{ $agencia }}',
    'asistire': 1,
    'f_asistire_regis':moment().format('YYYY-MM-DD HH:mm:ss'),
    'soy_aspirante': 0,
    'cantidato_delegado': 0,
    'junta_directores': 0,
    'junta_vigilancia': 0,
    'comite_credito': 0,
    'veri_zoom_email_01': '',
    'veri_zoom_email_02': ''
  };
     

	function guardarasistencia()
	{

         // VALIDAR QUE CUENTAS DE CORREO ESCRITAS SEAN IGUALES y QUE NO ESTEN EN BLANCO
    if( modelo.veri_zoom_email_01=='' || modelo.veri_zoom_email_01.length ==0 ){
        lobibox_emergente('warning','top center',true,'Cuenta de email 1 es requerida.');
      return false;
    }
  
    if( modelo.veri_zoom_email_02=='' || modelo.veri_zoom_email_02.length ==0 ){
        lobibox_emergente('warning','top center',true,'Cuenta de email 2 es requerida.');
      return false;
    }      
       
    if( (modelo.veri_zoom_email_01!='' && modelo.veri_zoom_email_02!='') && (modelo.veri_zoom_email_01.trim() == modelo.veri_zoom_email_02.trim())   )
    {
             Swal.fire({
                     title: 'Esta a un paso; para registrar tu participación',
                     text: "Se procederá a guardar este registro.",
                     type: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Si, Deseo participar!',
                     cancelButtonText: 'Retroceder!',
                     confirmButtonClass: 'btn btn-success',
                     cancelButtonClass: 'btn btn-warning',
                     buttonsStyling: false
                   }).then(function (result) 
                       {

                        if (result.isConfirmed) 
                        {
                          //alert($('meta[name="csrf-token"]').attr('content'));



                            $.ajax({
                              url: '{{ url("cliente/inscripcion/guardaasistencia")}}',
                              data: { datos : JSON.stringify(modelo)  },
                              method: 'get',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              success: function(result){
                                  lobibox_emergente('success','top right',true,'actualizado.');
                                  setTimeout(function(){ location.reload();  }, 2000);
                              },
                              error: function (r) {
                                  //lobibox_emergente('success','top right',true,'de seguro error.');
                                  console.log("ERROR");
                                  console.log(r);
                              }
                            });

                        }
                });
      }
    else
      {
        lobibox_emergente('warning','top center',true,'Verifique que las cuendas de email escritas sean iguales.');
        
      }
	}
 
    var editor = CodeMirror.fromTextArea(codeMirrorDemo, {
    lineNumbers: true,
    mode: "htmlmixed",
    theme: "monokai"    
  });
  
  
    $(function() {
    
     var gdb1=new GDB({parametros: modelo},{rootElementSelectorString: '#widget1',
          modelChangeCallback: function(e){
            //console.log(modelo);
             editor.setValue(JSON.stringify(modelo,undefined,2));
          }
      });
  });
</script>
@stop	   
  



