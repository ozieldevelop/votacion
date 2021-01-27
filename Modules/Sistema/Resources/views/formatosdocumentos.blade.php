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


<script src="{{ asset('js/ckeditor.js') }}"></script>

		<script>
									
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
