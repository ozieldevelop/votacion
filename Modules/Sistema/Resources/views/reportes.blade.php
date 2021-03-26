@extends('layouts.dashboard')

@section('content')

<style>
    body{    
    font-family: 'Roboto Condensed', sans-serif;
        background-image: url(testmonial-bg.jpg);
        height: 100vh;
        background-size: cover;
        
    
}

  .our-team{
    padding: 30px 0 40px;
    background: #f7f5ec;
    text-align: center;
    overflow: hidden;
    position: relative;
      margin-top: 220px;
      
}
.our-team .pic{
    display: inline-block;
    width: 130px;
    height: 130px;
    margin-bottom: 50px;
    z-index: 1;
    position: relative;
}
.our-team .pic:before{
    content: "";
    width: 100%;
    height: 0;
    border-radius: 50%;
    background: #8aa98f;
    position: absolute;
    bottom: 135%;
    right: 0;
    left: 0;
     opacity: 0.9;
    transform: scale(3);
    transition: all 0.3s linear 0s;
}
.our-team:hover .pic:before{ height: 100%; }
.our-team .pic:after{
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: #8aa98f;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}
.our-team .pic img{
    width: 100%;
    height: auto;
    border-radius: 50%;
    transform: scale(1);
    transition: all 0.9s ease 0s;
}
.our-team:hover .pic img{
    box-shadow: 0 0 0 14px #f7f5ec;
    transform: scale(0.7);
    
}
.our-team .team-content{ margin-bottom: 30px; }
.our-team .title{
    font-size: 16px;
    font-weight: 700;
    color: #4e5052;     
    text-transform: capitalize;
    margin-bottom: 5px;
}
.our-team .post{
    display: block;
    font-size: 15px;
    color: #4e5052;
    text-transform:capitalize;
}
.our-team .social{
    width: 100%;
    padding: 0;
    margin: 0;
    background: #8aa98f;
    position: absolute;
    bottom: -100px;
    left: 0;
    transition: all 0.5s ease 0s;
}
.our-team:hover .social{ bottom: 0; }
.our-team .social li{ display: inline-block; }
.our-team .social li a{
    display: block;
    padding: 10px;
    font-size: 17px;
    color: #fff;
    transition: all 0.3s ease 0s;
    text-decoration: none;
}
.our-team .social li a:hover{
    color: #8aa98f;
    background: #f7f5ec;
}
@media only screen and (max-width: 990px){
    .our-team{ margin-bottom: 30px; }
}  
</style>

	<div class="row ">
      		<div class="col-md-12">
						
						
	<div class="row ">
	   <div class="form-group col-sm-12 col-md-12 col-lg-12 ">
		<label for="inputevento">Seleccione Evento</label>
		<select id="eventos" class="form-control col-sm-12 col-md-12 col-lg-12" onchange="Cargar(this.value)" >
							<option value=""> -- Elegir</option>
							@foreach ($eventos as $dataeventos)
								<option value="{{ $dataeventos->id }}">{{ $dataeventos->nombre }}</option>
							@endforeach
		</select>
	  </div> 
	</div>
	


	 <div id="mydiv">
        <iframe id="frame" src="" width="100%" height="800">
        </iframe>
    </div>	  

	
	
  </div>  
  </div>
  
  
  
@endsection

@section('page-script')

<script>


function Cargar(dato)
{	
	espere('Cargando');
	var eleccion = $('#eventos').val();			
	$("#frame").attr("src", '{{ url("sistema/viewreporte")}}?id_evento='+eleccion );
	terminar_espere()
}

  function ocultarfooter(){
    $('.footer').css('display','none');
  }
  
  
 $(document).ready(function () { 
 
    ocultarfooter();
});

  
</script>


@stop