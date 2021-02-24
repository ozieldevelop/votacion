@extends('cliente::layouts.master')

@section('content')
<<<<<<< HEAD
    <div class="row justify-content-center" style="background-color: green">
        <div class="col-md-6">
            <div class="card mt-2 mb-2">
                {{-- <div class="card-header"><h4>Formulario de Registro</h4></div> --}}
                <div id="register_form" class="card-body">
=======

<div class="row">

</div>

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card  card-outline">
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
>>>>>>> 4d290feae18bc44f423800b963d4a9b2504af997
                    
                    <div class="text-center" >                        
                        <div style="clear: left;">
                            <p style="float: left;"><img src="/images/logo-cooperativa.png" alt=""></p>
                            <h5><strong>COOPERATIVA PROFESIONALES, R.L.</strong></h5>
                        </div>
                        <div>
                            <i><strong>Éxito, cooperación y confianza</strong></i>
                        </div>
                        <div>
                            <h4>Inscripción al Seminario Web</h4>
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
<<<<<<< HEAD
                    <form action="{{ route('postRegistro') }}" method="post">
                        @csrf
                        <hr>
                        <div class="form-row">
                            <div class="col">
                                <label for="numero_asoc">Número de Asociado:</label>
                                <input id="numero_asoc" name="numero_asoc" type="text" class="form-control" placeholder="101">
                            </div>
                            <div class="col">
                                <label for="nombre_asoc">Nombre del Asociado:</label>
                                <input id="nombre_asoc" name="nombre_asoc" type="text" class="form-control" placeholder="Juan Perez">
                            </div>
                        </div>
                        <br>
                        <div class="form-row mb-2">
                            <div class="col">
                                <label for="email">Dirección de Correo Electronico:</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Ejemplo: juan.perez@cooprofesionales.com.pa">
                            </div>
                            <div class="col">
                                <label for="email_confirmation">Confirmar Correo Electronico:</label>
                                <input id="email_confirmation" name="email_confirmation" type="email" class="form-control" placeholder="Ejemplo: juan.perez@cooprofesionales.com.pa">
                            </div>
                        </div><br>
                        <button type="submit" class="btn btn-primary">Registrarme</button>
                    </form>
                </div>
=======
                  </li>  

                </ul>                  
                @endif
                
    
                @if($existecuentazoom==0)
                <a type="button" href="#" onclick="guardarasistencia()" class="btn btn-block" style="background:#3c4199;color:white">REGISTRARME</a>
                @endif          
                               
                @if($existecuentazoom==1 && $periactico)
                <a type="button"  href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block"  style="background:#3c4199;color:white">INGRESAR EN PANEL</a>
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
            
>>>>>>> 4d290feae18bc44f423800b963d4a9b2504af997
            </div>
        </div>
    </div>
@endsection()

@section('page-script')

<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const app = new Vue({
            el: '#register_form',
            // components: { App }
            data: {
                tema: 'Seminario de prueba',
                descripcion: 'Seminario web en zoom (prueba)',
                hora: '29 de febrero 2021',
                asociados: [],
            },
            
            mounted() {
                this.cargarAsociados();
            }, 

            methods: {
                cargarAsociados: function() {
                    axios.get('/api/asociados')
                    .then( (response) => {
                        this.asociados + response.data.data;
                    })
                    .catch( function(err) {
                        alert("Hubo un error: " + err);
                    });
                }
            }
        });
    </script>
@stop	   
=======
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
  




>>>>>>> 4d290feae18bc44f423800b963d4a9b2504af997
