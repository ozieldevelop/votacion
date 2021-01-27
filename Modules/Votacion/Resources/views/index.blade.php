@extends('layouts.custom')

@section('content')

   <main class="main">
			<section id="cover" class="min-vh-200">
			  <div id="cover-caption">
				  <div class="container">
					  <div class="row" style="display:none">

					  </div>
					  <div class="row text-white">
					  

					  </div>
				  </div>
			  </div>
		  </section>

		  <div class="container-fluid">
			  <div class="animated fadeIn">
					
					<label style="color:black;font-weight: bold;">{{ $nombreevento }} </label>
					@if($tipoevent == 1)
					<label style="color:red;font-weight: bold;"> L&iacute;mite  {{ $max_votos }} de votos  </label>
					@endif
			  
			  		<div class="row DirectivosDir">





							
							
							
							
							

				</div>	
				
				
				
			</div>	
		  <div class="row col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col text-center">
			  <button class="btn btn-primary" onclick="siguientepaso()" style="height:130px;width: 80%;font-size:34px">SIGUIENTE</button>
			</div>
			
			
			<div id="output">

</div>	

		  </div>
		  
		  
		  
		</div>

	</main>
	
    <aside class="aside-menu">

      <ul class="nav nav-tabs" role="tablist">


      </ul>

      <!-- Tab panes -->
      <div class="tab-content">

        <div class="tab-pane active" id="timeline" role="tabpanel">

          <hr class="transparent mx-3 my-0">
          <div class="callout callout-warning m-0 py-3 list-type1">
        
				  <pre><code id="jsonPapeletas" ></code></pre>

				  <div  class="chat__messages ">
					<ol id="contenedorAspirantes" style="">
						
					</ol>

				  </div>
				  <br/><br/><br/><br/><br/><br/><br/><br/><br/>
          </div>
         
          <hr class="mx-3 my-0">

        </div>

      </div>
	    </aside>

</div>
  
@endsection

@section('page-script')

<style>
.seleccionadocard{
	border: solid 8px;
	border-color:#a0d08d;
	background: #9fb176;
}

.noseleccionadocard{
	border: 1px solid #4dceff;
	background: 'none';
}

.seleccionadocard .card-body {
	color: white;
}

.noseleccionadocard .card-body {
	color: black;
}

</style>

<script>
var Papeletas = []; 
var datosSeleccionado = null;
var max_votos = 0;
var datos='';
var aspirtantesall = '';

$(function () {

      $.ajax({
        url: '{{ url("votacion/verificaparticipacion")}}'
        , method: 'GET'
        , success: function(result){
				if(result>0)
					{
						location.href = '{{ url("votacion/contenedordetalle")}}';
					}
        }
      });

});


$(function () {
    var elfiltro = $("#elfiltro");

    elfiltro.keydown(function (event) {
        keyReport(event);
    });

    elfiltro.keypress(function (event) {
        keyReport(event);
    });

    elfiltro.keyup(function (event) {
        keyReport(event);
    });

    elfiltro.focusout(function (event) {
        //theOutputFocusOut.html(".focusout() fired!");
    });

    elfiltro.focus(function (event) {
        //theOutputFocusOut.html(".focus() fired!");
    });

    function keyReport(event) {
        // catch enter key = submit (Safari on iPhone=10)
        if (event.which == 10 || event.which == 13) {
            event.preventDefault();
        }
        // report invisible keys  
        switch (event.which) {
            case 0:
                //output.append("event.which not sure");
                break;
            case 13:
                //output.append(" Enter");
                break;
            case 27:
                //output.append(" Escape");
                break;
            case 35:
                //output.append(" End");
                break;
            case 36:
                //output.append(" Home");
                break;
        }
        // show field content
        //theOutputText.text(elfiltro.val());
        PapeletasFiltradas(elfiltro.val());
        //console.log(elfiltro.val());
    }

});



