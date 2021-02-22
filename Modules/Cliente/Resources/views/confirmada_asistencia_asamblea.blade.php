@extends('cliente::layouts.master')


@section('content')

<div class="row">

</div>

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">


                          <div class="card card-widget widget-user shadow-lg">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header text-white"
                                 style="background: url('../../images/333f41_newlogo2.png') center center;">

                            </div>
                            <div class="widget-user-image" id="outputimg-circle">

                              <img class="img-circle" src="{{ $foto }}" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                              <div class="row">

                                <!-- /.col -->
                                <div class="col-sm-12">
                                  <div class="description-block">
                                    <h5 class="description-header">Opci&oacute;n para actualizar tu foto de perfil - (Para los que se deseen postular)</h5>
                                    <a type="button" href="#" onclick="abrirmodal();"><span class="description-text">CAMBIAR IMAGEN </span></a>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          </div>

                
                
        <div class="col-sm-12 col-md-12 col-lg-12">
	   
	              {!! $mensaje !!}

	      </div>
         
                <h3 class="profile-username text-center">{{ $nombreevento }}</h3>

                <p class="text-center"> </p> <p class="text-muted text-center">DIA DEL EVENTO {{ $f_inicia }}</p>

                
                <ul class="list-group list-group-unbordered mb-3"  id="widget1">


                  
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
                  
 

                    @if($tipoevent==2)
                        <li class="list-group-item">
                          <b>Nos gustar&iacute;a saber si deseas ser parte de alguno de estos grupos :</b>
                        </li>
                    @endif                  

                  
                  
                 
                  <li class="list-group-item">
                    <b style="color:blue">Junta de directores</b> <label   class="float-right"><input type="checkbox"  id="juntadire" class="juntadire_class"> </label>
                  </li>  
                  <li class="list-group-item">
                    <b style="color:blue">Junta de vigilancia</b> <label   class="float-right"><input type="checkbox"  id="juntavigi" class="juntavigi_class">  </label>
                  </li>     
                  <li class="list-group-item">
                    <b style="color:blue">Comit&eacute; de cr&eacute;dito</b> <label   class="float-right"><input type="checkbox"  id="comite_credi" class="comite_credi_class">  </label>
                  </li>   

                </ul>
                
                <!-- debe haber confirmado su cuenta de correo para zoom almenos -->

               
     
            
                <a type="button" href="#" onclick="guardarasistencia()" class="btn btn-block btn-success" >ACTUALIZA Y CONFIRMA TU ASISTENCIA AQUI</a>
               
                
                 @if($existecuentazoom==1 && $periactico)
                 <a type="button" href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block btn-warning" >INGRESAR EN PANEL</a>
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


  <div class="modal" id="myModal">
    <div class="modal-dialog modal-xs">
      <div class="modal-content ">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Actualizar Ficha</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
                      <div align="center" style="color:red">
					 procure que la imagen posea las siguientes dimensiones 121x141 px
                <form onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm">
                    <input name="image_file" id="imageInput" type="file" />
                    <input type="submit"  id="submit-btn" class="btn btn-secondary" value="1:Confirmar" />
                    <img src="../../assets/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                </form>
                <div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
                <div id="output" ></div>
                <textarea id="outputCode" style="display:none;"></textarea>
            </div>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer" style="display:none">
                  <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="saveImagen()">2: Guardar Cambios</button>
        </div>
  
      </div>
    </div>
  </div>





@endsection

  
@section('page-script')

<link rel="stylesheet" href="../dist/css/adminlte.min.css">


