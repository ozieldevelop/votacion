@extends('layouts.dashboard')

@section('content')
<div class="row ">
						<div class="col-md-6">
              <a class="col-md-12 btn btn-block btn-primary btn-flat" href="{{ url("sistema/vistaenviocapitular")}}">
                      CAPITULAR
              </a>
            </div>
						<div class="col-md-6">
              <a class="col-md-12 btn btn-block btn-primary btn-flat" href="{{ url("sistema/vistaenvioasamblea")}}">
                      ASAMBLEA
              </a>              
            </div>
</div>
<br/>

<div class="row ">
      		<div class="col-md-12">
						

            
            
	<div class="row ">
	   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputevento">Seleccione Evento Capitular</label>
		<select id="eventos" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="Cargar()" >
							<option value=""> -- Elegir</option>
							@foreach ($eventos as $dataeventos)
								<option value="{{ $dataeventos->id }}">{{ $dataeventos->rangofecha1 }} | {{ $dataeventos->nombre }}</option>
							@endforeach
		</select>
	  </div> 
	</div>
	

			</div>
			


	
		</div>



		<div class="row ">
      		<div class="col-md-3">
		
            
        <div class="row"  id="areaimportacion" style="display:none">
              <div class="col-md-12">

                            <div class="card" >
                              <div class="card-header bg-light resaltado"> IMPORTAR LISTADO CSV </div>
                              <div class="card-body" >
                                <!-- dropzone  -->
                                <form action="{{ url('/sistema/upload') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                  <input type="hidden"  id="up_id_evento" name="up_id_evento"  data-bindto="parametros.up_id_evento"  value="">
                                  <input type="hidden"  id="tipo_invitacion" name="tipo_invitacion"  data-bindto="parametros.tipo_invitacion"  >
                                  {{ csrf_field() }}
                                </form>
                                <!-- AREA DONDE SE LISTARAN LOS ARCHIVOS ADJUNTOS UNA VEZ SUBIDOS -->
                                <table  class="table" style="width:100%" id="gs_tbl_GestionesArchivos"> </table>
                              </div>
                            </div>
                
            </div>
        </div>
 
            
        <div class="row ">


                  <div class="col-md-12">

                      <div class="row ">
                         <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
                        <label for="inputevento">Seleccione tipo de invitaci&oacute;n </label>
                        <select id="tipo_invitacion" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="selecciontipo(this)" >
                                  <option value="1"> Invitaci&oacute;n a registrase</option>
                                   <option value="2"> Invitaci&oacute;n d&iacute;a del evento </option>
                        </select>
                        </div> 
                      </div>

                  </div>
        </div>
            
	<div class="row ">
	   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputapellidoasoc">Nombre Evento</label>
		
		
		<input type="hidden" class="form-control col-sm-12 col-md-12 col-lg-12 " id="id_evento" >
		<input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="nombre" disabled placeholder="Ingrese el nombre del evento">
	  </div> 
	</div>
	<div class="row">
  <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
    <label for="inputnumasociado">Inicia</label>
    <input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="rangofecha1"  disabled placeholder="2020-11-01 00:00:00">
  </div>
