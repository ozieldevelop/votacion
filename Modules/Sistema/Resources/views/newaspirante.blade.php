@extends('layouts.dashboard')

@section('content')


<div class="row ">
     <div class="col-md-3">
		


			  <div class="form-group col-sm-12 col-md-12 col-lg-12" style="display:none" id="areaimagen" >
				         <div class="widget-user-image" id="outputimg-circle"><img onclick="abrirmodal();" class="img-circle" src="" alt="User Avatar"></div>
			  </div>
       
 			   <div class="form-group col-sm-12 col-md-12 col-lg-12">

				  <button type="text" class="btn btn-success form-control" onclick="vaciarformulario()">Vaciar Formulario</button>
			  </div>
       

 			   <div class="form-group col-sm-12 col-md-12 col-lg-12" id="verparticipaciones" style="display:none">

				  <button type="text" id="verparticipacionesobjetoclick"  class="btn btn-success form-control" onclick="verparticipacionesfncion()">Junta o Comit&eacute;s </button>
           
			  </div>       
       

  
  
  
			   <input type="hidden" class="form-control" id="id_delegado" >
			   <div class="form-group col-sm-12 col-md-12 col-lg-12">
				<label for="inputnumasociado">N&uacute;mero de Asociado</label>
				<input type="text" class="form-control" id="numasoc"  placeholder="Ingrese el N&uacute;mero de Asociado">
			  </div>

				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				<label for="inputnombreasoc">Nombre</label>
				<input type="text" class="form-control" id="nombreasoc"  placeholder="Ingrese el Nombre del Asociado">
			  </div>
			  
				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				<label for="inputapellidoasoc">Apellido</label>
				<input type="text" class="form-control" id="apellidoasoc"  placeholder="Ingrese el Apellido del Asociado">
			  </div>
       


				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				<label for="inputapellidoasoc">Seleccionar tipo de documento a subir</label>
            <select id="tipodoc" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="console.log(this.value)" >
                      <option value="1"> Hoja de Vida </option>
                      <option value="2"> Foto de perfil </option>
            </select>

			  </div>       
       
 			   <div class="form-group col-sm-12 col-md-12 col-lg-12">
           <div class="alert" id="message" style="display: none"></div>
           <form method="post" id="upload_form" enctype="multipart/form-data">
            {{ csrf_field() }}
             <input type="hidden" name="clasoc_id" id="clasoc_id" value=""/>
            <input type="hidden" name="id_tipo_doc" id="id_tipo_doc" value="1"/>
            <input type="file" name="select_file" id="select_file" />
           </form>

 

			  </div>
       
     	 <div class="form-group col-sm-12 col-md-12 col-lg-12">
				<label for="inputapellidoasoc">Documentos Adjuntados</label>
				  <br/><a href="#" id="fotoexistente"  target="_blank" style="display:none">Ver foto de perfil</a>
          <br/><a href="#" id="cvexistente"  target="_blank" style="display:none">Descargar hoja de vida existente</a>
			  </div>   
       
       
       
				<div class="form-group col-sm-12 col-md-12 col-lg-12">
				<label for="inputapellidoasoc">Memorias</label>
          <textarea class="form-control" id="memoria" style="resize:none" ></textarea>
			  </div>
       

 

       
			 <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
							
										<button type="text" id="btnagregar" class="btn btn-secondary form-control" onclick="agregarNuevo()">AGREGAR</button>
										<button type="text" id="btnactualizar" class="btn btn-info form-control" onclick="actualizar()" style="display:none">ACTUALIZAR</button>
			  </div>
	  
			  
	</div>
	<div class="col-md-9">
					<style>
                #lstaspirantes_wrapper{
                    width:100%;
                }
						</style>
									<div class="row">
									

											<table id="lstaspirantes" class="display stripe" cellspacing="0" style="width:100%">
												<thead>
													<tr>
														<th>Nro Cliente</th>                            
														<th>Nombre</th>
														<th>Apellido</th>
														<th>Opci&oacute;n</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>

									</div>	   
	</div>
</div>

	  
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content ">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Listado</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">

          
       
          
          
          
        </div>

  
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
	  <script src="{{ asset('js/ckeditor.js') }}"></script>

			<script>
									
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
																model.memoria =dddd1.editor.getData();
															}	
                          
														}
													}										
											});  
        
    </script>        
<script>
  var model = {
      memoria : '',
      id_cv:'',
      tipo_imagen:'',
      avatarBase64:''
  };
  //JSON.stringify(model)
 
function verparticipacionesfncion(id_aspirante)
{
      setTimeout(function(){ window.location.href = '{{ url("sistema/newaspirantesuseventos")}}/?id_aspirante='+id_aspirante ; }, 1000);
}
  
  
function vaciarformulario()
{
                  localStorage.setItem("aspirante_selecionado",'');
								  setTimeout(function(){ location.reload();  }, 1000);	
}

