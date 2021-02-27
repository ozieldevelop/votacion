@extends('votacion::layouts.custom_votacion')

@section('content')


            <div class="chat-room">
               <br/>
               <aside class="tengah-side">
                  <div class="animated fadeIn">
                     <br/>
                     <div class="row">
                        <div class="col-lg-12">
                          <div class="DirectivosDir"></div>
                        </div>
               </aside>
                   <aside class="kanan-side" style="">


                        <div  class="chat__messages ">
                            <ol id="contenedorAspirantes" ></ol>
                        </div>


                   </aside>
                   </div>
            </div>
        </div>
        

@endsection

@section('page-script')




        
<script>
        
var Papeletas = []; 
var datosSeleccionado = null;
var max_votos = 0;
var datos='';
var aspirtantesall = '';

  @if($mododeveloper>0)
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
  @endif


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
          //var aaa= JSON.stringify(Papeletas);
          Papeletas = Papeletas || [];
						if(Papeletas.length <= limitevotos){
							
			@endif	
					var tempcodcliente = parseInt(id);
          //var aaa= JSON.stringify(Papeletas);
          Papeletas = Papeletas || [];
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
						title: 'Ha alcanzado la cantidad m&aacute;xima de votos para este tipo de votaci&oacute;n',
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
    lobibox_emergente('warning','top lef',true,'Debe seleccionar al menos un voto!');
  }
  else{
         //var terminal = localStorage.getItem("prm_name");
        //localStorage.setItem("Papeletas",Papeletas);
        //max_votos
        //console.log(terminal);
        location.href = '{{ url("votacion/previa/")}}?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}';
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
				 localStorage.setItem("aspirantes{{ $ideven }}",JSON.stringify (aspirtantesall));

				 	//document.getElementById('output').innerHTML = JSON.stringify( aspirtantesall, null, '   ' );
				Papeletas = Papeletas || [];
				if(Papeletas.length<=0){	
					var datoz = result;
				}
				else{
					 var datoz = Papeletas;
				}
				var datoz = result;
				//console.log(datoz);
				//return false;

                var html = "<div class=' our-team' style='border:none'><div class='card' style='border:none'><div class='row gallery'>";
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
								titulo ='Candidato a Delegado';
							}else if(aa==2){
								titulo ='Junta de Directores';
							}else if(aa==3){
								titulo ='Junta de Vigilancia';
							}else if(aa==4){
								titulo ='Comite de Crédito';
							}

						//html += '<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 our-team" style="border:none"><div class="card" style="border:none"><div class="card-header bg-info" style="text-align: center;"><b  style="font-size:36px">';
						//html += titulo + ' </b><br/> (Cantidad de candidatos seleccionados : <label id="totales_'+  aa  +'"> '+0+'</label> )</b> </div><div class="row">';
						 html += "";
	
						for (var ii = 0; ii < datosencabezado.length; ii++)
						{
							//console.log(datosencabezado[ii]);

							if( datosencabezado[ii]['foto'] === undefined || datosencabezado[ii]['foto'] === null )
							{
								elavatar = "./images/logo-footer.png";
							}
							else
							{
								elavatar = "../../../adjuntos/"+datosencabezado[ii]['foto'];
							}   
	
							html +=" <div data-gallery-tag='"+titulo+"'  class='gallery-item cuadritovotante  col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12' style='cursor:pointer' ";
							
							var aa1 =datosencabezado[ii]['id_delegado'];
							var aa2 =datosencabezado[ii]['id_area'];
							var aa3 ='"'+ titulo+'"';
							
							html +=" onclick='avatardisplayFn( " + (aa1) +" ," + (aa2) +" ," + (aa3) +"  )' " ;

							html +="><div class='card' id='papeletacard_"+datosencabezado[ii]['id_delegado']+"_"+datosencabezado[ii]['id_area']+"'><div class='card-header' style='background:#008d5e;text-align: center;color:white;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]['num_cliente']+"</div><div class='card-body' id='collapseExample' style='text-align: center;border: solid 1px #c3c3c3;'>";
							@if($tipoevent == 2)
								html +="<img   class='img-fluid  mx-auto d-block avatardisplay' id='img_"+datosencabezado[ii]['id_delegado']+"' style='background: #7e977e;width: 154px;height:155px;cursor:pointer' src='"+elavatar+"'>";
							@endif
								html +="<p style='text-align: center;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]["apellido"]+",&nbsp;"+datosencabezado[ii]["nombre"]+"</p><p style='text-align: center;font-size: 17px;'>"+titulo+"</p><p style='text-align: center;font-size: 17px;'>";
							@if($tipoevent == 2)
								//html +=titulo;
							@endif								
								
								html +="</p></div></div></div>";


						}


					}
				//console.log('-------');
					
				}
          html += '</div></div></div>';
        $('.DirectivosDir').html(html);
		renderizarselecciones();
		terminar_espere();  
          
     
          estilotab();
          
     }

   });

          

}

