@extends('layouts.dashboard')

@section('content')






<div class="row ">
      		<div class="col-md-12">
						
						
	<div class="row ">
	   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputevento">Seleccione Evento</label>
		<select id="eventos" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="Cargar(this.value)" >
							<option value="x"> -- Elegir</option>
							@foreach ($eventos as $dataeventos)
								<option value="{{ $dataeventos->id }}">{{ $dataeventos->rangofecha1 }} | {{ $dataeventos->nombre }}</option>
							@endforeach
		</select>
	  </div> 
	</div>
	

			</div>
</div>




		<div class="row">
				<div class="form-group col-sm-12 col-md-12 col-lg-12 ">
                            <div class="card" >
                              <div class="card-header bg-light resaltado">ADJUNTOS</div>
                              <div class="card-body" >

                                <!-- dropzone  -->
                                <form action="{{ url('/sistema/uploaddocumentosevento') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                  <input type="hidden"  id="up_id_evento" name="up_id_evento"  data-bindto="parametros.up_id_evento"  value="">
                                  {{ csrf_field() }}
                                </form>
                                <!-- AREA DONDE SE LISTARAN LOS ARCHIVOS ADJUNTOS UNA VEZ SUBIDOS -->
                                <table  class="table" style="width:100%" id="gs_tbl_GestionesArchivos"> </table>                                
                                
                                
                                
                              </div>
                            </div>											
					</div>
		</div>	




		<div class="row ">
      		<div class="col-md-12" >

			</div>
		</div>
	<div id="widget1">
		<div class="row ">
      		<div class="col-md-12" >

				<div class="card text-center">
				  <div class="card-header bg-warning"  style="color:black;font-weight:bold" >
				<input type="text" class="form-control" id="asuntoemail" placeholder="ASUNTO"  data-bindto="parametros.asuntoemail"  name="asuntoemail"  style="color:black;font-weight:bold" ></input>
				  </div>
				  <div class="card-body">
						<textarea id="contenidoemail"   data-bindto="parametros.contenidoemail"  name="contenidoemail"  style="border: 1px solid gray; width: 600px; height: 250px;"></textarea>
				  </div>

				</div>
				
				
			</div> 		
		</div> 
		<div class="row ">
      		<div class="col-md-12">
			
				<div class="card text-center">
				  <div class="card-header  bg-primary "  style="color:white;font-weight:bold">
					 Resultados Header
				  </div>
				  <div class="card-body">
						<textarea id="resultadoheader"   data-bindto="parametros.resultadoheader"  name="resultadoheader"  style="border: 1px solid gray; width: 600px; height: 250px;"></textarea>
				  </div>

				</div>

				
				
			</div> 			
		</div> 
		<div class="row ">
      		<div class="col-md-12">
			
				<div class="card text-center">
				  <div class="card-header bg-primary " style="color:white;font-weight:bold">
					Footer Resultados
				  </div>
				  <div class="card-body">
						<textarea id="resultadofooter"   data-bindto="parametros.resultadofooter"  name="resultadofooter"  style="border: 1px solid gray; width: 600px; height: 250px;"></textarea>
				  </div>

				</div>

			</div> 			
		</div> 
	</div>		
	
		<style>


		.hljs {
			background-attachment: scroll;
			background-clip: border-box;
			background-color: #181914;
			background-image: url("./pojoaque.jpg");
			background-origin: padding-box;
			background-position: left top;
			background-repeat: repeat;
			background-size: auto auto;
			color: #dccf8f;
			display: block;
			padding-bottom: 0.5em;
			padding-left: 0.5em;
			padding-right: 0.5em;
			padding-top: 0.5em;
		}


		</style>

									
		<div class="row">
				<div class="form-group col-sm-12 col-md-12 col-lg-12 ">
					 <button type="text" id="btnagregar" class="btn btn-success form-control" onclick="actualizarplantillas()">GUARDAR PLANTILLAS</button>
				</div>
		</div>
		  
  
</div>
  
@endsection

@section('page-script')

<script type="text/javascript" src="{{ url('assets/dropzone') }}/dropzone.js"></script>

<link rel="stylesheet" type="text/css" href="{{ url('assets/dropzone') }}/dropzone.css"/>
<script src="{{ asset('js/ckeditor.js') }}"></script>

		<script>
			
  