<script>

  
 
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
    'cambioimagen' : 0
  };
     

	function guardarasistencia()
	{
///   
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


                            $.ajax({
                              url: '{{ url("cliente/inscripcion/guardaasistencia")}}',
                              data: { datos : JSON.stringify(modelo)  },
                              method: 'get',
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
                                      setTimeout(function(){ location.reload();  }, 2000);
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
    else
      {
        lobibox_emergente('warning','top center',true,'Verifique que las cuendas de email escritas sean iguales.');
        
      }
}
  
  
  
  
  
function asistire_class_fn()
{
          var elf = document.getElementById('laasisobjeto').checked;
        
              if(elf)
              {
                          modelo.asistire = 1;
                          modelo.f_asistire_regis=formatDate();
              }
              else {
                          modelo.asistire = 0;
                          modelo.f_asistire_regis='';
              }
  }
  
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
  
  
  
    function abrirmodal(){
			      //$('#outputimage').attr("src",'');
	
            //aspiranteidBD = idbd;
            $('#myModal').modal('show');
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

  
  
  
  
function upload(base64Image,ftype){

							$.ajax({
								url: '{{ url("sistema/lookimage")}}',
								data: {"img": base64Image, "ex": ftype},
								method: 'post',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
										if(result){
											var image = $("<img>", {
												"src": result,
												"width": "100px",
												"height": "100px" ,
												"id":"outputimage"
											});
											
											$("#output").empty();
											$("#output").append(image);
                      $("#outputimg-circle").html('');
                      
                      $("#outputimg-circle").append(image);
											$("#outputCode").empty();
											$("#outputCode").append(result);          
											$('#outputCode').css('visibility','visible');
                      $("#outputimage").attr('class','img-circle');
										 
										}else{
											$("#output").empty();
											$("#output").html("Error to insert database!!");
										}
								},
								error: function (r) {
									console.log("ERROR");
									console.log(r);
									
									$("#output").empty();
									$("#output").html("Error to upload image!!");
			
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
  
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Byte';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
  
  function beforeSubmit() {

    $('#output').html("<b class='text-center'><img src='../../assets/images/ajax-loader.gif' alt=''  id='outputimage' /> In progress...</b>");


    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        if (!$('#imageInput').val()) //check empty input filed
        {
            $("#output").html("Select image !!!!!!");
            return false
        }

        var fsize = $('#imageInput')[0].files[0].size; //get file size
        var ftype = $('#imageInput')[0].files[0].type; // get file type

        //allow only valid image file types
        switch (ftype) {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
            break;
            default:
                $("#output").html("<b>" + ftype + "</b>  Unsupported file type!!");
                return false
        }

        //Allowed file size is less than 1 MB (1048576)
        if (fsize > 1048576) {
            $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
            return false
        }

          $("#output").html("<b>IMAGEN ACEPTADA</b>");
          $('#myModal').modal('hide');
          //localStorage.setItem("cambioimagen",1);
          modelo.cambioimagen = 1;
          visualizarparametros();
          encodeImageFileAsURL(ftype);
      
											Lobibox.notify('info', {
												msg: 'Recuerda presionar el boton de actualizar en la parte inferior de la página.'
											});	      
    }
    else {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!!");
        return false;
    }
}
  
 function visualizarparametros()
 {
    @if($tipoevent==1)

       if(modelo.cantidato_delegado == 0  )
       {
          modelo.soy_aspirante=0;
       }
       else{
          modelo.soy_aspirante=1;
       }
    @else

       if(modelo.junta_directores == 0 && modelo.junta_vigilancia == 0 && modelo.comite_credito == 0 )
       {
          modelo.soy_aspirante=0;
       }
       else{
          modelo.soy_aspirante=1;
       }   
    @endif
   
   
   
   editor.setValue(JSON.stringify(modelo,undefined,2));
    //document.querySelector('.codemirror').CodeMirror.setValue(JSON.stringify(modelo,undefined,2));
    // var aaaa =  JSON.stringify(modelo,undefined,2);
   //$('#output').html(aaaa);
 }  
  
  
  //var cambioimagen = 0;
  
  $( document ).ready(function() {
  
    
   //var terminal = localStorage.getItem("cambioimagen");
       
    
    
     $("#submit-btn").click(function () {
       
        beforeSubmit();
    });
    $("#outputCode").focus(function() {
        // Select all on focus; 
        // Source:  https://stackoverflow.com/questions/5797539/jquery-select-all-text-from-a-textarea
        var $this = $(this);
        $this.select();
        // Work around Chrome's little problem
        $this.mouseup(function() {
            // Prevent further mouseup intervention
            $this.unbind("mouseup");
            return false;
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
  