</div>
<div class="row">
    <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
    <label for="inputnombreasoc">Termina</label>
    <input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="rangofecha2" disabled placeholder="2020-11-01 00:00:00">
  </div>
 </div> 
 <div class="row">
    <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
    <label for="inputnombreasoc">M&aacute;ximos de votos por persona</label>
    <input type="number" class="form-control" id="maxvotos" min="1"  value="10" disabled placeholder="0">
  </div>
 </div> 

            
				<div class="row ">
				   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
					<label for="inputevento">Areas</label>
						<select id="secciones" class="form-control col-sm-12 col-md-12 col-lg-12" disabled >
							@foreach ($asamblea_estructura as $dataestructura)
								<option value="{{ $dataestructura->id_ae }}">{{ $dataestructura->etiqueta }}</option>
							@endforeach
						</select>
				  </div> 
				</div>

  <div class="row ">
	    <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		     <label for="lblid_zoom">ID ZOOM</label>
		     <input type="text" class="form-control col-sm-12 col-md-12 col-lg-12 " id="id_zoom" disabled  placeholder="Ingrese el id zoom">
	    </div> 
	</div>

   <div class="row">
	 <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
							
         <div id="checkboxses" class="col-md-12 col-lg-12">	  
							@foreach ($capitulos as $datacapitulos)
								<div class="checkbox"><label><input type="checkbox" disabled id="elchea{{ $datacapitulos->IDAGEN }}"  class="loschecks"  value="{{ $datacapitulos->IDAGEN }}"> {{ $datacapitulos->AGENCIA }}</label></div>
							@endforeach
         </div>							
	  </div>
	   
  </div> 
  
 
   <div class="row">
  
	 <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
			 <hr/>				
         <div id="checkboxsesEstados" class="col-md-12 col-lg-12">	  
							@foreach ($estados_asoc as $dataestados_asoc)
								<div class="checkbox"><label><input type="checkbox" disabled id="elcheb{{ $dataestados_asoc->id_estado }}"  class="loschecksEstados"  value="{{ $dataestados_asoc->id_estado }}"> {{ $dataestados_asoc->estado }}</label></div>
							@endforeach				
			
         </div>									
	  </div>
  </div>  
 

	<div class="row area_btn_procesar" style="display:none">
   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">

                <button type="text" id="btnagregar" class="btn btn-secondary form-control"  onclick="generarcola()">GENERAR COLA TODOS</button>
    </div>
  </div>

  <div class="row area_btn_procesar"  style="display:none">
   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">

                <button type="text" id="btnenviogeneral" class="btn btn-secondary form-control" onclick="procesarcola()">PROCESAR COLA</button>
    </div>
  </div>
  
	</div>
	<div class="col-md-9">
							<style>
						#lsteventos_wrapper{
						width:100%;
						}
						</style>
				

											<table id="lstenvios" class="display" cellspacing="0" style="width:100%">
												<thead>
													<tr>
														<th>CLICK</th>
														<th>NUMCLI</th>
														<th>CORREO</th>
														<th>NOMBRE</th>
														<th>AGREGADO</th>
														<th>PENDIENTE</th>
														<th>ENVIADOS</th>
														<th>FALLIDOS</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
    
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

      <script type="text/javascript" src="{{ url('assets/dropzone') }}/dropzone.js"></script>
      <link rel="stylesheet" type="text/css" href="{{ url('assets/dropzone') }}/dropzone.css"/>


<script>
  
    var editor = CodeMirror.fromTextArea(codeMirrorDemo, {
    lineNumbers: true,
    mode: "htmlmixed",
    theme: "monokai"    
  });
  
  
  
  var modelo = {
    'up_id_evento':'#',
    'tipo_invitacion': 1
  }; 

  
  
  function selecciontipo(elemento)
{     
    modelo.tipo_invitacion = elemento.value;
    editor.setValue(JSON.stringify(modelo,undefined,2));
    Cargar();
}  
  
function generarcola(){
	var eleccion = $('#eventos').val();
	espere('Cargando');
									$.ajax({
										type: "GET",
										datatype: 'json',
										data: {"eleccion": eleccion },
										url: '{{ url("sistema/insertarnuevosavisos")}}',  
										success: function(result){
										//var data = JSON.parse(result);
												//console.log(result);
												cargarlistado(1);
												terminar_espere();
											
										},
										error: function (r) {
											//console.log("ERROR");
											//console.log(r);
											terminar_espere();
										}
									});
}


function procesarcola(){
	var eleccion = $('#eventos').val();
  var tipo_invitacion = $('#tipo_invitacion').val();
	espere('Cargando');
									$.ajax({
										type: "GET",
										datatype: 'json',
										data: {"id_evento": eleccion,"tipo_invitacion": tipo_invitacion  },
										url: '{{ url("sistema/enviarcolaglobal")}}',  
										success: function(result){
										//var data = JSON.parse(result);
												//console.log(result);
												terminar_espere();
												cargarlistado(1);
												
										},
										error: function (r) {
											//console.log("ERROR");
											//console.log(r);
											terminar_espere();
										}
									});
} 