function buildHtmlTableAdjuntos(adjuntosed,selector) 
{
   var columns = addAllColumnHeadersAdjuntos(adjuntosed,selector);
		var contadoradjuntos = 0;
		var bandera = -1;


        for (var i = 0; i < adjuntosed.length; i++) 
        {
          if(adjuntosed[i] != undefined)
          {
       
                  var row$ = $('<tr id=rowNum'+contadoradjuntos+' />');
                  for (var colIndex = 0; colIndex < columns.length; colIndex++) 
                  {
                      //console.log(adjuntosed);
								      bandera++;
                      var cellValue = adjuntosed[i][columns[colIndex]];
                      //console.log(adjuntosed[i]);
                          if (cellValue == null) cellValue = "";

                                if(bandera<=1)
                                {
									                  row$.append($('<td style="word-wrap: break-word;" />').html(cellValue));
                                          
								                }
								                else
                                {
                                  var eldiv = document.createElement("div");	
                                  eldiv.setAttribute("role", "group");
                                  eldiv.setAttribute("class", "btn-group-vertical");

                                  var elboton = document.createElement("button");
                                  elboton.setAttribute("aria-expanded", "aria-expanded");
                                  elboton.setAttribute("aria-haspopup", "true");
                                  elboton.setAttribute("data-toggle", "dropdown");
                                  elboton.setAttribute("class", "btn btn-secondary dropdown-toggle ");
                                  elboton.setAttribute("type", "button");
                                  elboton.innerHTML = "Opciones";
                                  eldiv.appendChild(elboton);

                                  var eldiv2 = document.createElement("div");	
                                  eldiv2.setAttribute("aria-labelledby", "btnGroupVerticalDrop1");
                                  eldiv2.setAttribute("class", "dropdown-menu");
                                  eldiv2.setAttribute("x-placement", "bottom-start");

                                  /*
                                  var a1 = document.createElement("a");	
                                  a1.setAttribute("class", "dropdown-item");
                                  a1.setAttribute("type", "button");
                                  a1.setAttribute("style", "cursor:pointer");
                                  a1.setAttribute("onclick", "javascript:abriretiquetaadjunto("+cellValue+")");
                                  a1.innerHTML = "Etiquetar";
                                  */

                                  var a2 = document.createElement("a");	
                                  a2.setAttribute("class", "dropdown-item");	
                                  a2.setAttribute("style", "cursor:pointer");
                                  a2.setAttribute("onclick", "javascript:eliminaradjunto("+cellValue+")");
                                  a2.innerHTML ="Eliminar";

                                  //eldiv2.appendChild(a1);
                                  eldiv2.appendChild(a2);

                                  eldiv.appendChild(eldiv2);

                                  
                                  var elboton2 = document.createElement("button");
                                  elboton2.setAttribute("type", "button");
                                  elboton2.setAttribute("onclick", "javascript:descargaradjunto("+cellValue+")");
                                  elboton2.setAttribute("class", "btn btn-info col-6");
                                  elboton2.innerHTML ="Descargar";

                                  var eltdfinal = document.createElement("td");
                                  eltdfinal.setAttribute("style","word-wrap: break-word");
                                  eltdfinal.appendChild(eldiv);
                                  eltdfinal.appendChild(elboton2);
                                  row$.append(eltdfinal);	
                                  
                                }
                     }
								        
                    if(bandera===2)
                    {
                      bandera=-1;
                    }

					  }
                      contadoradjuntos++;
                      $(selector).append(row$);
                  }


}
      
      
      
        function addAllColumnHeadersAdjuntos(elementosDatax1, selector)
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
                  /*var thcustom = document.createElement("th");
                  headerTr$.append(thcustom);
                  elthead.append(headerTr$);*/
                  $(selector).html('<thead class="thead-light"><tr><th></th><th></th><th></th></tr></thead>');
                }
                else {
                  $(selector).html('<thead class="thead-light"><tr><th>No se encontraron registros</th></tr></thead>');
                  return columnSet;
                }

                $(selector).html(elthead);
                return columnSet;
        }
      
      
      
      
        function cargaadjuntosx(opcion)
        {
            // console.log("aaa");
          var id_evento = $('#eventos').val();
							$.ajax
              ({
								url: '{{ url("sistema/cargaadjuntosScreenListar")}}/'  
								, data: { 'id_evento': id_evento  }             
								, method: 'get'
								,success: function(datos){
                          //adjuntosed = datos; 
                          $('#gs_tbl_GestionesArchivos').html('');
                          buildHtmlTableAdjuntos(datos,'#gs_tbl_GestionesArchivos');
								},
								error: function (r) {
										//console.log("ERROR");
										//console.log(r);
								}
							});
        }
      
Dropzone.autoDiscover = false;
// or disable for specific dropzone:
// Dropzone.options.myDropzone = false;

