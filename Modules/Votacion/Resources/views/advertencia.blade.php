<!--extends('votacion::layouts.master')-->

@extends('layouts.laadvertencia') 

@section('content')

<div class="row">
	 <div class="col-md-12">
	   
				{!! $mensaje !!}

	</div>
</div>


<script>

localStorage.setItem("lasboletas{{ $ideven }}",[]);



setTimeout(function(){ window.location.href = 'https://www.cooprofesionales.com.pa/' ; }, 5000);

localStorage.setItem('coopesisvot{{ $ideven }}','1');

</script>

@endsection