function estilotab()
  {
    
            $('.gallery').mauGallery({
                 columns: {
                     xs: 1,
                     sm: 1,
                     md: 3,
                     lg: 3,
                     xl: 4
                 },
                 lightBox: true,
                 lightboxId: 'myAwesomeLightbox',
                 showTags: true,
                 tagsPosition: 'top'
             });  
    
        $("a").each(function(){
            //if($(this).attr("nav-link")=='all'){   console.log(this.innerHTML) }   
              if(this.innerHTML == 'Junta de Directores'){ 
                //alert(this.innerHTML);
                //console.log(this);
                 //this.attr('type', 'button');

                 //this.attr('onclick', 'click');
                  //this.click();
                //this.trigger("click");
                console.log(this);
                 //this.attr('onclick', 'click');
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


                var html = "<div class=' our-team' style='border:none'><div class='card' style='border:none'><div class='row gallery'>";
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
								titulo ='Candidatos a Delegados';
							}else if(aa==2){
								titulo ='Junta de Directores';
							}else if(aa==3){
								titulo ='Junta de Vigilancia';
							}else if(aa==4){
								titulo ='Comite de Crédito';
							}

						//html += '<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 our-team" style="border:none"><div class="card" style="border:none"><div class="card-header bg-info" style="text-align: center;"><b  style="font-size:36px">';
						//html += titulo + ' </b><br/> (Cantidad de candidatos seleccionados : <label id="totales_'+  aa  +'"> '+0+'</label> )</b> </div><div class="row">';
						 html += "";
	
						for (var ii = 0; ii < datosencabezado.length; ii++)
						{
							//console.log(datosencabezado[ii]);

							if( datosencabezado[ii]['foto'] === undefined || datosencabezado[ii]['foto'] === null )
							{
								elavatar = "./images/logo-footer.png";
							}
							else
							{
								elavatar = "../../../adjuntos/"+datosencabezado[ii]['foto'];
							}   
	
							html +=" <div data-gallery-tag='"+titulo+"'  class='gallery-item cuadritovotante  col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12' style='cursor:pointer' ";
							
							var aa1 =datosencabezado[ii]['id_delegado'];
							var aa2 =datosencabezado[ii]['id_area'];
							var aa3 ='"'+ titulo+'"';
							
							html +=" onclick='avatardisplayFn( " + (aa1) +" ," + (aa2) +" ," + (aa3) +"  )' " ;

							html +="><div class='card' id='papeletacard_"+datosencabezado[ii]['id_delegado']+"_"+datosencabezado[ii]['id_area']+"'><div class='card-header' style='background:#008d5e;text-align: center;color:white;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]['num_cliente']+"</div><div class='card-body' id='collapseExample' style='text-align: center;border: solid 1px #c3c3c3;'>";
							@if($tipoevent == 2)
								html +="<img   class='img-fluid  mx-auto d-block avatardisplay' id='img_"+datosencabezado[ii]['id_delegado']+"' style='background: #7e977e;width: 154px;height:155px;cursor:pointer' src='"+elavatar+"'>";
							@endif
								html +="<p style='text-align: center;font-size: 28px;font-weight: bold;'>"+datosencabezado[ii]["apellido"]+",&nbsp;"+datosencabezado[ii]["nombre"]+"</p><p style='text-align: center;font-size: 17px;'>"+titulo+"</p><p style='text-align: center;font-size: 17px;'>";
							@if($tipoevent == 2)
								//html +=titulo;
							@endif								
								
								html +="</p></div></div></div>";


						}


					}
				//console.log('-------');
					
				}
          html += '</div></div></div>';
        $('.DirectivosDir').html(html);
		renderizarselecciones();
		terminar_espere();  
          
     
          estilotab();
          
}





function visualizarselecciones()
	{
  return $.Deferred(function(df){ df.resolve();
    var html ='';
    var conteo = 0;
    $("#contenedorAspirantes").html(html);
	


	
    $.each(Papeletas, function (index, item) {
      html += "<li>" ;
  
          html += "<a href='#' onclick='deleteRow("+conteo+")'>"+ item.area +" </br> "+ item.nombre +"  " + item.apellido + "</a>";
  
      html+="</li>";
      conteo++;
  });
    $("#contenedorAspirantes").append(html);
    Papeletas = Papeletas || [];
    if(Papeletas!=""){
      //console.log(Papeletas);
      $('#contadorSeleccionados').html('('+ Papeletas.length+')'); 
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
    Papeletas = Papeletas || [];
  
      $.ajax({
        url:  '{{ url("votacion/coopexe2")}}'
        , data: { indice: dato }
        , method: 'GET'
        , success: function(result){
			   var datoz = result;
          //console.log(datoz);
				  Papeletas.push({ "id_delegado": datoz[0].id_delegado,"num_cliente": datoz[0].num_cliente,"nombre": datoz[0].nombre,"apellido": datoz[0].apellido,"id_area": id_area,"area":area,"tipo": '',"foto": ''   });
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
    //var aaa= JSON.stringify(Papeletas);
     Papeletas = Papeletas || [];
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
  
</script>        
      <script type="text/javascript">
         $(document).ready(function() {

         });
      </script>
      <style>
         .my-4 tags-bar nav nav-pills
         {
         margin-bottom: 20px; !important;
         }
      </style>
        
        
        <script>
        
              $(document).ready(function(){

                  /*if(isMobile.mobilecheck() == false){
                      $('.navbar-toggler').trigger( "click" );

                  }	*/

                  var Papeletastex1 = localStorage.getItem("lasboletas{{ $ideven }}");

                  if(Papeletastex1!=""){
                    var Papeletastex = localStorage.getItem("lasboletas{{ $ideven }}");
                    Papeletas = JSON.parse(Papeletastex);
                    //console.log(Papeletas);
                  PapeletasIniciales('');		
                  }
                  else{
                  PapeletasIniciales('');	
                  }

                
  
  /*
             $('.gallery').mauGallery({
                 columns: {
                     xs: 1,
                     sm: 1,
                     md: 3,
                     lg: 4,
                     xl: 4
                 },
                 lightBox: true,
                 lightboxId: 'myAwesomeLightbox',
                 showTags: true,
                 tagsPosition: 'top'
             });     */               
                  localStorage.setItem("aspirantes{{ $ideven }}",[]);

              });

        </script>



@stop
