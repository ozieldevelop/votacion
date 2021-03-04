@extends('cliente::layouts.mater_invita_asamblea')


@section('content')

  <style>
  .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: #008d5e !important;
}
.btn-primary {
    background-color: #30419b;
    border: 1px solid #30419b;
}

table tr th input[type="checkbox"] !important{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1); /* IE */
  -moz-transform: scale(1); /* FF */
  -webkit-transform: scale(1); /* Safari and Chrome */
  -o-transform: scale(1); /* Opera */
 /* padding: 10px;*/
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
                  <p>Tema: <span><strong>{{ $nombreevento }}</strong></span></p>
               </div>
               <!--div class="col-md-12">
                  <p>Descripción: <span><strong>Descripcion</strong></span></p>
               </div-->
               <div class="col-md-12">
                  <p>Hora: <span><strong> {{ $f_inicia }} </strong></span></p>
               </div>
            </div>
           
           
          <div class="form-row">  

                           <ul class="list-group list-group-unbordered mb-3"  id="widget1">



                                   <li class="list-group-item">
                                        <b style="color:blue;font-size:18px">Nos gustar&iacute;a saber a que &oacute;rgano de gobierno te gustar&iacute;a ser aspirante  :</b> 
                                  </li>                         

 

                            </ul>            
            
            
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                      
<table class="table" style="width:100%">

  <tbody>
    <tr>
      <th scope="row" ><input type="checkbox"  id="juntadire" class="juntadire_class form-control"> </th>
      <td>Junta de Directores</td>
    </tr>
    <tr>
      <th scope="row" ><input type="checkbox"  id="juntavigi" class="juntavigi_class form-control"> </th>
      <td>Junta de Vigilancia</td>
    </tr>
    <tr>
      <th scope="row" ><input type="checkbox"  id="comite_credi" class="comite_credi_class form-control"> </th>
      <td>Comit&eacute; de Cr&eacute;dito</td>
    </tr>    
    </tbody>
</table>  
    
  


                      </div>  
          </div>           
           
           
           <div class="form-row">
             <div class="alert  col-md-12 col-sm-12" id="message" style="display: none"></div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="numero_asoc">Foto de perfil:</label>
                          
                                                   <form method="post" id="upload_form" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                     <input type="hidden" name="clasoc_id" id="clasoc_id" value="{{ $cldoc }}"/>
                                                    <input type="hidden" name="id_tipo_doc" id="id_tipo_doc" value="1"/>
                                                    <input type="file" name="select_file" id="select_file" />
                                                   </form>
                          
                                                   <br/><a href="#" id="fotoexistente"  target="_blank" style="display:none">Ver foto de perfil</a>                          
                        </div>
                        <div class="form-group col-md12 col-sm-12">
                            <label for="nombre_asoc">Hoja de vida:</label>

                          
                                                   <form method="post" id="upload_form2" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                     <input type="hidden" name="clasoc_id2" id="clasoc_id2" value="{{ $cldoc }}"/>
                                                     <input type="file" name="select_file2" id="select_file2" />
                                                   </form>
                          
                                                  <br/><a href="#" id="cvexistente"  target="_blank" style="display:none">Descargar hoja de vida existente</a>
                        </div>
                    </div>
                    <br>
                    <div class="form-row mb-2">
                        <div class="col-md-12 col-sm-12">
                            <label for="email">Datos profesionales relevantes :</label>
                                       <textarea class="form-control" id="memoria" style="resize:none" ></textarea>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="email">Experiencia cooperativista :</label>
                                       <textarea class="form-control" id="experiencia" style="resize:none" ></textarea>
                        </div>
                    </div>
           
           
            <hr>


            <a type="button" href="#" onclick="guardarasistencia()" class="btn btn-block btn-primary" style="background:#3c4199;color:white">ACTUALIZAR REGISTRO</a>
    
            <br/>

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

	  <script src="{{ asset('js/ckeditor.js') }}"></script>


			<script>
        
