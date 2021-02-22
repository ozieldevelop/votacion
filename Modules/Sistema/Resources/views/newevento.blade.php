@extends('layouts.dashboard')

@section('content')



<div class="row ">
    <div class="col-md-3">
			
	<div class="row ">
	   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputapellidoasoc">Nombre Evento</label>
		
		
		<input type="hidden" class="form-control col-sm-12 col-md-12 col-lg-12 " id="id_evento" >
		<input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="nombre"  placeholder="Ingrese el nombre del evento">
	  </div> 
	</div>
	<div class="row">
	  <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputnumasociado">Inicia</label>
		<input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="rangofecha1"  placeholder="2020-11-01 00:00:00">
	  </div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputnombreasoc">Termina</label>
		<input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="rangofecha2"  placeholder="2020-11-01 00:00:00">
	  </div>
	 </div> 
	 <div class="row">
		<div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputnombreasoc">M&aacute;ximos de votos por persona</label>
		<input type="number" class="form-control" id="maxvotos" min="1"  value="10"  placeholder="0">
	  </div>
	 </div> 
  		
				<div class="row ">
				   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
					<label for="inputevento">Areas</label>
						<select id="secciones" class="form-control col-sm-12 col-md-12 col-lg-12"  >
							@foreach ($asamblea_estructura as $dataestructura)
								<option value="{{ $dataestructura->id_ae }}">{{ $dataestructura->etiqueta }}</option>
							@endforeach
						</select>
				  </div> 
				</div>
      
 	<div class="row ">
	   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="lblid_zoom">ID ZOOM</label>
		<input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="id_zoom"  placeholder="Ingrese el id zoom (opcional)">
	  </div> 
	</div>
      
	<div class="row">
	 <div class="form-group col-sm-12 col-md-12 col-lg-12 ">		
         <div id="checkboxses" class="col-md-12 col-lg-12">	  
							@foreach ($capitulos as $datacapitulos)
								<div class="checkbox"><label><input type="checkbox" id="elchea{{ $datacapitulos->IDAGEN }}"  class="loschecks"  value="{{ $datacapitulos->IDAGEN }}"> {{ $datacapitulos->AGENCIA }}</label></div>
							@endforeach
         </div>							
	  </div>
    </div> 
	
    <div class="row">
	 <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
			 <hr/>				
         <div id="checkboxsesEstados" class="col-md-12 col-lg-12">	  
							@foreach ($estados_asoc as $dataestados_asoc)
								<div class="checkbox"><label><input type="checkbox" id="elcheb{{ $dataestados_asoc->id_estado }}"  class="loschecksEstados"  value="{{ $dataestados_asoc->id_estado }}"> {{ $dataestados_asoc->estado }}</label></div>
							@endforeach			
         </div>									
	  </div>
     </div>  
 

	<div class="row">
	<div class="form-group col-sm-12 col-md-12 col-lg-12 ">
							
							<button type="text" id="btnagregar" class="btn btn-secondary form-control" onclick="updateRango()">GUARDAR EVENTO</button>
							<button type="text" id="btnactualizar" class="btn btn-warning form-control" onclick="actualizar()" style="display:none">ACTUALIZAR EVENTO</button>
	</div>
    </div>


  
	</div>
	<div class="col-md-9">
							<style>
						#lsteventos_wrapper{
						width:100%;
						}
						</style>
									<div class="row">
									

											<table id="lsteventos" class="display" cellspacing="0" style="width:100%">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>Inicia</th>
														<th>Termina</th>
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
	  
			<script src="{{ asset('js') }}/php-date-formatter.min.js"></script>
			<script src="{{ asset('js') }}/jquery.mousewheel.js"></script>
			<script src="{{ asset('js') }}/jquery.datetimepicker.js"></script>
			<link rel="stylesheet" type="text/css" href="{{ asset('css') }}/jquery.datetimepicker.css"/>

<script>


