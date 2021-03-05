@extends('layouts.dashboard')

@section('content')


		<div class="row ">
      		<div class="col-md-12">
              <table class="table">
                <tr><td colspan="2" style="font-weight:bold;font-size:24px">Areas a la que pertenece</td></tr>
 							@foreach ($areaspostuladas as $dataareaspostuladas)
								<tr><td>{{ $dataareaspostuladas->nombreevento }}</td><td>{{ $dataareaspostuladas->area_etiqueta }}</td><td> <button type="button" class="btn btn-primary" onclick="delAspiranteCustom({{ $dataareaspostuladas->id_evento }} , {{ $dataareaspostuladas->tipo_evento }} ,{{ $dataareaspostuladas->num_cliente }} ,  {{ $dataareaspostuladas->id_area }})">
                  Quitar
                  </button>  </td></tr>
							@endforeach               
            </table>

			</div> 
		</div>

		<div class="row ">

      		<div class="col-md-4">	
						
				<div class="row ">
				   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
					<label for="inputevento" style="font-weight:bold;font-size:24px">Seleccione Evento</label>
					<select id="eventos" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="evaluaragregaaspitante()" >
							<option value=""> -- Elegir</option>
							@foreach ($eventos as $dataeventos)
								<option value="{{ $dataeventos->id }}">{{ $dataeventos->rangofecha1 }} | {{ $dataeventos->nombre }}</option>
							@endforeach
					</select>
				  </div> 
				</div>
				
			</div>
			<div class="col-md-4">	
				   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
					<label for="inputevento"  style="font-weight:bold;font-size:24px">Tipo</label>
						<select id="secciones" class="form-control col-sm-12 col-md-12 col-lg-12"  disabled>
							<option value=""> -- Pendiente por Selecci&oacute;n</option>
							@foreach ($tipos as $dataTipos)
								<option value="{{ $dataTipos->id_ae }}">{{ $dataTipos->etiqueta }}</option>
							@endforeach
						</select>
				  </div> 
			</div> 
			<div class="col-md-4">	
				   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
					<label for="inputevento"  style="font-weight:bold;font-size:24px">Areas</label>
						<select id="areas"   class="form-control col-sm-12 col-md-12 col-lg-12"  onchange="evaluarasignararea()" >
							<option value=""> -- Pendiente por Selecci&oacute;n</option>
						</select>
				  </div> 
			</div> 
		</div>


		
		<div class="row ">
      		<div class="col-md-12">
							<style>
						#lstaspirantes_wrapper{
						width:100%;
						}
						</style>
								
	
									<div class="row">
									

											<table id="lstaspirantes" class="display" cellspacing="0" style="width:100%">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>Apellido</th>
														<th>#Num</th>
                            <th>Estado</th>
														<th>Opci&oacute;n</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>


									</div>	
									
			</div>
			<div class="col-md-12" style="background-color:#c3c3c3">
	
				<div class="row DirectivosDir">
				</div>			
			</div>
	   </div>



	  
	  
@endsection
@section('page-script')

      <script src="{{ asset('datatable/1.10.22/') }}/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
      <script src="{{ asset('datatable/1.10.22/') }}/DataTables-1.10.22/js/dataTables.bootstrap4.min.js"></script>  
      <script src="{{ asset('datatable/1.10.22/') }}/Responsive-2.2.6/js/dataTables.responsive.min.js"></script> 
      <script src="{{ asset('datatable/1.10.22/') }}/Responsive-2.2.6/js/responsive.bootstrap4.min.js"></script> 

    
	
	  <link href="{{ asset('datatable/1.10.22/') }}/DataTables-1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">  
      <link href="{{ asset('datatable/1.10.22/') }}/DataTables-1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">  
      <link href="{{ asset('datatable/1.10.22/') }}/Responsive-2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">


  

  
	  
<script>
var aspiranteidBD = '';

    function adminAspirante(idbd){
			$('#outputimage').attr("src",'');
	
            aspiranteidBD = idbd;
            $('#myModal').modal('show');
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
												"width": "100%",
												"height": "100%" ,
												"id":"outputimage"
											});
											
											$("#output").empty();
											$("#output").append(image);
											$("#outputCode").empty();
											$("#outputCode").append(result);          
											$('#outputCode').css('visibility','visible');
										 
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

