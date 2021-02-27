@extends('cliente::layouts.master')


@section('content')

  <style>
  .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: #008d5e !important;
}
.btn-primary {
    background-color: #30419b;
    border: 1px solid #30419b;
}
  </style>


         <div id="register_form">
            <div class="text-center" >
               <div style="clear: left;">
                  <p style="float: left;"><img src="/images/logo-cooperativa.png" alt=""></p>
                  <h5><strong>COOPERATIVA PROFESIONALES, R.L.</strong></h5>
               </div>
               <div>
                  <i><strong>Éxito, cooperación y confianza</strong></i>
               </div>
               <div>
                  <h4>Formulario de Inscripci&oacute;n al Evento</h4>
               </div>
            </div>
            <hr>
            <div class="form-row">
               <div class="col-md-12">
                  <p>Tema: <span><strong>Registro a puesto directivos</strong></span></p>
               </div>
               <!--div class="col-md-12">
                  <p>Descripción: <span><strong>Descripcion</strong></span></p>
               </div-->
               <div class="col-md-12">
                  <p>Hora: <span><strong> {{ $f_inicia }} </strong></span></p>
               </div>
            </div>
            <hr>
            <!--div class="col-sm-12 col-md-12 col-lg-12">
               <div class='col-xs-4 text-center' style='vertical-align: middle;'>
                  <h1>Muchas gracias por confirmar tu asistencia!</h1>
               </div>
               <div class='col-xs-4 text-center' style='vertical-align: middle;'>
                  <h4>Te esperamos</h4>
               </div>
               <div class='col-xs-4 text-center' style='vertical-align: middle;'> DR&nbsp;Leandra Sanchez</div>
            </div>
            <form action="http://cooperativa.eaguilars.com/cliente/registro" method="post">
               <input type="hidden" name="_token" value="YlTEN8VPo27d4oPHPJLvHqLkJ3PWqklq8HZB2Wmb">                        
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
               </div>
               <br>
               <button type="submit" class="btn btn-primary">Registrarme</button>
            </form-->
         </div>




  

 <div class="row">  
          <div class="form-group col-sm-12 col-md-12 col-lg-6">

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="inputapellidoasoc" style="color:blue">Seleccionar tipo de documento a subir</label>
                        <select id="tipodoc" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="console.log(this.value)" >
                                  <option value="1"> Hoja de Vida </option>
                                  <option value="2"> Foto de perfil </option>
                        </select>

                    </div>       

                     <div class="form-group col-sm-12 col-md-12 col-lg-12">
                       <div class="alert" id="message" style="display: none"></div>
                       <form method="post" id="upload_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_tipo_doc" id="id_tipo_doc" value="1"/>
                        <input type="file" name="select_file" id="select_file" />
                       </form>



                    </div>

                   <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="inputapellidoasoc" style="color:black">Documentos Adjuntados</label>
                      <br/><a href="#" id="fotoexistente"  target="_blank" style="display:none">Ver foto de perfil</a>
                      <br/><a href="#" id="cvexistente"  target="_blank" style="display:none">Descargar hoja de vida existente</a>
                    </div>   

                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="inputapellidoasoc" style="color:blue">Memorias</label>
                      <textarea class="form-control" id="memoria" style="resize:none" ></textarea>
                    </div>
            
            
          </div>
          <div class="form-group col-sm-12 col-md-12 col-lg-6">
                 <ul class="list-group list-group-unbordered mb-3"  id="widget1">





                         <li class="list-group-item">
                              <b style="color:blue;font-size:18px">Nos gustar&iacute;a saber a que &oacute;rgano de gobierno te gustar&iacute;a ser aspirante  :</b> 
                        </li>                         




                            <li class="list-group-item">
                              <b style="color:black">Junta de Directores</b> <label   class="float-right"><input type="checkbox"  id="juntadire" class="juntadire_class"> </label>
                            </li>  
                            <li class="list-group-item">
                              <b style="color:black">Junta de Vigilancia</b> <label   class="float-right"><input type="checkbox"  id="juntavigi" class="juntavigi_class">  </label>
                            </li>     
                            <li class="list-group-item">
                              <b style="color:black">Comit&eacute; de Cr&eacute;dito</b> <label   class="float-right"><input type="checkbox"  id="comite_credi" class="comite_credi_class">  </label>
                            </li>   

                          </ul>

                          <!-- debe haber confirmado su cuenta de correo para zoom almenos -->

                @if($asistire==0 )
                  <a type="button" href="#" onclick="guardarasistencia()" class="btn btn-block btn-primary" style="background:#3c4199;color:white">GUARDAR REGISTRO</a>
                @endif       
            






            
            
            
            
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
               
                
                 @if($asistire==1 )
                 <a type="button" href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block"  style="background:#3c4199;color:white;">IR AL PORTAL DEL EVENTO</a>
                @endif          



