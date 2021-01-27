@extends('layouts.dashboard')

@section('content')


<div class="row ">
     <div class="col-md-3">
		
 
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


			 <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
							
										<button type="text" id="btnagregar" class="btn btn-secondary form-control" onclick="agregarNuevo()">AGREGAR</button>
										<button type="text" id="btnactualizar" class="btn btn-secondary form-control" onclick="actualizar()" style="display:none">ACTUALIZAR</button>
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
														<th>Nombre</th>
														<th>Apellido</th>
														<th>#Num</th>
														<th>Opci&oacute;n</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>


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
								url: '{{ url("sistema/agregarnuevo")}}',
								data: {"numasoc": numasoc , "nombreasoc": nombreasoc , "apellidoasoc": apellidoasoc },
								method: 'post',
								headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
									lobibox_emergente('success','top right',true,'Agregado.');
									console.log('agregarNuevo');
									setTimeout(function(){ location.reload();  }, 2000);
								},
								error: function (r) {
										console.log("ERROR");
										console.log(r);
								}
							});

	  }
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
								data: {"id_delegado": id_delegado,"numasoc": numasoc , "nombreasoc": nombreasoc , "apellidoasoc": apellidoasoc },
								method: 'post',
								headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
										lobibox_emergente('success','top right',true,'Actualizado.');
										console.log('actualizar');
										setTimeout(function(){ location.reload();  }, 2000); 
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
				  { "width": "70%" },
				  { "width": "10%" },
				  { "width": "10%" },
				  { "width": "10%", "orderable": "false" }
				],				
				ajax: '{{ url("sistema/cargaraspirantes")}}',
				  columns: [
				 		{ data: 'nombre', name: 'nombre' , class: 'text-center'},				   
						{ data: 'apellido', name: 'apellido' , class: 'text-center'},
						{ data: 'num_cliente', name: 'num_cliente', class: 'text-center' },
						{ data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'}				   
				 ]
			  });

	console.log('cargarlistado');
}
  
  
function Cargar(dato)
{
  
  		$('#btnagregar').css('display','none');  
		$('#btnactualizar').css('display','block');	  
		$('#id_delegado').val('');
		$('#nombreasoc').val('');
		$('#apellidoasoc').val('');
		$('#numasoc').val('');
		
	
		$.ajax({
			type: "GET",
			url: '{{ url("sistema/cargardatoaspirante")}}', 
			data: {"buscando": dato },
			success: function(datoz){
				// var datoz = JSON.parse(result);
						var id_delegado = datoz[0]['id_delegado'];	
					  var nombre = datoz[0]['nombre'];	
					  var apellido = datoz[0]['apellido'];	
					  var num_cliente =datoz[0]['num_cliente'];	
						
					  $('#id_delegado').val(id_delegado);
					  $('#nombreasoc').val(nombre);
					  $('#apellidoasoc').val(apellido);
					  $('#numasoc').val(num_cliente);

					  
			},
			error: function (r) {
				console.log("ERROR");
				console.log(r);
			}
		});

		console.log('Cargar');
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
								  setTimeout(function(){ location.reload();  }, 1000);	  
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
}


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
			/*
			$.ajax({
				type: "GET",
				url: "./objetos/peticiones.php?opcion=newformevento",
				data: {"nombre": nom01 ,"maxvotos": maxvotos ,"rangofecha1": ran01 , "rangofecha2": ran02 },
				success: function(result){
						lobibox_emergente('success','top right',true,'Actualizado.');		
					//setTimeout(function(){ location.reload();  }, 3000);
				},
				error: function (r) {
					console.log("ERROR");
					console.log(r);
				}
			});
			*/
		}
		console.log('updateRango');	
}







$(document).ready(function () {


	
	$('#lstaspirantes').DataTable();
	cargarlistado(1);	
	 

});

</script>

@stop
