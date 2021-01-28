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



setTimeout(function(){ window.location.href = 'http://www.cooprofesionales.com.pa' ; }, 3000);

localStorage.setItem('coopesisvot{{ $ideven }}','1');

</script>

@endsection