function Cargar()
{
    var dato = $('#eventos').val() ;
  
  	modelo.up_id_evento = dato;
  
    //alert(modelo.tipo_invitacion);
    editor.setValue(JSON.stringify(modelo,undefined,2));
  
    if($('#eventos').val() =='')
    {
      $('#areaimportacion').css('display','none');
      $('.area_btn_procesar').css('display','none');
    }
    else{
      $('#areaimportacion').css('display','block');
      $('.area_btn_procesar').css('display','block');
    }

  
  
    /*
		$('#btnagregar').css('display','none');  
		$('#btnagregarparam').css('display','block');	
	*/	

			 
	$('#id_evento').val('');
	$('#nombre').val('');
	$('#rangofecha1').val('');
	$('#rangofecha2').val('');
	$('#maxvotos').val('');
	$('#id_zoom').val('');	 
  
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
			 if(datoz.length>0)
			 {
				  var id_evento = datoz[0]['id'];	
				  var tipo = datoz[0]['tipo'];
				  var n1 = datoz[0]['nombre'];	
				  var mvotos = datoz[0]['maxvotos'];	
          var id_zoom = datoz[0]['id_zoom'];	
         
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
         
			}	 	  
			cargarlistado(1);			
        },
        error: function (r) {
            console.log("ERROR");
            console.log(r);
        }
    });

	console.log('Cargar');
}





function cargarlistado(valor)
{
	//aDataSort


      //alert(invitacion_val);
			  if(valor==1)
			  {

				$('#lstenvios').empty();
				$("#lstenvios").dataTable().fnDestroy();
				
			  var dt = $('#lstenvios').DataTable({
				bJQueryUI: true,
				scrollCollapse: true,
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
				order: [5,'asc'],
				columnDefs: [ {

				targets: [ 5 ], // column or columns numbers

				orderable: false,  // set orderable for selected columns

				}],			

				"columns": [
				  { "width": "10%" },
				  { "width": "10%" },
				  { "width": "20%" },
				  { "width": "20%" },
				  { "width": "10%" },
				  { "width": "10%" },
				  { "width": "10%" },
				  { "width": "10%", "orderable": "false" }
				],				
				  ajax: {
					  url: '{{ url("sistema/cargarenvios")}}',   
					  beforeSend: function () {
						  espere("Se están cargando los datos del módulo");
					  },
					  complete: function (json, type) { //type return "success" or "parsererror"
						  if (type == "parsererror") {
						  }
						  terminar_espere();
					  },
					  data: function (d) {
						  d.eleccion = modelo.up_id_evento;
              d.tipo_invitacion = modelo.tipo_invitacion;
					  }
				  },
				  columns: [
				  {
					  "class":          "details-control",
					  "orderable":      false,
					  "data":           null,
					  "defaultContent": '<img src="../../images/expand.png"  style="cursor:pointer;width:31px" alt="expand/collapse" style="width:120px">'
				  },				  
				   { data: 'CLDOC',  name: 'CLDOC' , class: 'text-center'},				   
				   { data: 'NOMBRE', name: 'NOMBRE' , class: 'text-center'},
				   { data: 'CORREO', name: 'CORREO', class: 'text-center' },
				   { data: 'agregado', name: 'agregado', class: 'text-center' },
				   { data: 'pendiente', name: 'pendiente', class: 'text-center' },
				    { data: 'enviados', name: 'enviados', class: 'text-center' },
				   { data: 'fallido', name: 'fallido', class: 'text-center' }
							   
				 ]
			  });
			  
		 
				var detailRows = [];	 
					$('#lstenvios tbody').on( 'click', 'tr td.details-control', function () {
						var tr = $(this).closest('tr');
						var row = dt.row( tr );
						var idx = $.inArray( tr.attr('id'), detailRows );

						if ( row.child.isShown() ) {
							tr.removeClass( 'detailsx' );
							tr.css("background-color", "white");
							row.child.hide();

							// Remove from the 'open' array
							detailRows.splice( idx, 1 );
						}
						else {
							tr.addClass( 'detailsx' );
							tr.css("background-color", "#a1c9cf");

							row.child( format( row.data() ) ).show();

							// Add to the 'open' array
							if ( idx === -1 ) {
								detailRows.push( tr.attr('id') );
							}
						}
					} );
	
			 }
			 else
			 {
					$('#lstenvios').DataTable();
			 }
  }
  
function format ( d )
{
    return "<div class='row'>" +
    "<div class='col-sm-3'> <button type='button' Class='btn btn-warning' style='width:100%' onclick='javascript:fnlosmovimientos("+(d.id_evento) +","+(d.CLDOC)+","+(d.tipo_invitacion) +")'>MOSTRAR HISTORIAL</button></div><div class='col-sm-3'> <button type='button' Class='btn btn-primary' style='width:100%' onclick='javascript:fnreinsertar("+(d.id_evento) +","+(d.CLDOC) +","+(d.tipo_invitacion) +")'>AGREGAR Y ENVIAR</button><br/></div><div class='col-sm-3'> </div><div class='col-sm-12'>  <table id='tblmovimientos_"+(d.CLDOC) +"'  style='width:100%'></table> </div> </div> ";

}  

