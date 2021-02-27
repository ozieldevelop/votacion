@extends('cliente::layouts.master')


@section('content')
    <div class="justify-content-center" {{-- style="background-color: green" --}}>
        <div class="">
            <div class="card mt-2 mb-2">
                {{-- <div class="card-header"><h4>Formulario de Registro</h4></div> --}}
                <div id="register_form" class="card-body">                    
                    <div class="text-center" >                        
                        <div style="float: left;">
                            <img src="/images/logo-cooperativa.png" alt="" style="height:90px;">
                        </div>
                        <div>
                            <h4><b>COOPERATIVA PROFESIONALES, R.L.</b></h4>
                            <p><i><b>Éxito, cooperación y confianza</b></i></p>
                            <h4>Inscripción a la Reunion Capitular</h4>
                        </div>
                    </div>
                    <hr>                    
                    <div class="form-row">
                        <div class="col-md-12">
                            <p>Tema: <span><strong>{{ $nombreevento }}</strong></span></p>
                            {{-- <p>Tema: <span><strong>@{{ tema }}</strong></span></p> --}}
                        </div>
                        <div class="col-md-12">
                            <p>Descripción: <span><strong>@{{ descripcion }}</strong></span></p>
                        </div>
                        <div class="col-md-12">
                            {{-- <p>Hora: <span><strong>@{{ hora }}</strong></span></p> --}}
                            <p>Hora: <span><strong>{{ $f_inicia }}</strong></span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12 col-md-12 col-lg-12">

                        {!! $mensaje !!}

                    </div>
                    <hr>
                    <form action="{{ route('postRegistro') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="numero_asoc">Número de Asociado:</label>
                                <input id="numero_asoc" name="numero_asoc" type="text" class="form-control" placeholder="101">
                            </div>
                            <div class="col">
                                <label for="nombre_asoc">Nombre del Asociado:</label>
                                <input id="nombre_asoc" name="nombre_asoc" type="text" class="form-control" placeholder="Juan Perez">
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
                <a type="button" href="#" onclick="guardarasistencia()" class="btn btn-block btn-primary" >CONFIRMA TU ASISTENCIA AQUI</a>
                @endif          
                               
                @if($existecuentazoom==1 && $periactico)
                <a type="button"style="" href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block btn-primary" >INGRESAR EN PANEL</a>
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
                              method: 'post',
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
  




