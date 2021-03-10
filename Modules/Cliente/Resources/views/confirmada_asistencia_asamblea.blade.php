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
<div id="register_form"  >
   <div class="text-center" >
      <div style="row">
       <img src="http://portal.cooprofesionales.com.pa/mercadeo/files/00fc06_newlogo_oficial.png" style="width: 360px;">
      </div>

      <div>
         <h4>Inscripci&oacute;n de Candidatos a Puestos Directivos</h4>
      </div>
   </div>
   <hr>
   <div class="form-row" style="display:none">
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
   <div class="form-row" id="widget1">
      <div class="col-md-6 col-sm-12">
         <label for="numero_asoc">Número de Cliente:</label>
         <input type="text" class="form-control" placeholder="Escriba su n&uacute;mero de cliente"  id="num_cliente" data-bindto="parametros.num_cliente"    value="" >
      </div>
      <div class="col-md-6 col-sm-12">
         <label for="nombre_asoc">Nombre:</label>
         <input type="text" class="form-control" placeholder="Escriba nombre de cliente"   id="nombre_asoc" data-bindto="parametros.nombre_asoc"  value="" >
      </div>
   </div>
   <div class="form-row">
      <ul class="list-group list-group-unbordered " >
         <li class="list-group-item">
            <b style="color:blue;font-size:18px">Los puestos directivos a elecci&oacute;n son:</b> 
         </li>
      </ul>
      <div class="form-group col-sm-12 col-md-12 col-lg-12">
         <table class="table" style="width:100%">
            <tbody>
               <tr>
                  <th scope="row" ><input type="checkbox"  id="juntadire" class="juntadire_class form-control"> </th>
                  <td>5- Junta de Directores</td>
               </tr>
               <tr>
                  <th scope="row" ><input type="checkbox"  id="juntavigi" class="juntavigi_class form-control"> </th>
                  <td>2- Junta de Vigilancia</td>
               </tr>
               <tr>
                  <th scope="row" ><input type="checkbox"  id="comite_credi" class="comite_credi_class form-control"> </th>
                  <td>2- Comit&eacute; de Cr&eacute;dito</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
   <div class="form-row">
      <div class="alert  col-md-12 col-sm-12" id="message" style="display: none"></div>
      <div class="form-group col-md-12 col-sm-12">
         <label for="numero_asoc"  style="color:blue;font-size:18px">Adjunte foto:</label><label style="color:red"> (Campo obligatorio) </label> <label style="color:#c3c3c3"> Colocar foto tipo carnet </label><!--que ser&aacute; utilizada para la votaci&oacute;n -->
         <!--label for=""  style="color:#c3c3c3;font-size:10px"><br/></br/>&eacute;sta ser&aacute; utilizada para la votaci&oacute;n:</label-->
         <form method="post" id="upload_form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="clasoc_id" id="clasoc_id" value="" />
            <input type="hidden" name="id_tipo_doc" id="id_tipo_doc" value="1"/>
            <input type="file" name="select_file" id="select_file" />
         </form>
         <br/><a href="#" id="fotoexistente"  target="_blank" style="display:none">Ver foto de perfil</a>                          
      </div>
      <div class="form-group col-md12 col-sm-12">
         <label for="nombre_asoc"  style="color:blue;font-size:18px">Adjunte copia de c&eacute;dula: </label><label style="color:red"> (Campo obligatorio) </label>
         <form method="post" id="upload_form2" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="clasoc_id2" id="clasoc_id2" value=""/>
            <input type="file" name="select_file2" id="select_file2" />
         </form>
         <br/>
         <a href="#" id="cvexistente"  target="_blank" style="display:none">Ver copia de c&eacute;dula</a>
        <label style="color:#ca6f4b">Art&iacute;culolo 3.46 del Estatuto: No podr&aacute; ocupar cargos directivos los asociados que tengan entre s&iacute; parentesco por afinidad hasta el 2&#176; grado de consanguinidad hasta el 4&#176; grado.</label>
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
   <a type="button" href="#" onclick="guardarasistencia()" class="btn btn-block btn-primary" style="background:#3c4199;color:white"> REGISTRAR </a>
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
               var junta_directores =datozval[0]['junta_directores'];	
               var junta_vigilancia =datozval[0]['junta_vigilancia'];	
               var comite_credito =datozval[0]['comite_credito'];	
               modelo.memoria =datozval[0]['memoria'] ? datozval[0]['memoria'] : '';
               modelo.experiencia =datozval[0]['experiencia'] ? datozval[0]['experiencia'] : '';
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
   		toolbar : [],
   		on: {
   					change: function( evt ) {
   					var dddd1 =  evt;
   					if( dddd1.editor.name == 'memoria')
   						{
                modelo.memoria =dddd1.editor.getData();
   						}	
           }
   				}										
   	});  
           
    
   CKEDITOR.replace('experiencia', { 
   		toolbar : [],
   		on: {
   					change: function( evt ) {
   					var dddd2 =  evt;
   					if( dddd2.editor.name == 'experiencia')
   						{
                modelo.experiencia =dddd2.editor.getData();
   						}	
           }
   				}										
   	});           
           
       