@endsection

  
@section('page-script')

<link rel="stylesheet" href="../dist/css/adminlte.min.css">

	  <script src="{{ asset('js/ckeditor.js') }}"></script>


			<script>
        
function Cargar(dato)
{

    $('#fotoexistente').css('display','none');  
    $('#cvexistente').css('display','none');  
    $('#fotoexistente').attr('href','#');  
    $('#cvexistente').attr('href','#');  
  
		CKEDITOR.instances['memoria'].setData('')   ;
	
		$.ajax({
			type: "GET",
			url: '{{ url("sistema/cargardatoaspirante")}}', 
			data: {"buscando": dato },
			success: function(datoz){
      /*
            var memoria =datoz[0]['memoria'];	
						var foto = datoz[0]['foto'] ? datoz[0]['foto'] : '';
            var tipo = datoz[0]['tipo'] ? datoz[0]['tipo'] : '';	
            var id_cv = datoz[0]['adjunto'] ? datoz[0]['adjunto'] : '';  
        
            if(foto!='')
            {
              $('#fotoexistente').css('display', 'block');
              modelo.tipo_imagen =tipo;
              modelo.avatarBase64 =foto;     
              $('#fotoexistente').attr('href', tipo+'base64,'+foto); 
            }
        
            if(id_cv!='')
            {
                $('#cvexistente').css('display', 'block');
                model.id_cv =id_cv;
                $.ajax({
                  type: "GET",
                  url: '{{ url("sistema/obteneradjunto")}}', 
                  data: {"id_cv": id_cv },
                  success: function(datoz){
                        $('#cvexistente').attr('href', '../../../'+datoz); 
                  }
                });
            }
        
            CKEDITOR.instances['memoria'].setData(memoria);
        */

			},
			error: function (r) {
				console.log("ERROR");

				console.log(r);
			}
		});


}        
        
        
        
									
											CKEDITOR.replace('memoria', { 
													toolbar : [
														{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },


														'/',
														{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline' ] },
														{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },


													],
													on: {
														change: function( evt ) {
                           
															var dddd1 =  evt;
															//model.asuntoemail =$('#asuntoemail').val();
															//alert(dddd1.editor.name);
															if( dddd1.editor.name == 'memoria')
															{
																modelo.memoria =dddd1.editor.getData();
															}	
                          
														}
													}										
											});  
        
    </script>  


<script>

  
  function candidatodele_class_fn()
{
          var elf = document.getElementById('candidatodele').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.cantidato_delegado = 1;
              }
              else {
                          modelo.cantidato_delegado = 0;
              }
  }

 function juntadire_class_fn()
{
          var elf = document.getElementById('juntadire').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.junta_directores = 1;
              }
              else {
                          modelo.junta_directores = 0;
              }
  }