$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzone = new Dropzone(".dropzone");

  myDropzone.on("queuecomplete", function(file, res) {
      if (myDropzone.files[0].status != Dropzone.SUCCESS ) {
          //alert('yea baby');
      } else {
               cargaadjuntosx(1);
                  console.log('Termino');
      }
  });
});  
      /*
         Dropzone.options.myDropzone = {
          paramName: 'file',
          maxFilesize: 20, // MB
          maxFiles: 20,
          //acceptedFiles: ".jpeg,.jpg,.png,.gif",
          init: function()
          {
              this.on("success", function(file, response) {
                  cargaadjuntosx(1);
                  console.log('Termino');
              });
          }
         };
         */
    /*  
 Dropzone.options.myDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  accept: function(file, done) {
    if (file.name == "justinbieber.jpg") {
      done("Naha, you don't.");
    }
    else { done(); }
  }
};*/
      
      
											CKEDITOR.replace('contenidoemail', { 
													toolbar : [
														{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
														{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
														{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
														'/',
														{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
														{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
														{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
														{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
														'/',
														{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
														{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
														{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
														{ name: 'others', items: [ '-' ] }
													],
													on: {
														change: function( evt ) {
															var dddd1 =  evt;
															model.asuntoemail =$('#asuntoemail').val();
															
															if( dddd1.editor.name == 'contenidoemail')
															{
																model.contenidoemail =dddd1.editor.getData();
															}													
														}
													}										
											});
			
			
											
											CKEDITOR.replace('resultadoheader', { 
													toolbar : [
														{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
														{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
														{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
														'/',
														{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
														{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
														{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
														{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
														'/',
														{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
														{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
														{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
														{ name: 'others', items: [ '-' ] }
													],
													on: {
														change: function( evt ) {

															var dddd1 =  evt;
															 if( dddd1.editor.name == 'resultadoheader'){
																model.resultadoheader =dddd1.editor.getData();
															}												
														}
													}										
											});


											CKEDITOR.replace('resultadofooter', { 
													toolbar : [
														{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
														{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
														{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
														'/',
														{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
														{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
														{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
														{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
														'/',
														{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
														{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
														{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
														{ name: 'others', items: [ '-' ] }
													],
													on: {
														change: function( evt ) {
	
															var dddd1 =  evt;

															if( dddd1.editor.name == 'resultadofooter')
															{
																model.resultadofooter =dddd1.editor.getData();
															}
													
														}
													}										
											});
										
									
									</script>
									
<script>

var model = {
				asuntoemail: "",
				contenidoemail: "",
				resultadoheader: "",
				resultadofooter: ""
			};
			

function Cargar(dato)
 {
	var eleccion = $('#eventos').val();
   
   $('#up_id_evento').val(eleccion);
   
		if(dato=="" || dato==undefined || dato.length < 0)
		{
			lobibox_emergente('info','top right',true,'Deben selecionar algun item del listado.');		 
			CKEDITOR.instances['contenidoemail'].setData('')   ;
			CKEDITOR.instances['resultadoheader'].setData('')   ;
			CKEDITOR.instances['resultadofooter'].setData('')   ;
			$('#asuntoemail').val('');
			return false;
		}	
		else{
		
					espere('Cargando');


					$.ajax({
							type: "GET",
							url: '{{ url("sistema/cargarplantillasemailevento")}}',  
							data: {"evento": dato },
							success: function(result){
								 var datoz = JSON.parse(result);
								 //var datoz = (result);
								 $('#asuntoemail').val(datoz[0].asunto)   ;
								 console.log(datoz[0].asunto);
								 model.asuntoemail= datoz[0].asunto;
								 CKEDITOR.instances['contenidoemail'].setData(datoz[0].texto)   ;
								 terminar_espere();
							},
							error: function (r) {
								console.log("ERROR");
								console.log(r);
								terminar_espere();
							}
						});

					$.ajax({
							type: "GET",
							url: '{{ url("sistema/cargarplantillasresultevento")}}',   
							data: {"evento": dato },
							success: function(result1){
								var datoz2 = JSON.parse(result1);
								//console.log(datoz2);
								//var datoz2 = (result1);
								 //var superior = datoz[0]['superior'];	
								 //var inferior = datoz[0]['inferior'];
								 
								// CKEDITOR.instances['template'].setData(datosdenews[0].comentario)   ;
								 CKEDITOR.instances['resultadoheader'].setData(datoz2[0].superior)   ;
								 CKEDITOR.instances['resultadofooter'].setData(datoz2[0].inferior)   ;
									//console.log(datoz);
                  cargaadjuntosx(1);
								 terminar_espere();
							},
							error: function (r) {
								console.log("ERROR");
								console.log(r);
								terminar_espere();
							}
						});
			 }
}



function actualizarplantillas()
{
		var eleccion = $('#eventos').val();
		if(eleccion=="" || eleccion==undefined || eleccion.length < 0)
		{
			Lobibox.notify('warning', {
					msg: 'Debe seleccionar un evento.'
			});	
		}
		else{

							$.ajax({
								url: '{{ url("sistema/actualizarplantillasresultevento")}}', 
								data: { 'campos': JSON.stringify(model), 'id_evento': eleccion },
								method: 'post',
								headers: {
										'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								success: function(result){
											Lobibox.notify('success', {
												msg: 'Informaci&oacute;n actualizada.'
											});	
								},
								error: function (r) {
									console.log("ERROR");
									console.log(r);
								}
							});

							
		}
}


$(document).ready(function () {



			var gdb1=new GDB({parametros: model},{rootElementSelectorString: '#widget1',
				modelChangeCallback: function(e){
				  //model.comentario = CKEDITOR.instances.template.getData();
				  //alert(model.asunto);
				  $('#json').text(JSON.stringify(model, null, '    '));
				}
			});
	
});

</script>

@stop