function agregarNuevo()
{
	var numasoc = $('#numasoc').val();
	var nombreasoc = $('#nombreasoc').val();
	var apellidoasoc = $('#apellidoasoc').val();

	  if(numasoc=="" || numasoc==undefined || numasoc.length < 0)
	  {

					 lobibox_emergente('info','top right',true,'Deben ingresar un n&uacute;mero de asociado.');
					 
					 
		return false;
	  }
	  else if(nombreasoc=="" || nombreasoc==undefined || nombreasoc.length < 0)
	  {
		lobibox_emergente('info','top right',true,'Deben ingresar un nombre.');

		return false; 
	  }
	  else if(apellidoasoc=="" || apellidoasoc==undefined || apellidoasoc.length < 0)
	  {
		lobibox_emergente('info','top right',true,'Debe ingresar un apellido.');
		
		return false; 
	  }  
	  else{
          $.ajax({
            type: "get",
            url: '{{ url("sistema/consultaaspirante")}}', 
            data: {"num_cliente": numasoc },
            success: function(resultado)
            { 
              console.log/(resultado);
              return false;
                  $.ajax({
                    url: '{{ url("sistema/agregarnuevo")}}',
                    data: {"numasoc": numasoc , "nombreasoc": nombreasoc , "apellidoasoc": apellidoasoc ,'otrosobjetos':JSON.stringify(model)},
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result){
                      lobibox_emergente('success','top right',true,'Agregado.');
                      //console.log('agregarNuevo');
                      setTimeout(function(){ location.reload();  }, 2000);
                    },
                    error: function (r) {
                        console.log("ERROR");
                        console.log(r);
                    }
                  });
 						}
			  });     
	  }
}

function mostrarmodalaspirantes()
{
  $('#myModal').show();
}
  
  
function actualizar()
{

  	Lobibox.confirm({
        msg: "Desea actualizar este aspirante ?",
        callback: function ($this, type) {
            if (type === 'yes') {

					var id_delegado = $('#id_delegado').val();
					var numasoc = $('#numasoc').val();
					var nombreasoc = $('#nombreasoc').val();
					var apellidoasoc = $('#apellidoasoc').val();

					  if(id_delegado=="" || id_delegado==undefined || id_delegado.length < 0)
					  {
						lobibox_emergente('info','top right',true,'Verificar selecci&oacute;n.');	 
						return false;
					  }
					  
					  if(numasoc=="" || numasoc==undefined || numasoc.length < 0)
					  {

						lobibox_emergente('info','top right',true,'Deben ingresar un n&uacute;mero de asociado.');		 
						return false;
					  }
					  else if(nombreasoc=="" || nombreasoc==undefined || nombreasoc.length < 0)
					  {
						lobibox_emergente('info','top right',true,'Deben ingresar un nombre.');

						return false; 
					  }
					  else if(apellidoasoc=="" || apellidoasoc==undefined || apellidoasoc.length < 0)
					  {
						lobibox_emergente('info','top right',true,'Debe ingresar un apellido.');
						
						return false; 
					  }  
					  else{
						
						  

								
							$.ajax({
								url: '{{ url("sistema/actualizaraspirante")}}',
								data: {"id_delegado": id_delegado,"numasoc": numasoc , "nombreasoc": nombreasoc , "apellidoasoc": apellidoasoc,"otrosobjetos": JSON.stringify(model)  },
								method: 'post',
								headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
										lobibox_emergente('success','top right',true,'Actualizado.');
										console.log('actualizar');
										//setTimeout(function(){ location.reload();  }, 2000); 
								},
								error: function (r) {
										console.log("ERROR");
										console.log(r);
								}
							});
							
							
					  }
						
            } else if (type === 'no') {
									
            }
        }
    });
				
		
}