function Cargar(dato)
{
//alert(dato);
  
    $('#fotoexistente').css('display','none');  
    $('#cvexistente').css('display','none');  
    $('#fotoexistente').attr('href','#');  
    $('#cvexistente').attr('href','#');
    $('#numasoc').attr('disabled','disabled');  
  

	
		$.ajax({
			type: "GET",
			url: '{{ url("sistema/cargardatoaspirante")}}', 
			data: {"buscando": dato },
			success: function(datozval){
				    // var datoz = JSON.parse(result);
						// var id_delegado = datoz[0]['id_delegado'];	
					  // var nombre = datoz[0]['nombre'];	
					  // var apellido = datoz[0]['apellido'] ? datoz[0]['apellido'] : 'Pendiente';	
					  // var num_cliente =datoz[0]['num_cliente'];	
            var junta_directores =datozval[0]['junta_directores'];	
            var junta_vigilancia =datozval[0]['junta_vigilancia'];	
            var comite_credito =datozval[0]['comite_credito'];	
            modelo.memoria =datozval[0]['memoria'] ? datozval[0]['memoria'] : '...';
            modelo.experiencia =datozval[0]['experiencia'] ? datozval[0]['experiencia'] : '...';
						var foto = datozval[0]['foto'] ? datozval[0]['foto'] : '';
            var tipo = datozval[0]['tipo'] ? datozval[0]['tipo'] : '';	
            var id_cv = datozval[0]['adjunto'] ? datozval[0]['adjunto'] : ''; 
        
            CKEDITOR.instances['memoria'].setData(  modelo.memoria );
            CKEDITOR.instances['experiencia'].setData(  modelo.experiencia);            

            if(foto!='')
            {
              $('#fotoexistente').css('display', 'block');
              modelo.tipo_imagen =tipo;
              modelo.avatarBase64 =foto;     
              $('#fotoexistente').attr('href', "../../../adjuntos/"+foto); 
            }
            else
            {
              modelo.tipo_imagen ='';
              modelo.avatarBase64 ='';                 
            }
        
            if(id_cv!='')
            {
                $('#cvexistente').css('display', 'block');
                modelo.id_cv =id_cv;
                $.ajax({
                  type: "GET",
                  url: '{{ url("sistema/obteneradjunto")}}', 
                  data: {"id_cv": id_cv },
                  success: function(datoz){
                        //console.log(datoz);
                        $('#cvexistente').attr('href', '../../../adjuntos/'+datoz); 
                  }
                });
            }
            else{
                modelo.id_cv = "" ;
            }


        
          if(junta_directores == 1){
            modelo.junta_directores = junta_directores;
            $("#juntadire").prop('checked', true);
          }
          if(junta_vigilancia == 1){
            modelo.junta_vigilancia = junta_vigilancia;
            $("#juntavigi").prop('checked', true);
          }    
           if(comite_credito == 1){
            modelo.comite_credito = comite_credito;
            $("#comite_credi").prop('checked', true);
          }   
        

          terminar_espere();
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
        
											CKEDITOR.replace('experiencia', { 
													toolbar : [
														{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },


														'/',
														{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline' ] },
														{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },


													],
													on: {
														change: function( evt ) {
                           
															var dddd2 =  evt;
															//model.asuntoemail =$('#asuntoemail').val();
															//alert(dddd1.editor.name);
															if( dddd2.editor.name == 'experiencia')
															{
																modelo.experiencia =dddd2.editor.getData();
															}	
                          
														}
													}										
											});         
        
        
    </script>  


<script>

   	espere('Cargando');
  
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
     'id_delegado': '{{ $id_delegado }}',
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
    'nombre_asoc':'{{ $nombre }}',
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
    'memoria':'',
    'experiencia':''
  };
     

	function guardarasistencia()
	{

             Swal.fire({
                     title: 'Esta a punto de actualizar sus datos de su participación',
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
                              url: '{{ url("cliente/inscripcion/guardaasistenciaasamblea")}}',
                              data: { datos : JSON.stringify(modelo)  },
                              method: 'post',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              success: function(result){
                                lobibox_emergente('success','top right',true,'actualizado.');
                                setTimeout(function(){ location.reload();  }, 3000);
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
  
		//CKEDITOR.instances['memoria'].setData('')   ;
		//CKEDITOR.instances['experiencia'].setData('')   ;    
}

  //var cambioimagen = 0;
  function asignardatospantalla(){
         Cargar({{ $id_delegado }});
  }
  
$( document ).ready(function() 
{

      $('#fotoexistente').css('display','none');  
      $('#cvexistente').css('display','none');  
      $('#fotoexistente').attr('href','#');  
      $('#cvexistente').attr('href','#');      

      blanquearnewaspi();

 
    
    
      $('#tipodoc').on('change', function() {
        $('#id_tipo_doc').val(this.value);
      })

      $('#select_file').on('change', function() {
       $('#upload_form').submit();
      })
  
      $('#upload_form').on('submit', function(event){
        event.preventDefault();
      
                    $.ajax({
                   url:'{{ url("sistema/almacenarfotoperfil")}}',
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
                    $('#fotoexistente').attr('href', '../../adjuntos/'+ data.uploaded_doc);                     
                    modelo.tipo_imagen =  data.tipo_imagen;
                    modelo.avatarBase64 =  data.uploaded_doc;
                   }
                  }); 
    }); 

      $('#select_file2').on('change', function() {
      //alert(this.value);
       $('#upload_form2').submit();
    })
  
      $('#upload_form2').on('submit', function(event){
        event.preventDefault();

                   $.ajax({
                   url:'{{ url("sistema/almacenarfilecustom")}}',
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
                    $('#cvexistente').attr('href', '../../adjuntos/'+ data.uploaded_doc);
                     modelo.id_cv =  data.id_uploaded_doc;
                   }
                  });

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
    

    if({{$junta_directores}} == 1){
       modelo.junta_directores =1;
      $("#juntadire").prop('checked', true);
    }
    else
    {
      modelo.junta_directores =0;
    }
  
    if({{$junta_vigilancia}} == 1){
       modelo.junta_vigilancia = 1;
      $("#juntavigi").prop('checked', true);
    }   
    else
    {
        modelo.junta_vigilancia = 0;
    }
  
    if({{$comite_credito}} == 1){
       modelo.comite_credito = 1;
      $("#comite_credi").prop('checked', true);
    }   
    else
    {
        modelo.comite_credito = 0;
    }
  
  
    setTimeout(function(){ asignardatospantalla();  }, 2000);
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
  




