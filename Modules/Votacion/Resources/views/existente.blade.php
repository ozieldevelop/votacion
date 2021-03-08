<!--extends('votacion::layouts.master')-->

@extends('layouts.laadvertencia') 

@section('content')

<div class="row">
	 <div class="col-md-12">
	   
                	{!! $mensaje !!}

	</div>
</div>


<script>


setTimeout(function(){ window.location.href = 'https://www.cooprofesionales.com.pa/' ; }, 5000);



</script>

@endsection