function cargarlistado(valor)
{

			  if(valor==1)
			  {
				$("#lstaspirantes").dataTable().fnDestroy();
			  }
			  var t = $('#lstaspirantes').DataTable({
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
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
				order: [2,'asc'],
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
				  { "width": "10%" },          
				  { "width": "70%" },
				  { "width": "10%" },
				  { "width": "10%", "orderable": "false" }
				],				
				ajax: '{{ url("sistema/cargaraspirantes")}}',
				  columns: [
						{ data: 'num_cliente', name: 'num_cliente', class: 'text-center' },            
				 		{ data: 'nombre', name: 'nombre' , class: 'text-center'},				   
						{ data: 'apellido', name: 'apellido' , class: 'text-center'},
						{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'}				   
				 ]
			  });

	//console.log('cargarlistado');
}
  
  
function Cargar(dato)
{
    //verparticipacionesfncion(dato)
    $('#verparticipacionesobjetoclick').attr('onclick','verparticipacionesfncion('+dato+')');  
  
    localStorage.setItem("aspirante_selecionado",dato);
  	$('#btnagregar').css('display','none');  
		$('#btnactualizar').css('display','block');	  
		$('#id_delegado').val('');
		$('#nombreasoc').val('');
		$('#apellidoasoc').val('');
		$('#numasoc').val('');
  
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
 
				// var datoz = JSON.parse(result);
						var id_delegado = datoz[0]['id_delegado'];	
					  var nombre = datoz[0]['nombre'];	
					  var apellido = datoz[0]['apellido'] ? datoz[0]['apellido'] : 'Pendiente';	
               //console.log(apellido);
					  var num_cliente =datoz[0]['num_cliente'];	
            var memoria =datoz[0]['memoria'] ? datoz[0]['memoria'] : '...';
						var foto = datoz[0]['foto'] ? datoz[0]['foto'] : '';
            var tipo = datoz[0]['tipo'] ? datoz[0]['tipo'] : '';	
            var id_cv = datoz[0]['adjunto'] ? datoz[0]['adjunto'] : '';  
        
            if(foto!='')
            {
              $('#fotoexistente').css('display', 'block');
              model.tipo_imagen =tipo;
              model.avatarBase64 =foto;     
              $('#fotoexistente').attr('href', "../../../adjuntos/"+foto); 
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
                        //console.log(datoz);
                        $('#cvexistente').attr('href', '../../../adjuntos/'+datoz); 
                  }
                });
            }
        
        
					  $('#id_delegado').val(id_delegado);
					  $('#nombreasoc').val(nombre);
					  $('#apellidoasoc').val(apellido);
					  $('#numasoc').val(num_cliente);
            $('#clasoc_id').val(num_cliente);
            CKEDITOR.instances['memoria'].setData(memoria);
     /*   
   var model = {
      memoria : '',
      id_cv:'',
      tipo_imagen:'',
      avatarBase64:''
  };  
  */
        
              // si tiene foto 
        
        
        
             // si tiene adjunto
					  
        
            $('#verparticipaciones').css('display','block');
          //$('#myModal').hide();
        
			},
			error: function (r) {
				console.log("ERROR");

				console.log(r);
			}
		});

		//console.log('Cargar');
}
	
function Eliminar(dato)
{
		
  		Lobibox.confirm({
                    msg: "Desea eliminar este aspirante ?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
							
							$.ajax({
								url: '{{ url("sistema/eliminaraspirante")}}',
								data: {"aspirante": dato },
								method: 'post',
								headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
								 // setTimeout(function(){ location.reload();  }, 1000);	  
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
		console.log('Eliminar');			
}

	
var datosSeleccionado = null;
var max_votos = 0;
var datos='';

function blanquearnewaspi()
{
  $('#numasoc').val('');
  $('#nombreasoc').val('');
  $('#apellidoasoc').val('');
  $('#select_file').val('');
    $('#clasoc_id').val('');
}

/*
function updateRango()
{ 
		var nom01 = $('#nombre').val();


		var ran01 = $('#rangofecha1').val();


		var ran02 = $('#rangofecha2').val();

		var maxvotos = $('#maxvotos').val();


		  if(nom01=="" || nom01==undefined || nom01.length < 0)
		  {
				lobibox_emergente('info','top right',true,'Deben un valor en nombre.');		 
			return false;
		  }

		  if(ran01=="" || ran01==undefined || ran01.length < 0)
		  {
				lobibox_emergente('info','top right',true,'Deben un valor fecha incial.');		 
			return false;
		  }
		  else if(ran02=="" || ran02==undefined || ran02.length < 0)
		  {
				lobibox_emergente('info','top right',true,'Deben un valor fecha final.');		 
			return false;
		  }	
		else{
			ran01 = ran01.replace("/", "-")+ ':00';
			ran02 = ran02.replace("/", "-")+ ':00';

		}
		console.log('updateRango');	
}
*/






$(document).ready(function () {
  
/*
  if(localStorage.getItem("aspirante_selecionado").length>0 ){
    console.log(localStorage.getItem("aspirante_selecionado"));
     Cargar(localStorage.getItem("aspirante_selecionado"));
  }

  */   

  blanquearnewaspi();
  
  
	$('#lstaspirantes').DataTable();
	cargarlistado(1);	
	 
  
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
                   url:'{{ url("sistema/almacenarfile")}}',
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
                    $('#cvexistente').css('display', 'block');
                    $('#cvexistente').attr('href', data.uploaded_doc);
                     model.id_cv =  data.id_uploaded_doc;
                   }
                  });
        }
        else
        {
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
                    $('#fotoexistente').css('display', 'block');
                    $('#fotoexistente').attr('href', "../../../adjuntos/"+data.uploaded_doc);                     
                    model.tipo_imagen =  data.tipo_imagen;
                    model.avatarBase64 = data.uploaded_doc;
                   }
                  });         
        }
           


    }); 

});

</script>

@stop