function fnreinsertar(evento,cldoc,tipo_invitacion)
{
	espere('Cargando');	
	$.ajax({
      url: '{{ url("sistema/reinsertar")}}' 
		  , data: {"id_evento": evento ,  "cldoc":cldoc , "tipo_invitacion":tipo_invitacion}
		  , method: 'post',
		  headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  },
		  success: function(elhtml2){
			 			 fnreenviarnoti(evento,cldoc,tipo_invitacion);
		  },
		  error: function (r) {
					console.log("ERROR");
					console.log(r);
		  }
	 });
 
}

function fnreenviarnoti(evento,cldoc,tipo_invitacion)
{

	$.ajax({
          url: '{{ url("sistema/fnreenviarnoti")}}'
		  , data: {"id_evento": evento ,  "cldoc":cldoc , "tipo_invitacion":tipo_invitacion}
		  , method: 'post'
		  , headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  },
		  success: function(elhtml2){
			   terminar_espere();
			setTimeout(function(){  fnlosmovimientos(evento,cldoc,tipo_invitacion); },2000);
		  },
		  error: function (r) {
					console.log("ERROR");
					console.log(r);
		  }
	 });
 
}


function fnlosmovimientos(evento,cldoc,tipo_invitacion)
{

		
	$.ajax({
          url: '{{ url("sistema/cargardetalleenvios")}}',     
		  data: {"evento": evento ,  "cldoc":cldoc , "tipo_invitacion":tipo_invitacion },
		  method: 'post',
		  headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  },
		  success: function(elhtml2){
			  //console.log(elhtml2);
            var datosRecibidos2 = elhtml2;
            buildHtmlTableHistorialparc(datosRecibidos2,'#tblmovimientos_'+ cldoc); 
		  },
		  error: function (r) {
					console.log("ERROR");
					console.log(r);
		  }
	 });
}

function buildHtmlTableHistorialparc(elementosData,selector)
{
        var columns = addAllColumnHeadersdatos(elementosData, selector);
        for (var i = 0; i < elementosData.length; i++) {
          if(elementosData[i] != undefined)
          {
                  var row$ = $('<tr/>');
                      for (var colIndex = 0; colIndex < columns.length; colIndex++) {
                                var cellValue = elementosData[i][columns[colIndex]];
                                //console.log(cellValue);
                                if (cellValue == null) cellValue = "";
                                //row$.append($('<td contenteditable="true"/>').html(cellValue));
                                row$.append($('<td "style="word-wrap: break-word" />').html(cellValue));
                      }
                      $(selector).append(row$);
                  }
        }
}


function addAllColumnHeadersdatos(elementosDatax1, selector)
{
        var columnSet = [];
        var elthead = $('<thead/>');
        $(elthead).attr("class", "thead-light");
        var headerTr$ = $('<tr/>');
        for (var i = 0; i < elementosDatax1.length; i++) {
                  var rowHash = elementosDatax1[i];
                      for (var key in rowHash) {
                        if ($.inArray(key, columnSet) == -1) {
                          columnSet.push(key);
                          headerTr$.append($('<th/>').html(key));
                        }
                      }
        }
        if( elementosDatax1.length >0)
        {
          var thcustom = document.createElement("th");
          headerTr$.append(thcustom);
          elthead.append(headerTr$);
        }
        else {
          $(selector).html('<thead class="thead-light"><tr><th>No se encontraron registros</th></tr></thead>');
          return columnSet;
        }

        $(selector).html(elthead);
        return columnSet;
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
              maxFiles: 1,
              acceptedFiles: ".csv",
              init: function () {
                  this.on("queuecomplete", function () {
                       console.log('Termino de subir');
                      // setTimeout(function(){ location.reload();  }, 3000);
                    
	                      //espere('Cargando');
												cargarlistado(1);  
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
  
$('#eventos').val('');
$('#tipo_invitacion').val(1); 
  
$(document).ready(function () {
  $('#tipo_invitacion').val(1); 
        editor.setValue(JSON.stringify(modelo,undefined,2));
	cargarlistado(0);


});
</script>



@stop

