@extends('layouts.dashboard')

@section('content')

<div class="row ">
      		<div class="col-md-12">
						

            
            
	<div class="row ">
	   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputevento">Seleccione Evento Asamblea</label>
		<select id="eventos" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="Cargar(this.value)" >
							<option value="#"> -- Elegir</option>
							@foreach ($eventos as $dataeventos)
								<option value="{{ $dataeventos->id }}"> {{ $dataeventos->nombre }}</option>
							@endforeach
		</select>
	  </div> 
	</div>
	

			</div>


     <div class="col-md-12">

                      <div class="row ">
                         <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
                        <label for="inputevento">Seleccione tipo de invitaci&oacute;n </label>
                        <select id="tipo_invitacion" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="selecciontipo(this)" >
                                  <option value="1"> Acceso a Propuestas</option>
                                  <option value="2"> Invitaci&oacute;n Votaci&oacute;n </option>
                        </select>
                        </div> 
                      </div>

      </div>


        <div class="col-md-12"  id="areaimportacion" style="display:none">

                            <div class="card" >
                              <div class="card-header bg-light resaltado">IMPORTAR LISTADO CSV (2 columnas una con el c&oacute;digos de asociado y la siguiente columna con el correo del asociado) </div>
                              <div class="card-body" >
                                <!-- dropzone  -->
                                <form action=" {{ url('/sistema/uploadsoporte') }}"  enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                  <input type="hidden"  id="up_id_evento" name="up_id_evento"  data-bindto="parametros.up_id_evento"  value="">
                                  <input type="hidden"  id="tipo_invitacion" name="tipo_invitacion"  data-bindto="parametros.tipo_invitacion" value="1" >
                                  {{ csrf_field() }}
                                </form>
                                <!-- AREA DONDE SE LISTARAN LOS ARCHIVOS ADJUNTOS UNA VEZ SUBIDOS -->
                                <table  class="table" style="width:100%" id="gs_tbl_GestionesArchivos"> </table>
                              </div>
                            </div>
                
        </div>

  
                    <div class="col-sm-12 col-md-12 col-lg-12"  >
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
  
		</div>






@endsection



@section('page-script')

	  
			<script src="{{ asset('js') }}/php-date-formatter.min.js"></script>
			<script src="{{ asset('js') }}/jquery.mousewheel.js"></script>
			<script src="{{ asset('js') }}/jquery.datetimepicker.js"></script>
			<link rel="stylesheet" type="text/css" href="{{ asset('css') }}/jquery.datetimepicker.css"/>


      <script type="text/javascript" src="{{ url('assets/dropzone') }}/dropzone.js"></script>
      <link rel="stylesheet" type="text/css" href="{{ url('assets/dropzone') }}/dropzone.css"/>



<script>

  function Cargar(){
    
  var dato = $('#eventos').val() ;
  
  	modelo.up_id_evento = dato;
  
    modelo.tipo_invitacion = $('#tipo_invitacion').val();
    editor.setValue(JSON.stringify(modelo,undefined,2));
  
    if($('#eventos').val() =='#')
    {
      $('#areaimportacion').css('display','none');
      $('#area_btn_procesar').css('display','none');
    }
    else{
      $('#areaimportacion').css('display','block');
      $('#area_btn_procesar').css('display','block');
    }

    
  }
  var editor = CodeMirror.fromTextArea(codeMirrorDemo, {
    lineNumbers: true,
    mode: "htmlmixed",
    theme: "monokai"    
  });
  
  
  var modelo = {
    'up_id_evento':'#',
    'tipo_invitacion': "1"
  }; 
  
  
function seleccionevento(elemento)
{     
    modelo.up_id_evento = elemento.value;
    editor.setValue(JSON.stringify(modelo,undefined,2));
    Cargar();
}

function selecciontipo(elemento)
{     
    modelo.tipo_invitacion = elemento.value;
    editor.setValue(JSON.stringify(modelo,undefined,2));
    Cargar();
}  
  
  



  
  
  Dropzone.autoDiscover = false;
  // or disable for specific dropzone:
  // Dropzone.options.myDropzone = true;

    var config = {
              paramName: 'file',
              //autoProcessQueue: true,
              uploadMultiple: false,
              maxFilesize: 20, // MB
              //parallelUploads: 1,
              //maxFiles: 1,
              acceptedFiles: ".csv",
              init: function () {
                  this.on("queuecomplete", function () {
                       console.log('Termino de subir');
                      // setTimeout(function(){ location.reload();  }, 3000);
                    
	                      //espere('Cargando');
												//cargarlistado(1);  
                        //terminar_espere();
                    
                  });
              }
          };

    var myDropzone = new Dropzone(".dropzone",config);


    $(function() {

       var gdb1=new GDB({parametros: modelo},{rootElementSelectorString: '#widget1',
            modelChangeCallback: function(e){
              //console.log(modelo);
               editor.setValue(JSON.stringify(modelo,undefined,2));
            }
        });
    });  
  
  
  $('#eventos').val('#').attr("selected", "selected");
  

  
  
  $(document).ready(function () 
  {

    
  });

  
</script>



@stop