function updateRango(){ 


var secciones = $('#secciones').find('option:selected').val();
			
var nom01 = $('#nombre').val();


var ran01 = $('#rangofecha1').val();


var ran02 = $('#rangofecha2').val();

var maxvotos = $('#maxvotos').val();

var idzoom = $('#id_zoom').val();
  
 var checkedVals = $('.loschecks:checkbox:checked').map(function() {
    return this.value;
}).get();

seleccioncheckbox = Object.values(checkedVals);
seleccioncheckbox.forEach(obj => {
  obj.value = +obj.value; 
});

var valoropcion = parseInt(seleccioncheckbox.length);


 var checkedVals2 = $('.loschecksEstados:checkbox:checked').map(function() {
    return this.value;
}).get();

seleccioncheckbox2 = Object.values(checkedVals2);

var valoropcion2 = parseInt(seleccioncheckbox2.length);


if(valoropcion<=0)
{
	lobibox_emergente('info','top right',true,'Deben seleccionar almenos una sucursal.');		 
	return false;
}

if(valoropcion2<=0)
{
	lobibox_emergente('info','top right',true,'Deben seleccionar almenos un estatus de asociado.');		 
	return false;
}
	  
/*console.log(seleccioncheckbox);
					
sucursales = [];

      for (var i = 0; i < seleccioncheckbox.length; i++) {
             sucursales.push({ "IDAGEN": seleccioncheckbox[i][0] });
      }

      var valoropcion = parseInt(seleccioncheckbox.length);

      if(valoropcion<=0)
       {
		lobibox_emergente('info','top right',true,'Deben seleccionar almenos una sucursal.');		 
		return false;
      }
	*/				
					

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
	ran01 = ran01.replace(/\//g, "-")+ ':00';
	ran02 = ran02.replace(/\//g, "-")+ ':00';
	
	
	$.ajax({
		url: '{{ url("sistema/agregarnuevoevento")}}',
		data: {"nombre": nom01 ,"maxvotos": maxvotos ,"rangofecha1": ran01 , "rangofecha2": ran02 ,'tipo': secciones,'idzoom':idzoom, 'capitulos': JSON.stringify(seleccioncheckbox),'estadosasoc': JSON.stringify(seleccioncheckbox2)},
		method: 'post',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(result){
				lobibox_emergente('success','top right',true,'Creado!');		
				setTimeout(function(){ location.reload();  }, 3000);
		},
		error: function (r) {
			console.log("ERROR");
			console.log(r);
		}
	});
							
}
}




function cargarlistado(valor)
{

			  if(valor==1)
			  {
				$("#lsteventos").dataTable().fnDestroy();
			  }
			  var t = $('#lsteventos').DataTable({

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
				ajax: '{{ url("sistema/cargareventos")}}',
				  columns: [
				   { data: 'nombre', name: 'nombre' , class: 'text-center'},				   
				   { data: 'rangofecha1', name: 'rangofecha1' , class: 'text-center'},
				   { data: 'rangofecha2', name: 'rangofecha2', class: 'text-center' },
				   { data: 'action', name: 'action', orderable: false, searchable: false, class: 'text-center'}				   
				 ]
			  });

	console.log('cargarlistado');
}


function Cargar(dato)
{
  
 	$('input[name="language"]').each(function() {
			this.checked = false;
	});
		
		
    $('#btnagregar').css('display','none');  
	$('#btnactualizar').css('display','block');	
	$('#btnagregarparam').css('display','block');				 

			 
	$('#id_evento').val('');
	$('#nombre').val('');
	$('#rangofecha1').val('');
	$('#rangofecha2').val('');
	$('#maxvotos').val('');
		
	$('.loschecks').each(function() {
			this.checked = false;
	});

	$('.loschecksEstados').each(function() {
			this.checked = false;
	});
		
    $.ajax({
        type: "GET",
        url:  '{{ url("sistema/cargardatoevento")}}', 
		data: {"evento": dato },
        success: function(result){
		
             var datoz = (result);
			 var id_evento = datoz[0]['id'];	
			 var tipo = datoz[0]['tipo'];
				  var n1 = datoz[0]['nombre'];	
				  var mvotos = datoz[0]['maxvotos'];	
          var id_zoom = datoz[0]['veri_id_zoom'];	
				  var f1 = datoz[0]['rangofecha1'].replace(/-/g, "/").substring(0,datoz[0]['rangofecha1'].length - 3);
				  var f2 = datoz[0]['rangofecha2'].replace(/-/g, "/").substring(0,datoz[0]['rangofecha2'].length - 3);
				  
				  
				  var capitulos =  JSON.parse(datoz[0]['capitulos']);	
				  var estadosasoc = JSON.parse(datoz[0]['estadosasoc']);
				  

				  capitulos.forEach(element =>$("#elchea"+element).prop("checked","checked") );
				  estadosasoc.forEach(element =>$("#elcheb"+element).prop("checked","checked") );

				  $('#id_evento').val(id_evento);
				  $('#nombre').val(n1);
				  $('#rangofecha1').val(f1);
				  $('#rangofecha2').val(f2);
				  $('#maxvotos').val(mvotos);
				  $("#secciones").val(tipo).change();
				  $('#id_zoom').val(id_zoom);
        },
        error: function (r) {
            console.log("ERROR");
            console.log(r);
        }
    });

	console.log('Cargar');
}

function actualizar(){

var id_evento = $('#id_evento').val();

var secciones = $('#secciones').find('option:selected').val();

var nombre = $('#nombre').val();
var rangofecha1 = $('#rangofecha1').val();
var rangofecha2 = $('#rangofecha2').val();
var maxvotos = $('#maxvotos').val();


var	ran01 = rangofecha1.replace(/\//g, "-")+ ':00';
var	ran02 = rangofecha2.replace(/\//g, "-")+ ':00';

var idzoom = $('#id_zoom').val();


 var checkedVals = $('.loschecks:checkbox:checked').map(function() {
    return this.value;
}).get();

seleccioncheckbox = Object.values(checkedVals);
seleccioncheckbox.forEach(obj => {
  obj.value = +obj.value; 
});

var valoropcion = parseInt(seleccioncheckbox.length);


 var checkedVals2 = $('.loschecksEstados:checkbox:checked').map(function() {
    return this.value;
}).get();

seleccioncheckbox2 = Object.values(checkedVals2);

var valoropcion2 = parseInt(seleccioncheckbox2.length);


if(valoropcion<=0)
{
	lobibox_emergente('info','top right',true,'Deben seleccionar almenos una sucursal.');		 
	return false;
}

if(valoropcion2<=0)
{
	lobibox_emergente('info','top right',true,'Deben seleccionar almenos un estatus de asociado.');		 
	return false;
}


  if(id_evento=="" || id_evento==undefined || id_evento.length < 0)
  {
				 lobibox_emergente('info','top right',true,'Verificar selecci&oacute;n.');	 
    return false;
  }
  else if(nombre=="" || nombre==undefined || nombre.length < 0)
  {
	lobibox_emergente('info','top right',true,'Deben ingresar un nombre.');

    return false; 
  }
  else if(rangofecha1=="" || rangofecha1==undefined || rangofecha1.length < 0)
  {
	lobibox_emergente('info','top right',true,'Debe ingresar una fecha inicial.');
	
    return false; 
  }  
  else if(rangofecha2=="" || rangofecha2==undefined || rangofecha2.length < 0)
  {
	lobibox_emergente('info','top right',true,'Debe ingresar una fecha final.');
    return false; 
  }   
  else{

	$.ajax({
		url: '{{ url("sistema/actualizarevento")}}',
		data: {"id": id_evento ,"nombre": nombre ,"maxvotos": maxvotos ,"rangofecha1": ran01 , "rangofecha2": ran02 ,'tipo': secciones,  'idzoom':idzoom, 'capitulos': JSON.stringify(seleccioncheckbox),'estadosasoc': JSON.stringify(seleccioncheckbox2)},
		method: 'post',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(result){
				lobibox_emergente('success','top right',true,'Actualizado!');		
				//setTimeout(function(){ location.reload();  }, 3000);
		},
		error: function (r) {
			console.log("ERROR");
			console.log(r);
		}
	});
	
  }
}


	function Eliminar(dato){
  
  		Lobibox.confirm({
                    msg: "Desea eleminar este evento ?",
                    callback: function ($this, type) {
                        if (type === 'yes') {
							
							$.ajax({
								url: '{{ url("sistema/eliminarevento")}}',
								data: {"evento": dato },
								method: 'post',
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
										lobibox_emergente('success','top right',true,'Eliminado!');		
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
			

	
	}
	

$(document).ready(function () {

	$('#lsteventos').DataTable();
	cargarlistado(1);	

});



</script>

<script>

var fecha = new Date();

var anio = fecha.getFullYear();

$.datetimepicker.setLocale('en');

$('#rangofecha1').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
//disabledDates:[anio+'/01/08',anio+'/01/09',anio+'/01/10'],
startDate:	anio+'/01/05'
});

$('#rangofecha2').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
//disabledDates:[anio+'/01/08',anio+'/01/09',anio+'/01/10'],
startDate:	anio+'/01/05'
});

$('#datetimepicker').datetimepicker({value:anio+'/04/15 05:03', step:10});

$('.some_class').datetimepicker();

$('#datetimepicker').datetimepicker({theme:'dark'})



</script>


@stop