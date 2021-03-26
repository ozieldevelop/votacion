@extends('layouts.dashboard')

@section('content')


<div class="row ">
						<div class="col-md-4">
              <a class="col-md-12 btn btn-block btn-primary btn-flat" href="{{ url("sistema/vistaenviocapitular")}}">
                      CAPITULAR
              </a>
            </div>
						<div class="col-md-4">
              <a class="col-md-12 btn btn-block btn-primary btn-flat" href="{{ url("sistema/vistaenvioasamblea")}}">
                      ASAMBLEA
              </a>              
            </div>
						<div class="col-md-4">
              <a class="col-md-12 btn btn-block btn-primary btn-flat" href="{{ url("sistema/vistaenviosoporte")}}">
                      GENERACION DE ENLACES 
              </a>              
            </div>  
</div>
<br/>


@endsection



@section('page-script')

	

@stop

