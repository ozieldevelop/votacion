<!--extends('votacion::layouts.master')-->

@extends('layouts.laadvertencia') 

@section('content')

<div class="row">
	 <div class="col-md-12">
	   
                <div class='col-xs-4 text-center' style='vertical-align: middle;'><h3>Notificaci&oacute;n</h3></div>
                <div class='col-xs-4 text-center' style='vertical-align: middle;'>Ya su registro se encuentra en nuestra base de datos !</div>

	</div>
</div>


<script>


setTimeout(function(){ window.location.href = 'https://www.cooprofesionales.com.pa/' ; }, 5000);



</script>

@endsection