function saveImagen(){
      //console.log('accionterminal  '+idterminal+ '   '+statusactual);
      var imagenconten = $('#outputimage').attr('src');
      var imagencon = imagenconten.split('base64,');
	  console.log(imagencon[0]);
      var llimagen = imagencon[1];
	  var formato = imagencon[0];
     
							$.ajax({
								url: '{{ url("sistema/saveimage")}}',
								data: {"aspiranteidBD": aspiranteidBD, "llimagen": llimagen, "formato": formato},
								method: 'post',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
											Lobibox.notify('info', {
												msg: 'Guardado.'
											});		
											
										var secciones = $('#secciones').val();
						
										if(secciones=="1"){
											evaluaragregaaspitante();
										}
										else{
											evaluarasignararea();
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


function evaluarasignararea()
{
	console.log('evaluarasignararea');
	var eleccion = $('#eventos').val();
							 var id_area = $('#areas').val();
							 
								   $.ajax({
									url: '{{ url("sistema/dataeventosseleccionespecifica")}}'
									, data: { evento: eleccion , area: id_area}
									, method: 'GET'
									, success: function(result){
											  //var datoz = JSON.parse(result);
											  var datoz = result;
											  var html = '';
											  var elavatar = ''
											  for (var i = 0; i < datoz.length; i++)
											  {
													if( datoz[i]['foto'] === undefined || datoz[i]['foto'] === null ) {
														elavatar = "../../images/empty_gray.png";
													}
													else{
														//elavatar = datoz[i]['tipo']+"base64,"+datoz[i]['foto'];
                            elavatar = "../../../adjuntos/"+datoz[i]['foto'];
													}				
													html +='<div class="cuadritovotante col-sm-12 col-md-6" style="margin-top: 14px;"> <div class="card"><div class="card-header">'+ (datoz[i]["apellido"].substring(0, 10))+','+ (datoz[i]["nombre"].substring(0, 10)) +' <div class="card-actions"><a href="#" class="fa fa-window-close-o" onclick="delAspirante('+  datoz[i]['id_delegado'] +')"  style="color:black"><i class="icon-trash"></i></a></div></div><div class="card-body " id="collapseExample" style="text-align: center;"><img onclick="avatardisplayFn('+ datoz[i]['id_delegado'] +')"  class="img-fluid rounded-circle mx-auto d-block avatardisplay" id="img_'+ datoz[i]["id_delegado"] +'" style="background: #7e977e;width: 154px;height:155px;cursor:pointer" src="'+ elavatar +'" ><p style="text-align: center;">'+ datoz[i]['num_cliente'] +'</p></div></div></div>';
											  }
											  $('.DirectivosDir').html(html);    
									}
								  });
								  
}



function evaluaragregaaspitante()
{

	espere('Cargando');
	var eleccion = $('#eventos').val();
  
  if(eleccion=='')
    {
      terminar_espere();
      
$('.DirectivosDir').html(''); 


      return false;
    }
  else
    {
      
     
	$('#elfiltrodiv').css('display','block');
	$('#elfiltro').val('');
	$('.DirectivosDir').html('');
	
	
	
			$.ajax({
				url: '{{ url("sistema/cargardatoevento")}}'
				, data: { evento: eleccion }
				, method: 'GET'
				, success: function(result){
					
						$("#secciones").val(result[0]["tipo"]).change();
						 $("#areas").html('');
						 
						if(result[0]["tipo"]==1){
							console.log(result[0]["tipo"]+' Capitular');

							//-- Pendiente por Selecci&oacute;n
							$("#areas").append($('<option></option>').val('').html("Pendiente por Selecci&oacute;n"));
							$("#areas").append($('<option></option>').val(1).html("Area Unica"));
							$("#areas").val(1).change();
						 
							if(eleccion!="0"){
								   $.ajax({
									url: '{{ url("sistema/dataeventosseleccion")}}'
									, data: { evento: eleccion }
									, method: 'GET'
									, success: function(result){
											  //var datoz = JSON.parse(result);
											  var datoz = result;
											  var html = '';
											  var elavatar = ''
											  for (var i = 0; i < datoz.length; i++)
											  {
													if( datoz[i]['foto'] === undefined || datoz[i]['foto'] === null ) {
														elavatar = "../../images/empty_gray.png";
													}
													else{
														//elavatar = datoz[i]['tipo']+"base64,"+datoz[i]['foto'];
                            elavatar ="../../../adjuntos/"+datoz[i]['foto'];
													}				
													html +='<div class="cuadritovotante col-sm-12 col-md-6" style="margin-top: 14px;"> <div class="card"><div class="card-header">'+  (datoz[i]["apellido"].substring(0, 10))+','+ (datoz[i]["nombre"].substring(0, 10))  +' <div class="card-actions"> &nbsp;<a href="#" class="btn-setting" onclick="delAspirante('+  datoz[i]['id_delegado'] +')"  style="color:black"><i class="icon-close icons"></i></a></div></div><div class="card-body " id="collapseExample" style="text-align: center;"><img onclick="avatardisplayFn('+ datoz[i]['id_delegado'] +')"  class="img-fluid rounded-circle mx-auto d-block avatardisplay" id="img_'+ datoz[i]["id_delegado"] +'" style="background: #7e977e;width: 154px;height:155px;cursor:pointer" src="'+ elavatar +'" ><p style="text-align: center;">'+ datoz[i]['num_cliente'] +'</p></div></div></div>';
											  }
											  $('.DirectivosDir').html(html);    
									}
								  });
								  terminar_espere();
						  }
						  else{
								$('#elfiltrodiv').css('display','none');
						  }

								  terminar_espere();
		  
						}
						else{
							 
							 console.log(result[0]["tipo"]+' Asamblea');
	
								  
							 //-- Pendiente por Selecci&oacute;n
							 $("#areas").append($('<option></option>').val('').html("Pendiente por Selecci&oacute;n"));
							 $("#areas").append($('<option></option>').val(2).html("Junta de Directores"));		
							 $("#areas").append($('<option></option>').val(3).html("Junta de Vigilancia"));
							 $("#areas").append($('<option></option>').val(4).html("Comite de Credito"));
							 $("#areas").val('').change();	
							 terminar_espere();
						}
 
				}
			  });	
			  
  }

	
		  
  }
  

  
function cargarlistado(valor)
{
			  //console.log(valor);
			  if(valor==1)
			  {
				$("#lstaspirantes").dataTable().fnDestroy();
			  }
			  var t = $('#lstaspirantes').DataTable({

				processing: true,
				//serverSide: true,
				stateSave: false,
				oLanguage: {
				  sSearch: "Busqueda: ",
				  sProcessing: "Espera, estamos buscando más información en el servidor",
				  sLengthMenu: "Mostrar _MENU_ registros por página",
				  sZeroRecords: "Aun no hay parametros ingresados",
				  sInfo: "Mostrando de _START_ a _END_ de _TOTAL_ registros",
				  sInfoEmpty: "Mostrando 0 a 0 de 0 registros",
				  oPaginate: {
					sPrevious:"Anterior",
					sNext:"Siguiente",
				  },
				  sInfoFiltered: "(Filtrados de _MAX_ total registros)",
				},
				order: [0,'asc'],
				columnDefs: [ {

				targets: [ 3], // column or columns numbers

				orderable: false,  // set orderable for selected columns

				}],			
				  responsive: {
            details: {
            display: $.fn.dataTable.Responsive.display.modal( {
              header: function ( row ) {
              var data = row.data();
              return 'Details for '+data[0]+' '+data[1];
              }
            } ),
            renderer: $.fn.dataTable.Responsive.renderer.tableAll()
            }
          },
          "columns": [
            { "width": "60%", "orderable": "true"  },
            { "width": "10%", "orderable": "true"  },
            { "width": "10%", "orderable": "true"  },
            { "width": "10%", "orderable": "false"  },
            { "width": "10%", "orderable": "false" }
          ],				
          ajax: {
                url: '{{ url("sistema/cargaraspi")}}',
                data: function (d) 
                {
                  d.id_delegado = {{ $id_delegado}};
                }
          },
				  columns: [
				   { data: 'nombre', name: 'nombre' , class: 'text-center'},				   
				   { data: 'apellido', name: 'apellido' , class: 'text-center'},
				   { data: 'num_cliente', name: 'num_cliente', class: 'text-center' },
           { data: 'gestion_estado', name: 'gestion_estado', orderable: true, searchable: false, class: 'text-center'},
				   { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'}					   
				 ]
                                              
			  });
  
  }
  
function CambiarEstado(id_delegado,valor)
{	 
          //alert(dato+'-'+valor);

							$.ajax({
								 url: '{{ url("sistema/actualizarestadoaspirante")}}', 
								data: {id_delegado: id_delegado,valor: valor  },
								method: 'post',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
											//cargarlistado(1);			
                        setTimeout(function(){ location.reload();  }, 1000);	
								},
								error: function (r) {
									console.log("ERROR");
								}
							});
  
  //evaluarasignararea();
}
  
  
  
function Cargar(dato)
{	
	var eleccion = $('#eventos').val();
	if(eleccion==""){
		lobibox_emergente('info','top right',true,'Debe seleccionar un evento');
		return false;
	}
 	var id_area = $('#areas').val();
	if(id_area==""){
		lobibox_emergente('info','top right',true,'Debe seleccionar un area');
		return false;
	}	
			
 	$.ajax({
		type: "get",
		url: '{{ url("sistema/cargardatoaspirante")}}', 
		data: {"buscando": dato },
		success: function(resultado)
    { 
      

       var id_delegado = resultado[0]['id_delegado'];	

            $.ajax({
            type: "get",
            url: '{{ url("sistema/consultaraspiranteenevento")}}', 
            data: { "id_delegado":id_delegado  ,"id_evento": eleccion,"id_area": id_area},
            success: function(cantidad)
            { 

              
              if(cantidad<=0){
                
                   $.ajax({
                    url: '{{ url("sistema/agregaraspiranteevento")}}',
                    data: { "id_delegado":id_delegado  ,"id_evento": eleccion,"id_area": id_area},
                    method: 'post',
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result){

                        var secciones = $('#secciones').val();

                        if(secciones=="1"){
                          evaluaragregaaspitante();
                        }
                        else{
                          evaluarasignararea();
                        }

                    },
                    error: function (r) {
                      console.log("ERROR");
                      console.log(r);

                    }
                  });
                
              }
              else{
                	lobibox_emergente('warning','top right',true,'Ya existe en esta configuración!');	
              }

            }
          });              
		},
		error: function (r) {
			console.log("ERROR");
			console.log(r);
		}
	});
    

}  

  function delAspiranteCustom(id_evento,tipo_evento,num_cliente,id_area)
{
	
	
alert(id_evento+ ' - '+tipo_evento+ ' - '+num_cliente+ ' - '+id_area);
/*
		Lobibox.confirm({
                    msg: "Desea eleminar este aspirante ?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
							
							$.ajax({
								url: '{{ url("sistema/eliminaraspiranteevento")}}',
								data: {  'id_evento': id_evento ,'id_delegado': idbd,"id_area": id_area },
								method: 'post',
								headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
										var secciones = $('#secciones').val();
										if(secciones=="1"){
											evaluaragregaaspitante();
										}
										else{
											evaluarasignararea();
										}
								},
								error: function (r) {
									console.log("ERROR");
									console.log(r);
								}
							});
							
										  
                        } else if (type === 'no') {
									
                        }
                    }
                });
                
                */
			
}

function delAspirante(idbd)
{
	
	
		var eleccion = $('#eventos').val();	
		var id_area = $('#areas').val();

		Lobibox.confirm({
                    msg: "Desea eleminar este aspirante ?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
							
							$.ajax({
								url: '{{ url("sistema/eliminaraspiranteevento")}}',
								data: {  'id_evento': eleccion ,'id_delegado': idbd,"id_area": id_area },
								method: 'post',
								headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
										var secciones = $('#secciones').val();
										if(secciones=="1"){
											evaluaragregaaspitante();
										}
										else{
											evaluarasignararea();
										}
								},
								error: function (r) {
									console.log("ERROR");
									console.log(r);
								}
							});
							
										  
                        } else if (type === 'no') {
									
                        }
                    }
                });
			
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


        encodeImageFileAsURL(ftype);
    }
    else {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!!");
        return false;
    }
}
  var id_delegado_request= {{ $id_delegado}};
  
$(document).ready(function () {
    //alert({{ $id_delegado}});
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

	cargarlistado(1);	
	 

});


</script>

@stop
