@extends('layouts.login')

@section('content')





<div class="col-12">            
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title"> {{ $nombreevento }} </h4>
              </div>
              <div class="card-body ">
         
              <div style="width:100%" id="output">
                  &nbsp;
              </div>
  
    
              </div>
              
              </div>
</div>









@endsection

  
@section('page-script')


    <script>
      
    
  var modelo = {
    'id_evento':'{{ $id_evento }}',
    'nombre_evento':'{{ $nombreevento }}',
    'f_inicia':'{{ $f_inicia }}',
    'f_termina':'{{ $f_termina }}',
    'num_cliente':'{{ $num_cliente }}',
    'ocupacion':'{{ $ocupacion }}',
    'profesion':'{{ $profesion }}',
    'trato':'{{ $trato }}',
    'nombre':'{{ $nombre }}',
    'agencia':'{{ $agencia }}',
    'asistire':'',
    'f_asistire_regis':'',
    'soy_aspirante':''
  };
      

cargarperfil();
      
 function cargarperfil()
 {
   
   var aaaa =  JSON.stringify(modelo,undefined,2);
   
   $('#output').html(aaaa);
 }  
      
      
      
</script>



<script>

</script>


@stop	   
  