function avatardisplayFn(id,id_area,areaetiqueta)
{

	
  Swal.fire({
    position: 'center',
    icon: 'info',
    title: 'Agregando Selección',
    showConfirmButton: false,
	allowOutsideClick: false,
    timer: 34500
  })
  
    //console.log(id+'  '+id_area+'  '+areaetiqueta);
	//pintarpapeletas();
	var claseactual = $('#papeletacard_'+id+'_'+id_area).attr('class');
	//alert(claseactual);
	
	
	if(claseactual=='card')
	{


			
			@if(Session::get('tipoevent')==1)
			
			  $.ajax({
				url:'{{ url("votacion/limitevotos")}}'     
				, method: 'GET'
				, success: function(result){
					datos = result;
					limitevotos = (datos[0].maxvotos)-1;			
						if(Papeletas.length <= limitevotos){
							
			@endif	
					var tempcodcliente = parseInt(id);

					
					var TodosValoresEntrados = $.grep(Papeletas, function (n, i) {
								return (n.id_delegado == tempcodcliente && n.id_area == id_area );
					});

					if(TodosValoresEntrados.length<=0)
					{
								  var a01 = tempcodcliente;
								  terminar_espere();	
								  newVoto(a01,id_area,areaetiqueta);
								
					}
					else{
					  terminar_espere();
					  lobibox_emergente('info','top right',true,'Ya realiz&oacute; esta selecci&oacute;n');
					}
					
			@if(Session::get('tipoevent')==1)
			  }
			  else{
					  terminar_espere();
					  //lobibox_emergente('warning','top right',true,'Ya has utilizado tu cantidad m&aacute;xima de votos; elimina alguno si deseas relamente esta opci&oacute;n');
					  Swal.fire({
						position: 'center',
						icon: 'warning',
						title: 'Ya has utilizado tu cantidad m&aacute;xima de votos; elimina alguno si deseas relamente esta opci&oacute;n',
						showConfirmButton: false,
						allowOutsideClick: true,
						timer: 34500
					  })					  
			  }
			    }
				});
			@endif
		
	}
	else
	{
		terminar_espere();	
		//console.log(Papeletas);
		
		
		/*
		var Papeletasa = $.grep(Papeletas, function (n, i) {
				return (n.id_delegado != id && n.id_area != id_area );
		});
		*/
		
		for (ii=0;ii<=Papeletas.length-1;ii++){
	
			if(Papeletas[ii].id_delegado == id && Papeletas[ii].id_area == id_area )
			{

				//console.log(Papeletas[ii]);
				//console.log(ii);
				deleteRow(ii);

				return false;
			}
			
		}
		
		

	}
	    

}


function siguientepaso()
	{
  if(Papeletas.length==0){
    lobibox_emergente('warning','top lef',true,'Debe seleccionar almenos un voto!');
  }
  else{
         //var terminal = localStorage.getItem("prm_name");
        //localStorage.setItem("Papeletas",Papeletas);
        //max_votos
        //console.log(terminal);
        location.href = '{{ url("votacion/previa")}}';
  }
}

function blanqueofiltro()
{
	//alert(papelesoriginales);
	$('#elfiltro').val('');
	PapeletasFiltradas( '' );
	
}

function deleteRow(indice)
	{
		
	var claseactual =$('#papeletacard_'+Papeletas[indice].id_delegado+'_'+Papeletas[indice].id_area).attr('class');

	if(claseactual=='card' || claseactual=='card noseleccionadocard' )
	{
		$('#papeletacard_'+Papeletas[indice].id_delegado+'_'+Papeletas[indice].id_area).attr('class','card seleccionadocard');
		
	}
	else
	{
		$('#papeletacard_'+Papeletas[indice].id_delegado+'_'+Papeletas[indice].id_area).attr('class','card');
	}


	
    var dfc = $.when(Papeletas.splice(indice, 1), visualizarselecciones()).done(function(){
         localStorage.setItem("lasboletas{{ $ideven }}",JSON.stringify (Papeletas));
		 renderizarselecciones();	
    });  

}