function juntavigi_class_fn()
{
          var elf = document.getElementById('juntavigi').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.junta_vigilancia = 1;
              }
              else {
                          modelo.junta_vigilancia = 0;
              }
 }
 
    var editor = CodeMirror.fromTextArea(codeMirrorDemo, {
    lineNumbers: true,
    mode: "htmlmixed",
    theme: "monokai"    
  });
  
  
  var modelo = {
    'id_asistencia':'{{ $id_asistencia }}',
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
    'soy_aspirante':'{{ $soy_aspirante }}',
    'cantidato_delegado':'{{ $cantidato_delegado }}',
    'junta_directores':'{{ $junta_directores }}',
    'junta_vigilancia':'{{ $junta_vigilancia }}',
    'comite_credito': '{{ $comite_credito }}',
    'veri_zoom_email_01' :'{{ $veri_zoom_email }}',
    'veri_zoom_email_02':'{{ $veri_zoom_email }}',
    'cambioimagen' : 0,
    'id_cv':'',
     'tipo_imagen':'',
     'avatarBase64':'',
    'memoria':''
  };
     

	function guardarasistencia()
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

                            $.ajax({
                              url: '{{ url("cliente/inscripcion/guardaasistencia")}}',
                              data: { datos : JSON.stringify(modelo)  },
                              method: 'post',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              success: function(result){
                                  lobibox_emergente('success','top right',true,'actualizado.');
                                  var retorno = (result).length;
                                  //alert(result);
                                 
                                  if(modelo.cambioimagen==1 && retorno!='' ){
                                    saveImagen(result);
                                  }
                                else
                                  {
                                      //setTimeout(function(){ location.reload();  }, 2000);
                                  }
                                
                                 // 
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
  
  
  
 
  
  
function saveImagen(id_directivo)
{

  
  
              var imagenconten = $('#outputimage').attr('src');
              var imagencon = imagenconten.split('base64,');
              //console.log(imagencon[0]);
              var llimagen = imagencon[1];
              var formato = imagencon[0];
     
							$.ajax({
								url: '{{ url("sistema/saveimageanddatos")}}',
								data: {"aspiranteidBD": id_directivo, "llimagen": llimagen, "formato": formato},
								method: 'post',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
											Lobibox.notify('info', {
												msg: 'Guardado.'
											});		
											
                      setTimeout(function(){ location.reload();  }, 2000);
								},
								error: function (r) {
									console.log("ERROR");
								}
							});
}

  
  
  
  
  
function encodeImageFileAsURL(ftype){

    var fileUpload = $('#imageInput').get(0);
    var file = fileUpload.files;


    // alert(file);
    if (file.length > 0)
    {
        var fileToLoad = file[0];

        var fileReader = new FileReader();

        fileReader.onload = function(fileLoadedEvent) {
            var srcData = fileLoadedEvent.target.result; // <--- data: base64

            // alert(srcData);
            upload(srcData,ftype);
        };
        fileReader.readAsDataURL(fileToLoad);
    }
}
  
function comite_credi_class_fn()
{
          var elf = document.getElementById('comite_credi').checked;
          console.log(elf);
              if(elf)
              {
                          modelo.comite_credito = 1;
              }
              else {
                          modelo.comite_credito = 0;
              }
 }
   
 function visualizarparametros()
 {


       if(modelo.junta_directores == 0 && modelo.junta_vigilancia == 0 && modelo.comite_credito == 0 )
       {
          modelo.soy_aspirante=0;
       }
       else{
          modelo.soy_aspirante=1;
       }   

   
   
   editor.setValue(JSON.stringify(modelo,undefined,2));
    //document.querySelector('.codemirror').CodeMirror.setValue(JSON.stringify(modelo,undefined,2));
    // var aaaa =  JSON.stringify(modelo,undefined,2);
   //$('#output').html(aaaa);
 }  
   
  function blanquearnewaspi()
{
  //$('#numasoc').val('');
  //$('#nombreasoc').val('');
  //$('#apellidoasoc').val('');
  $('#select_file').val('');
}

  //var cambioimagen = 0;
  
  $( document ).ready(function() {
  
    
    $('#fotoexistente').css('display','none');  
    $('#cvexistente').css('display','none');  
    $('#fotoexistente').attr('href','#');  
    $('#cvexistente').attr('href','#');      
    
    
      blanquearnewaspi();
    
    
    Cargar(16);
    
    
    $('#tipodoc').on('change', function() {
      $('#id_tipo_doc').val(this.value);
    })
    
    
     $('#select_file').on('change', function() {
      //alert(this.value);
       $('#upload_form').submit();
    })
  
    $('#upload_form').on('submit', function(event){
        event.preventDefault();
        var tipodoc = $('#tipodoc').val();
        if(tipodoc == 1){

                   $.ajax({
                   url:'{{ url("cliente/almacenarfilecv")}}',
                   method:"POST",
                   data:new FormData(this),
                   dataType:'JSON',
                   contentType: false,
                   cache: false,
                   processData: false,
                   headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },          
                   success:function(data)
                   {
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                    //$('#uploaded_image').html(data.uploaded_image);
                    $('#cvexistente').css('display', 'block');
                    $('#cvexistente').attr('href', data.uploaded_doc);
                     modelo.id_cv =  data.id_uploaded_doc;
                   }
                  });
        }
      else
        {
                    $.ajax({
                   url:'{{ url("cliente/almacenarfotoperfil")}}',
                   method:"POST",
                   data:new FormData(this),
                   dataType:'JSON',
                   contentType: false,
                   cache: false,
                   processData: false,
                   headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },          
                   success:function(data)
                   {
                    $('#message').css('display', 'block');
                    $('#message').html(data.message);
                    $('#message').addClass(data.class_name);
                   // $('#uploaded_image').html(data.uploaded_image);
                    $('#fotoexistente').css('display', 'block');
                    $('#fotoexistente').attr('href', data.uploaded_doc);                     
                    modelo.tipo_imagen =  data.tipo_imagen;
                    modelo.avatarBase64 =  data.uploaded_doc;
                   }
                  });           
        }


    }); 
  
  
    
    
      $(".juntadire_class").change(function(){
            juntadire_class_fn();
          visualizarparametros();
      });
    
      $(".juntavigi_class").change(function(){
          juntavigi_class_fn();
          visualizarparametros();
      });    
    
      $(".comite_credi_class").change(function(){
           comite_credi_class_fn();
          visualizarparametros();
      });   
    
     //localStorage.setItem("cambioimagen",cambioimagen);
     editor.setValue(JSON.stringify(modelo,undefined,2));
    

    if(modelo.junta_directores == 1){
      $("#juntadire").prop('checked', true);
    }
    if(modelo.junta_vigilancia == 1){
      $("#juntavigi").prop('checked', true);
    }    
     if(modelo.comite_credito == 1){
      $("#comite_credi").prop('checked', true);
    }   

    
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
  