</script>  
<script>
   //espere('Cargando');
   
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
   'id_evento':'{{ $id_evento }}',
   'tipoevent':'{{ $tipoevent }}',
   'nombre_evento':'{{ $nombreevento }}',
   'f_inicia':'{{ $f_inicia }}',
   'f_termina':'{{ $f_termina }}',
   'asistire': 1,
   'f_asistire_regis':moment().format('YYYY-MM-DD HH:mm:ss'),
   'junta_directores':'',
   'junta_vigilancia':'',
   'comite_credito': '',
   'num_cliente':'',
   'nombre_asoc':'',
   'cambioimagen' : 0,
   'id_cv':'',
   'tipo_imagen':'',
    'avatarBase64':'',
   'memoria':'',
   'experiencia':''
   };
    
   
   function guardarasistencia()
   {
     
            var val_num_cliente = $('#num_cliente').val();
            var val_nombre_asoc = $('#nombre_asoc').val();

     
     
					  if(val_num_cliente=="" || val_num_cliente==undefined || val_num_cliente.length < 0)
					  {
              lobibox_emergente('info','top right',true,'# de asociado es requerido.');	 
              return false;
					  }
     
					  if(val_nombre_asoc=="" || val_nombre_asoc==undefined || val_nombre_asoc.length < 0)
					  {
              lobibox_emergente('info','top right',true,'nombre de asociado es requerido.');	 
              return false;
					  }
     
					  if(modelo.avatarBase64 =="" || modelo.avatarBase64==undefined || modelo.avatarBase64.length < 0)
					  {
              lobibox_emergente('info','top right',true,'imagen de perfil es requerido.');	 
              return false;
					  }
     
					  if(modelo.id_cv=="" || modelo.id_cv==undefined || modelo.id_cv.length < 0)
					  {
              lobibox_emergente('info','top right',true,'copia de cédula es requerido.');	 
              return false;
					  }
     
            if(modelo.junta_directores==0 && modelo.junta_vigilancia==0 && modelo.comite_credito ==0)
					  {
              lobibox_emergente('info','top right',true,'debe seleccionar algún puesto.');	 
              return false;
					  }
     
     
            // consultar si el numero de asociado ya guardo su informacion
    
            $.ajax({
              url: '{{ url("sistema/getaspiranteenevento")}}',
              data: { 'num_cliente' : val_num_cliente ,'id_evento' : {{ $id_evento }}  },
              method: 'get',
              success: function(result)
              {
                //alert(result);
                   if(result =="" || result==undefined || result.length < 0)
                    {
                            Swal.fire({
                                    title: 'Confirma el registro!',
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
                                               lobibox_emergente('success','top right',true,'Registro  agregado satisfactoriamente! ');
                                               setTimeout(function(){ window.location.href = '{{ url("votacion/satisfactorio")}}' ; }, 1000);
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
                       setTimeout(function(){ window.location.href = '{{ url("votacion/existente")}}' ; }, 1000);
                    }
   
              },
              error: function (r) {
                  //lobibox_emergente('success','top right',true,'de seguro error.');
                  console.log("ERROR");
                  console.log(r);
              }
            });     
     


   }

   function comite_credi_class_fn()
   {
         var elf = document.getElementById('comite_credi').checked;
         if(elf)
         {
                         modelo.comite_credito = 1;
         }
         else
         {
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
   
   
   $( document ).ready(function() 
   {
       $('#fotoexistente').css('display','none');  
       $('#cvexistente').css('display','none');  
       $('#fotoexistente').attr('href','#');  
       $('#cvexistente').attr('href','#');    
     
     $( "#juntadire" ).prop( "checked", false );
     $( "#juntavigi" ).prop( "checked", false );
     $( "#comite_credi " ).prop( "checked", false );
     
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
   
     editor.setValue(JSON.stringify(modelo,undefined,2));
  
});     // FIN DEL DOCUMENT READY
   
   
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