/*
function PapeletasFiltradas(textolike){

      $.ajax({
        url: '{{ url("votacion/gruposvoletasfiltradas")}}'
        , data: { buscando: textolike}
        , method: 'GET'
        , success: function(result){

				  var datoz = result;

				  $('.DirectivosDir').html(datoz);
				  

	
	
        }
      });
}
*/


function PapeletasIniciales(textolike){

		//console.log(textolike);
  Swal.fire({
    position: 'center',
    icon: 'info',
    title: 'Cargando Aspirantes',
    showConfirmButton: false,
	allowOutsideClick: false
  })
  
        $.ajax({

        url: '{{ url("votacion/coopexe4")}}'     

        , data: { buscando: textolike}

        , method: 'GET'

        , success: function(result){
				 aspirtantesall = result;
				 
				 	//document.getElementById('output').innerHTML = JSON.stringify( aspirtantesall, null, '   ' );
				//console.log(Papeletas);
				if(Papeletas.length<=0){	
					var datoz = result;
				}
				else{
					 var datoz = Papeletas;
				}
				//console.log(datoz);
				//return false;

                var html = '';
                var elavatar = '';
				var titulo = '';
				for (var aa = 1; aa < 5; aa++)
				{

					//console.log(aa);
					
					var datosencabezado = $.grep(datoz, function (n, i) {
								return (n.id_area == aa );
					});
					
					//console.log(datosencabezado);
					
					if(datosencabezado.length>0)
					{
				
							if(aa==1){
								titulo ='Delegados';
							}else if(aa==2){
								titulo ='Junta de Directores';
							}else if(aa==3){
								titulo ='Junta de Vigilancia';
							}else if(aa==4){
								titulo ='Comite de Crédito';
							}

							
						html += '<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 our-team"><div class="card "><div class="card-header bg-info" style="text-align: center;"><b>';
						html += titulo + ' <br/> (Selecciones : <label id="totales_'+  aa  +'"> '+0+'</label> )</b> </div><div class="row">';
						
	
						for (var ii = 0; ii < datosencabezado.length; ii++)
						{
							//console.log(datosencabezado[ii]);

							if( datosencabezado[ii]['foto'] === undefined || datosencabezado[ii]['foto'] === null )
							{
								elavatar = "./images/logo-footer.png";
							}
							else
							{
								elavatar = datosencabezado[ii]['tipo']+"base64,"+datosencabezado[ii]['foto'];
							}   
							

							html +=" <div class='cuadritovotante col-12 col-xs-12 col-sm-12 col-md-4 col-lg-3' style='cursor:pointer' ";
							
							var aa1 =datosencabezado[ii]['id_delegado'];
							var aa2 =datosencabezado[ii]['id_area'];
							var aa3 ='"'+ titulo+'"';
							
							html +=" onclick='avatardisplayFn( " + (aa1) +" ," + (aa2) +" ," + (aa3) +"  )' " ;

							html +="><div class='card' id='papeletacard_"+datosencabezado[ii]['id_delegado']+"_"+datosencabezado[ii]['id_area']+"'><div class='card-header' style='background:#97a37b;text-align: center;color:white;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]['num_cliente']+"</div><div class='card-body' id='collapseExample' style='text-align: center;'>";
							@if($tipoevent == 2)
								html +="<img   class='img-fluid rounded-circle mx-auto d-block avatardisplay' id='img_"+datosencabezado[ii]['id_delegado']+"' style='background: #7e977e;width: 154px;height:155px;cursor:pointer' src='"+elavatar+"'>";
							@endif
								html +="<p style='text-align: center;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]["nombre"]+"</p><p style='text-align: center;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]["apellido"]+"</p><p style='text-align: center;font-size: 17px;'>"+titulo+"</p></div></div></div>";


						}
						html += '</div></div></div>';

					}
				//console.log('-------');
					
				}
        $('.DirectivosDir').html(html);
		renderizarselecciones();
		     terminar_espere();  
     }

   });

          

}




