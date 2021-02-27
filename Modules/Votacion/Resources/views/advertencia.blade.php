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



setTimeout(function(){ window.location.href = '{{ url("votacion/")}}?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}' ; }, 5000);

localStorage.setItem('coopesisvot{{ $ideven }}','1');

</script>

@endsection
