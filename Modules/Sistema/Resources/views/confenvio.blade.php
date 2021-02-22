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


@endsection



@section('page-script')

	

@stop