function PapeletasFiltradas(textolike)
{
	
				textolike =  textolike.toLowerCase()
  
				//console.log(aspirtantesall);
				
            	var result = $.grep(aspirtantesall, function (n, i) {
								var valor1 = n.nombre.toLowerCase();
								var valor2 = n.apellido.toLowerCase();
								var valor3 = n.num_cliente.toString().toLowerCase();
						return ( valor1.includes(textolike) || valor2.includes(textolike) || valor3.includes(textolike));
				});
				
				
				/*
				var result = $.grep(aspirtantesall, function (n, i) {
								return (n.nombre == textolike  );
				});
				*/
				 
				//console.log(result);
				//console.log(result);
				
                var datoz = result;
				//console.log(datoz);

                var html = '';
                var elavatar = '';
				var titulo = '';
				for (var aa = 1; aa < 5; aa++)
				{

		
					
					var datosencabezado = $.grep(datoz, function (n, i) {
								return (n.id_area == aa );
					});
					
					//console.log(datosencabezado);
					
					if(datosencabezado.length>0)
					{
				
							if(aa==1){
								titulo ='Delegados';
							}else if(aa==2){
								titulo ='Junta de Directores';
							}else if(aa==3){
								titulo ='Junta de Vigilancia';
							}else if(aa==4){
								titulo ='Comite de Crédito';
							}

							
						html += '<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 our-team"><div class="card "><div class="card-header bg-info" style="text-align: center;"><b>';
						html +=  titulo + '<br/> (Selecciones : <label id="totales_'+  aa  +'">'+0+'</label> ) </b></div><div class="row">';
						
	
						for (var ii = 0; ii < datosencabezado.length; ii++)
						{
							//console.log(datosencabezado[ii]);

							if( datosencabezado[ii]['foto'] === undefined || datosencabezado[ii]['foto'] === null )
							{
								elavatar = "./images/logo-footer.png";
							}
							else
							{
								elavatar = datosencabezado[ii]['tipo']+"base64,"+datosencabezado[ii]['foto'];
							}   
							

							html +=" <div class='cuadritovotante col-12 col-xs-12 col-sm-12 col-md-4 col-lg-3' style='cursor:pointer' ";
							
							var aa1 =datosencabezado[ii]['id_delegado'];
							var aa2 =datosencabezado[ii]['id_area'];
							var aa3 ='"'+ titulo+'"';
							
							html +=" onclick='avatardisplayFn( " + (aa1) +" ," + (aa2) +" ," + (aa3) +"  )' " ;

							html +="><div class='card' id='papeletacard_"+datosencabezado[ii]['id_delegado']+"_"+datosencabezado[ii]['id_area']+"'><div class='card-header' style='background:#97a37b;text-align: center;color:white;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]['num_cliente']+"</div><div class='card-body' id='collapseExample' style='text-align: center;'>";
							@if($tipoevent == 2)
							html +="<img   class='img-fluid rounded-circle mx-auto d-block avatardisplay' id='img_"+datosencabezado[ii]['id_delegado']+"' style='background: #7e977e;width: 154px;height:155px;cursor:pointer' src='"+elavatar+"'>";
							@endif 
							html +="<p style='text-align: center;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]["nombre"]+"</p><p style='text-align: center;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]["apellido"]+"</p><p style='text-align: center;font-size: 17px;'>"+titulo+"</p></div></div></div>";


						}
						html += '</div></div></div>';

					}
				//
					
				}
				//console.log(html);
        $('.DirectivosDir').html(html);
		renderizarselecciones();

}





