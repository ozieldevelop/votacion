@extends('cliente::ordenpalabra.layout.template')

@section('header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Tiempo para hablar del Tema<small>Se estará llevando el tiempo</small></h1>
</section>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        
        <div class="panel panel-primary">
            <div class="panel-heading">Tiempo transcurrido <i class="fa fa-clock-o"></i></div>

            <div class="panel-body">
            	<form method="POST" action="" class="form-horizontal" role="form">
                @csrf()

                <div class="container">
                	<div class="row">
                		<div class="form-group">
                			<label for="duracion" class="col-lg-4 control-label">Duración:</label>
	                        <div class="col-lg-2">
	                			<input type="number" name="duracion" class="form-control" placeholder="minutos" id="duracion" max="10" min="0">
	                		</div>
	                		<div class="col-lg-4">
	                			<button class="btn btn-success">Agregar tiempo</button>
	                		</div>
	                	</div>
                	</div>
                </div>
            	</form>
            	<p id="demo" style="font-size: 100px;font-weight: bold;text-align: center;color: red;"></p>
            </div><!-- end panel-body -->
        </div>
    </div>
</div> <!-- end row -->
@endsection

@push('pluginjs')
	<script>
		(function ($) {
            "use strict";

             var token = $('form').find( 'input[name=_token]' ).val();
             
             var endTime = '{{ $sEndTime }}';

			// Update the count down every 1 second
			var x = setInterval(function() {

				$.post('{{ url("ordenpab/traking")}}', { _token: token, end_time: endTime}, function(data) {
                    
                    document.getElementById("demo").innerHTML = data;
                    
                    if (data == '00:00:00') {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "00:00:00";
                    }
                })
                .done(function(infod) {})
                .fail(function(info) {
                    console.log('erro '+JSON.stringify(info) );
                });
		      }, 1000);
        })(jQuery);
    </script>
@endpush