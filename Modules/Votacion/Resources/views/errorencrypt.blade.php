@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="jumbotron" style="background-color:#fff5e3">
                <h1 class="display-4">Link no v&aacute;lido.</h1>
                <p class="lead">Debe regresar a la votación o consultar con el administrador de la plataforma.</p>
                <hr class="my-4">
                <!--p class="lead">
                    <a class="btn btn-success btn-lg" href="#" role="button" onclick="atras()">Regresar</a>
                </p-->

              </div>
        </div>
    </div>
</div>
<script>
    function atras(){
        window.history.back();
    }
</script>
@stop
b