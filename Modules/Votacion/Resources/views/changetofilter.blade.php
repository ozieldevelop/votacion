
@foreach ($categoriaspapeletas as $pape)
	<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
		<div class="card">
				<div class="card-header" style="text-align: center;">		
									<b>{{$pape->nombrearea }}</b>
				</div>
				<div class="row">
						@foreach ($aspirantes as $dataaspirante)

							@if($pape->id_area == $dataaspirante->id_area)
							
							<div class="cuadritovotante col-12 col-xs-12 col-sm-12 col-md-4 col-lg-3">
									  <div class="card">
										<div class="card-header bg-secondary" style="text-align: center;">
										 {{ $dataaspirante->num_cliente }}
										</div>
										<div class="card-body " id="collapseExample" style="text-align: center;">
										  <img onclick="avatardisplayFn('{{ $dataaspirante->id_delegado }}','{{ $pape->id_area }}','{{ $pape->nombrearea }}')"  class="img-fluid rounded-circle mx-auto d-block avatardisplay" id="img_{{ $dataaspirante->id_delegado }}" style="background: #7e977e;width: 154px;height:155px;cursor:pointer" src="
										  
							@if(trim($dataaspirante->foto)!="")
								{{ $dataaspirante->tipo}}base64,{{$dataaspirante->foto}}
							@else
								./images/logo-footer.png
							@endif
							
										  " >

										  <p style="text-align: center;font-size: 37px;font-weight: bold;">{{ substr($dataaspirante->nombre, 0, 10)  }} </p>
										  <p style="text-align: center;font-size: 37px;font-weight: bold;">{{ substr($dataaspirante->apellido, 0, 10)   }}</p>
										</div>
									  </div>
							</div>
							@endif
							
						@endforeach
				</div>
		</div>
	</div>
@endforeach	