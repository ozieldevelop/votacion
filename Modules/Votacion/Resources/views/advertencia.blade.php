<!--extends('votacion::layouts.master')-->

@extends('layouts.laprevia')

@section('content')

<div class="row">
	 <div class="col-md-12">
	   
				{!! $mensaje !!}

	</div>
</div>


<script>

localStorage.setItem("lasboletas{{ $ideven }}",[]);

</script>

@endsection
