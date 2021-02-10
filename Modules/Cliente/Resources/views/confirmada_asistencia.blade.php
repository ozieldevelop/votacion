@extends('cliente::layouts.master')


@section('content')

<div class="row">

</div>

        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">

        <div class="col-sm-12 col-md-12 col-lg-12">
	   
	              {!! $mensaje !!}

	      </div>
                
                <h3 class="profile-username text-center">{{ $nombreevento }}</h3>

                <p class="text-center"> </p> <p class="text-muted text-center">DIA DEL EVENTO {{ $f_inicia }}</p>

                <a type="button" href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block btn-success" >INGRESAR EN PANEL</a>
        
              </div>
            </div>
       </div> 






@endsection

  
@section('page-script')

<script>

  $( document ).ready(function() {
  
    
  });     
  
</script>
@stop	   
  