function visualizarselecciones()
	{
  return $.Deferred(function(df){ df.resolve();
    var html ='';
    var conteo = 0;
    $("#contenedorAspirantes").html(html);
	
	/*
	var Papeletastex = JSON.parse(localStorage.getItem("lasboletas{{ $ideven }}"));
	console.log(Papeletastex);

	if(Papeletastex.length>0){
			
		Papeletas = JSON.parse(localStorage.getItem("lasboletas{{ $ideven }}"));

	}	*/

	
    $.each(Papeletas, function (index, item) {
      html += "<li>" ;
  
          html += "<a href='#' onclick='deleteRow("+conteo+")'>"+ item.area +" </br> "+ item.nombre +"  " + item.apellido + "</a>";
  
      html+="</li>";
      conteo++;
  });
    $("#contenedorAspirantes").append(html);

    if(Papeletas.length>=0){
      $('#contadorSeleccionados').html('('+Papeletas.length+')'); 
    }
    else
    {
      $('#contadorSeleccionados').html('( 0 )'); 
    }
  }).promise();  
}

function renderizarselecciones(){
		visualizarselecciones();
		votosxarea();	
		pintarpapeletasall();
}

function newVoto(dato,id_area,area)
{
	$('#papeletacard_'+dato+'_'+id_area).attr('class','card seleccionadocard');

      $.ajax({
        url:  '{{ url("votacion/coopexe2")}}'
        , data: { indice: dato }
        , method: 'GET'
        , success: function(result){
			   var datoz = result;
				  Papeletas.push({ "id_delegado": datoz[0].id_delegado,"num_cliente": datoz[0].num_cliente,"nombre": datoz[0].nombre,"apellido": datoz[0].apellido,"id_area": id_area,"area":area   });
				  localStorage.setItem("lasboletas{{ $ideven }}",JSON.stringify (Papeletas));
				  renderizarselecciones();
        }
      });

}

function pintarpapeletasall()
{

	/*
	var Papeletastex = JSON.parse(localStorage.getItem("lasboletas{{ $ideven }}"));
	console.log(Papeletastex);

	if(Papeletastex.length>0){
			
		Papeletas = JSON.parse(localStorage.getItem("lasboletas{{ $ideven }}"));

	}	*/
	
    $.each(Papeletas, function (index, item) {
     // $('#papeletacard_'+item.id_delegado+'_'+item.id_area).css('border','solid 4px black');
	  $('#papeletacard_'+item.id_delegado+'_'+item.id_area).css('cursor','pointer');
	  
	  $('#papeletacard_'+item.id_delegado+'_'+item.id_area).attr('class','card seleccionadocard');
		
	});

}

function pintarpapeletas(id_delegado,id_area)
{
	//console.log(id_delegado+'_'+id_area);
	var claseactual = $('#papeletacard_'+id_delegado+'_'+id_area).attr('class');
	if(claseactual=='card')
	{
		$('#papeletacard_'+id_delegado+'_'+id_area).attr('class','card seleccionadocard');
		
	}
	else
	{
		$('#papeletacard_'+id_delegado+'_'+id_area).attr('class','card');
	}
	
	renderizarselecciones();
}


function votosxarea()
{
	
	for (var aa = 1; aa < 5; aa++)
	{
		//console.log(Papeletas);
		var datosencabezado = $.grep(Papeletas, function (n, i) {
			return (n.id_area == aa );
		});

		
		if(datosencabezado.length>0)
		{
			
			$('#totales_'+aa).html(datosencabezado.length);				
		}
		else{
			$('#totales_'+aa).html(0);	
		}

	}

}


  $(document).ready(function(){

		if(isMobile.mobilecheck() == false){
				$('.navbar-toggler').trigger( "click" );
			
		}	

	//var cat = localStorage.getItem('xccok');
	//	


	localStorage.setItem("lasboletas{{ $ideven }}",[]);
	
	console.log(Papeletas);
	PapeletasIniciales('');
	//pintarpapeletas();
		
  });
  
</script>

@stop