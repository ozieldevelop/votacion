<!--extends('votacion::layouts.master')-->

@extends('layouts.laadvertencia')

@section('content')

<div class="row">
	 <div class="col-md-12">
	   
				{!! $mensaje !!}
		<br/><br/>
	</div>
</div>


<script>

localStorage.setItem("lasboletas{{ $ideven }}",[]);




</script>




		  <div class="container-fluid">
			  <div class="animated fadeIn">

							@foreach ($areas as $pape)
									<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 our-team"> 
										<div class="card ">
																	<div class="card-header" style="background:#009640;text-align: center;color:white;font-size: 33px;font-weight: bold;">
																	 {{$pape->voto_area_etiqueta }}
																	</div>
											<div class="row">
													@foreach ($detalles as $dataaspirante)
														@if($pape->voto_id_area == $dataaspirante->voto_id_area)
														<div  class="cuadritovotante col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12" style="cursor:pointer"  >
																<div class="card" >

																	<div class="card-body " id="collapseExample" style="text-align: center;">
																	  <p style="text-align: center;font-size: 24px;font-weight: bold;">   {{ substr($dataaspirante->voto_apellido, 0, 10) }} , {{ substr($dataaspirante->voto_nombre, 0, 10)  }}  , {{ substr($dataaspirante->voto_aspirante, 0, 10)  }} </p>

																	</div>
																</div>
														</div>
														@endif
													@endforeach
											</div>
										</div>
									</div>				
						    @endforeach	

			</div>
		</div>
@endsection
