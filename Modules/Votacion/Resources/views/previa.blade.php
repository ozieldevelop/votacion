@extends('layouts.laprevia')

@section('content')

	<style>
      @font-face 
      {
        font-family: "Ordinary";
        src: url('../../fonts/big_noodle_titling.ttf');
		    font-size:24px;
      }
	</style>
	



	<div class="row">
					<label style="color:black;font-weight: bold;margin-left: 17px;font-size:19px">Valide sus votos en esta pantalla.  Si desea corregir, de CLIC al bot&oacute;n REGRESAR. Para confirmar sus votos, de CLIC al bot&oacute;n VOTAR.</label>

			        <div class="col-md-12 DirectivosDir">
  

                            
					</div>  
  
	</div>
	
	<div class="row col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col text-center">
				  <div class="  d-flex justify-content-center" style="margin-left: 37px;">
				  <button type="button" class="btn btn-secondary" onclick="regresar()" id="botonregresar"  style="height:70px; col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 font-size:34px;    width: 178px;">REGRESAR</button>	&nbsp;&nbsp;&nbsp;			  
				  <button type="button" class="btn btn-primary" onclick="imprimir()" id="botonimprimir" style="height:70px;col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 font-size:34px;    width: 178px;">VOTAR</button>

				  </div>
			</div>
	</div>


@endsection
@section('page-script')

<script src="../../js/printThis.js"></script>
 <link rel="stylesheet" href="{{ asset('css/lolibox.css') }}">
<script src="{{ asset('js/lobibox.js') }}"></script>
 
 
<script>

  
function imprimir()
{

  var lasPapeletasStorage = localStorage.getItem("lasboletas{{ $id_evento }}")  || [];
  lasPapeletasStorage = JSON.parse(lasPapeletasStorage);      
  
  console.log(lasPapeletasStorage.length);

  
  
	 if( lasPapeletasStorage.length <=0)
    {

                      $.ajax({
                        url: '{{ url("votacion/coopexe33")}}'  
                        , data: { 'campos': JSON.stringify(lasPapeletasStorage) }
                        , method: 'post'
                        , headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result){
                              Lobibox.notify('info', {
                                msg: 'Gracias por su voto.'
                              });		
                              //localStorage.setItem('sysvot {{! Session::get('idevendesc') }}', '1');
                            setTimeout(function(){ window.location.href = '{{ url("votacion/")}}?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}' ; }, 1000);
                            //setTimeout(function(){ window.location.href = '{{ url("votacion/")}}?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}' ; }, 1000);
                              //setTimeout(function(){ location.reload();  }, 2000);
                        },
                        error: function (r) {
                            console.log("ERROR");
                            console.log(r);
                        }
                      });
    }
    else
    {   
      
      

                      $.ajax({
                        url: '{{ url("votacion/coopexe3")}}'  
                        , data: { 'campos': JSON.stringify(lasPapeletasStorage) }
                        , method: 'post'
                        , headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result){
                              Lobibox.notify('info', {
                                msg: 'Gracias por su voto.'
                              });		
                              //localStorage.setItem('sysvot {{! Session::get('idevendesc') }}', '1');
                            setTimeout(function(){ window.location.href = '{{ url("votacion/")}}?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}' ; }, 1000);
                            //setTimeout(function(){ window.location.href = '{{ url("votacion/")}}?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}' ; }, 1000);
                              //setTimeout(function(){ location.reload();  }, 2000);
                        },
                        error: function (r) {
                            console.log("ERROR");
                            console.log(r);
                        }
                      });

    }

}

  
function regresar(){
	console.log('regresar');
	//location.href = '{{ url("/")}}';
	window.history.back();
}


var lasPapeletas='';
  
  
function GetSortOrder(prop) {    
    return function(a, b) {    
        if (a[prop] > b[prop]) {    
            return 1;    
        } else if (a[prop] < b[prop]) {    
            return -1;    
        }    
        return 0;    
    }    
}    
    

  
  
function visualizarselecciones()
	{  		
	
	var contenedor = localStorage.getItem("lasboletas{{ $id_evento }}");
	if( contenedor.length <=0)
	{
			location.reload();
			window.history.back();
	}
	else
	{
			lasPapeletas = JSON.parse(localStorage.getItem("lasboletas{{ $id_evento }}"));
			$.ajax({
			 url: '{{ url("votacion/categoriaslist") }}' 
			, data: { 'campos': JSON.stringify(lasPapeletas) }
			, method: 'get'
			, success: function(result)
			{
				var html = '';
				$(".DirectivosDir").html(html);
				for (var ii = 0; ii < result.length; ii++)
				{  
					var TodosValoresEntradostemp = $.grep(lasPapeletas, function (n, i) {
						return (n.id_area == result[ii].id_area );
				});


          TodosValoresEntradostemp = TodosValoresEntradostemp.sort(GetSortOrder("apellido"));
          
					if((TodosValoresEntradostemp.length) >0){
						
						  html += "<div class='col-md-12 d-flex justify-content-center' ><div class='list-group  col-md-6'><a href='#' class='list-group-item list-group-item-action active' style='font-size:22px;'><i class='fa-shield '></i> "+ result[ii].nombrearea +"</a>";	
		
						  for (var i = 0; i < TodosValoresEntradostemp.length; i++){  

							html += "<label style='font-size: 18px;margin-top: 18px;'><i class='fa fa-book fa-fw' aria-hidden='true'></i> "+ TodosValoresEntradostemp[i].apellido + ", &nbsp;"  + TodosValoresEntradostemp[i].nombre+ ",&nbsp;" + TodosValoresEntradostemp[i].num_cliente+" </label>";
							
							@if($tipo == 2)
								var iddel = (TodosValoresEntradostemp[i].id_delegado);
							    var valoresfiltro = $.grep(losaspirantes, function (n, i) {
											return (n.id_delegado == iddel );
								});		
								
								if(valoresfiltro.length<0)
								{
									elavatar = "../../images/empty_gray.png";
								}
								else
								{
									elavatar = "../../adjuntos/"+valoresfiltro[0]['foto'];
								} 

								html +="<img   class='img-fluid  mx-auto d-block avatardisplay' style='border:solid 2px #c5c5c5;margin-right: unset !important;margin-top: -47px;width: 90px;height:90px;cursor:auto' src='"+elavatar+"'>";

							@endif 							

						  }
						  html+="</div>";  
					}
				  html+="</div><br/>";  
				}

				$('.DirectivosDir').html(html);
			}
		  });
	}
}
	var losaspirantes = '';
	
$( document ).ready(function() 
{

	visualizarselecciones();
	losaspirantes = JSON.parse(localStorage.getItem("aspirantes{{ $id_evento }}")); 
	  
});	

</script>
@stop
