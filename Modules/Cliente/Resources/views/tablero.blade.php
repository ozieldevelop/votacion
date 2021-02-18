@extends('cliente::layouts.master_tablero')


@section('content')





    <div class="col-sm-12 col-md-12 col-lg-12">   
                 <div id="carouselExampleIndicators" class="carousel slide align-items-center justify-content-center" data-ride="carousel"  style="display:none">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner" id="DirectivosDir">
                   
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
     </div>                               


    <div class="col-sm-12 col-md-6 col-lg-5">     
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Aspirantes Postulados</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Descargas</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">

        @if( $tipoevent == 2 )
         <a href="#" class="btn btn-primary btn-block"><b>Cambiar Imagen de perfil</b></a>
        @endif
     <button type="button" class="btn btn-block btn-primary" disabled>Acceder a Reuni&oacute;n</button>
     <a type="button" href="{{ env('APP_URL', './') }}/votacion/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block btn-primary">Votaci&oacute;n</a>
     <!--button type="button" class="btn btn-block btn-primary disabled">Bot&oacute;n no habilitado para persistencia</button-->                    
                    
                    

                    
                    
                    
                  </div>
                  <div class="tab-pane" id="settings">
          
                            <!--ul class="list-unstyled">
                              <li>
                                <a href="#" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                              </li>
                              <li>
                                <a href="#" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                              </li>
                              <li>
                                <a href="#" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                              </li>
                              <li>
                                <a href="#" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                              </li>
                              <li>
                                <a href="#" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                              </li>
                            </ul-->

                            <div class="card" >
                              <div class="card-header bg-light resaltado">ADJUNTOS</div>
                              <div class="card-body" >
                                <!-- dropzone  -->
                                <form action="{{ url('/cliente/upload') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                  <input type="hidden"  id="up_id_evento" name="up_id_evento" value="{{ $id_evento }}">
                                  {{ csrf_field() }}
                                </form>
                                <!-- AREA DONDE SE LISTARAN LOS ARCHIVOS ADJUNTOS UNA VEZ SUBIDOS -->
                                <table  class="table" style="width:100%" id="gs_tbl_GestionesArchivos"> </table>
                              </div>
                            </div>
                    
                    
                  </div>                  
               </div>  
              </div>  
           </div>   
      
  
    </div> 
      
      
      
       <div class="col-sm-12 col-md-12 col-lg-12" style="display:none">        


                <div class="card card-secondary card-tabs">
                   <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">DETALLES</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">DESCARGAS</a>
                        </li>
                      </ul>
                  </div>
                    <div class="card-body">
                      <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                            <div class="row">
                               <div class="col-12">


              <div class="card-body">
                
              </div>
              <!-- /.card-body -->
          
          
                    </div>

                </div>       
          </div>

                    </div>
                </div>
              </div>
      </div> 



      <div class="col-sm-12 col-md-12 col-lg-12" style="display:none">
        <br />
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                DEVELOPER
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <textarea id="codeMirrorDemo" class="p-3">
                
                
              </textarea>
            </div>
            <div class="card-footer">
            
            </div>
          </div>
        <br />
     </div>


<style>
      .carousel-control-next, .carousel-control-prev{
            position: absolute;
            color: black;
            top: 2px;
        background: #c3c3c3;
        width: 5%;
      }
      
      .card {

          margin-bottom: 0px;
      }

      .img-fluid {
          max-width: 56%;

      }

</style>


@endsection

  
@section('page-script')

<script type="text/javascript" src="{{ url('assets/dropzone') }}/dropzone.js"></script>

<link rel="stylesheet" type="text/css" href="{{ url('assets/dropzone') }}/dropzone.css"/>



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
      
         Dropzone.options.myDropzone = {
          paramName: 'file',
          maxFilesize: 20, // MB
          maxFiles: 20,
          //acceptedFiles: ".jpeg,.jpg,.png,.gif",
          init: function()
          {
              this.on("success", function(file, response) {
                  cargaadjuntosx(1);
                  console.log('Termino');
              });
          }
         };
      
      
      
          function haybloqueo()
          {
            var parametros = {
              sala : {{ $id_evento }} 
            }
            socket.emit('atencion', parametros, function(err) { });      
          }
      
      
      
           /*
              $(function () {
                $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                  event.preventDefault();
                  $(this).ekkoLightbox({
                    alwaysShowClose: true
                  });
                });

                //$('.filter-container').filterizr({gutterPixels: 3});
                $('.btn[data-filter]').on('click', function() {
                  $('.btn[data-filter]').removeClass('active');
                  $(this).addClass('active');
                });
              });
          */

          CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
          });    

          cargarperfil();

         function cargarperfil()
         {

           document.querySelector('.CodeMirror').CodeMirror.setValue(JSON.stringify(modelo,undefined,2))

         }  
      

      
</script>


    

    <script>
/*
          function buildHtmlTableAdjuntos(elementosData,selector)
          {
                  var columns = addAllColumnHeadersdatos(elementosData, selector);
                  for (var i = 0; i < elementosData.length; i++) {
                    if(elementosData[i] != undefined)
                    {
                            var row$ = $('<tr/>');
                                for (var colIndex = 0; colIndex < columns.length; colIndex++) {
                                          var cellValue = elementosData[i][columns[colIndex]];
                                          //console.log(cellValue);
                                          if (cellValue == null) cellValue = "";
                                          //row$.append($('<td contenteditable="true"/>').html(cellValue));
                                          row$.append($('<td "style="word-wrap: break-word" />').html(cellValue));
                                }
                                $(selector).append(row$);
                            }
                  }
          }
*/

function buildHtmlTableAdjuntos(adjuntosed,selector) 
{
   var columns = addAllColumnHeadersAdjuntos(adjuntosed,selector);
		var contadoradjuntos = 0;
		var bandera = -1;


        for (var i = 0; i < adjuntosed.length; i++) 
        {
          if(adjuntosed[i] != undefined)
          {
       
                  var row$ = $('<tr id=rowNum'+contadoradjuntos+' />');
                  for (var colIndex = 0; colIndex < columns.length; colIndex++) 
                  {
                      //console.log(adjuntosed);
								      bandera++;
                      var cellValue = adjuntosed[i][columns[colIndex]];
                      //console.log(adjuntosed[i]);
                          if (cellValue == null) cellValue = "";

                                if(bandera<=1)
                                {
									                  row$.append($('<td style="word-wrap: break-word;" />').html(cellValue));
                                          
								                }
								                else
                                {
                                  var eldiv = document.createElement("div");	
                                  eldiv.setAttribute("role", "group");
                                  eldiv.setAttribute("class", "btn-group-vertical");

                                  var elboton = document.createElement("button");
                                  elboton.setAttribute("aria-expanded", "aria-expanded");
                                  elboton.setAttribute("aria-haspopup", "true");
                                  elboton.setAttribute("data-toggle", "dropdown");
                                  elboton.setAttribute("class", "btn btn-secondary dropdown-toggle ");
                                  elboton.setAttribute("type", "button");
                                  elboton.innerHTML = "Opciones";
                                  eldiv.appendChild(elboton);

                                  var eldiv2 = document.createElement("div");	
                                  eldiv2.setAttribute("aria-labelledby", "btnGroupVerticalDrop1");
                                  eldiv2.setAttribute("class", "dropdown-menu");
                                  eldiv2.setAttribute("x-placement", "bottom-start");

                                  /*
                                  var a1 = document.createElement("a");	
                                  a1.setAttribute("class", "dropdown-item");
                                  a1.setAttribute("type", "button");
                                  a1.setAttribute("style", "cursor:pointer");
                                  a1.setAttribute("onclick", "javascript:abriretiquetaadjunto("+cellValue+")");
                                  a1.innerHTML = "Etiquetar";
                                  */

                                  var a2 = document.createElement("a");	
                                  a2.setAttribute("class", "dropdown-item");	
                                  a2.setAttribute("style", "cursor:pointer");
                                  a2.setAttribute("onclick", "javascript:eliminaradjunto("+cellValue+")");
                                  a2.innerHTML ="Eliminar";

                                  //eldiv2.appendChild(a1);
                                  eldiv2.appendChild(a2);

                                  eldiv.appendChild(eldiv2);

                                  
                                  var elboton2 = document.createElement("button");
                                  elboton2.setAttribute("type", "button");
                                  elboton2.setAttribute("onclick", "javascript:descargaradjunto("+cellValue+")");
                                  elboton2.setAttribute("class", "btn btn-info col-6");
                                  elboton2.innerHTML ="Descargar";

                                  var eltdfinal = document.createElement("td");
                                  eltdfinal.setAttribute("style","word-wrap: break-word");
                                  eltdfinal.appendChild(eldiv);
                                  eltdfinal.appendChild(elboton2);
                                  row$.append(eltdfinal);	
                                  
                                }
                     }
								        
                    if(bandera===2)
                    {
                      bandera=-1;
                    }

					  }
                      contadoradjuntos++;
                      $(selector).append(row$);
                  }


}
      
      
      
        function addAllColumnHeadersAdjuntos(elementosDatax1, selector)
        {
                var columnSet = [];
                var elthead = $('<thead/>');
                $(elthead).attr("class", "thead-light");
                var headerTr$ = $('<tr/>');
                for (var i = 0; i < elementosDatax1.length; i++) {
                          var rowHash = elementosDatax1[i];
                              for (var key in rowHash) {
                                if ($.inArray(key, columnSet) == -1) {
                                  columnSet.push(key);
                                  headerTr$.append($('<th/>').html(key));
                                }
                              }
                }
                if( elementosDatax1.length >0)
                {
                  var thcustom = document.createElement("th");
                  headerTr$.append(thcustom);
                  elthead.append(headerTr$);
                }
                else {
                  $(selector).html('<thead class="thead-light"><tr><th>No se encontraron registros</th></tr></thead>');
                  return columnSet;
                }

                $(selector).html(elthead);
                return columnSet;
        }
      
      
        function cargaadjuntosx(opcion)
        {
            // console.log("aaa");
							$.ajax
              ({
								url: '{{ url("cliente/cargaadjuntosScreenListar")}}/'  
								, data: { 'id_evento': '{{ $id_evento }}' , 'cldoc':  '{{ $num_cliente }}'  }             
								, method: 'get'
								,success: function(datos){
                          //adjuntosed = datos; 
                          $('#gs_tbl_GestionesArchivos').html('');
                          buildHtmlTableAdjuntos(datos,'#gs_tbl_GestionesArchivos');
								},
								error: function (r) {
										//console.log("ERROR");
										//console.log(r);
								}
							});
        }
      
            function evaluarasignararea()
          {
                     $.ajax({
                            url: '{{ url("cliente/alldatadirectivos")}}/'
                            , data: { evento: modelo.id_evento}
                            , method: 'GET'                             
                            , success: function(result){

                                  //var datoz = JSON.parse(result);
                                  var datoz = result;
                                  var html = '';
                                  var elavatar = ''
                                  var tempcss ='';
                              
                                  for (var i = 0; i < datoz.length; i++)
                                  {
	                                  tempcss ='';
                                    if(i==0){
                                      var  activo ='active';
                                    }else{
                                     var  activo ='';
                                    }
                                    @if( $tipoevent == 1 )
                                             elavatar = "../images/logo-footer.png";
                                             tempcss ='background: #fff;';
                                    @else
                                            if( datoz[i]['foto'] === undefined || datoz[i]['foto'] === null ) {
                                              elavatar = "../images/logo-footer.png";
                                              tempcss ='background: #fff;';
                                            }
                                            else{
                                              elavatar = datoz[i]['tipo']+"base64,"+datoz[i]['foto'];
                                              tempcss ='';
                                            }	                                   
                                    @endif
                                     html +='<div class="carousel-item '+activo+' "><div class="card card-widget widget-user shadow-lg"><div class="widget-user-header text-white" style="background: url(../dist/img/photo1.png) center center;"><h2 class="widget-user-username" style="font-size:43px !important">'+ (datoz[i]["trato"].substring(0, 10))  +' '+ (datoz[i]["nombre"].substring(0, 10)) +' '+ (datoz[i]["apellido"].substring(0, 10))  +' </h2></div><div class="widget-user-image"><img style="background:#fff !important;" class="img-circle" src="'+ elavatar +'" alt="User Avatar"></div><div class="card-footer"><div class="row"><div class="col-sm-12 col-md-12 col-lg-12 border-right"><div class="description-block"><h5 class="description-header">'+ (datoz[i]["ocupacion"].substring(0, 10)) +' '+ (datoz[i]["profesion"].substring(0, 10)) +'</h5><span class="description-text"># '+ datoz[i]['num_cliente'] +'</span></div></div></div></div></div></div>';
                                  }
                                  $('#DirectivosDir').html(html);    
                            }
                     });
          }      
      
      $( document ).ready(function() {
          cargaadjuntosx(1);
          //evaluarasignararea();
      });  
      
    </script>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"> </script>

   <script>

        var socket = io("{{ env('PUBLISHER_URL') }}:{{ env('BROADCAST_PORT') }}");


        socket.on('connect', function() 
        {
                  var parametros = ({ 'num_cliente' : modelo.num_cliente,'nombre' : modelo.nombre,'agencia' : modelo.agencia,'sala' : {{ $id_evento }} ,'name_evento' : encodeURI('{{ $nombreevento }}')   });

                  socket.emit('join', parametros, function(err) {
                    if (err){
                      alert(err);
                    }else{

                    }
                  });

                  socket.on('bloquearexplorer',() => {

                     alert('AQUI LES DOY ACCION A TODOS');

                  });        

                  socket.on('serviciomensajedirecto',(parametros) => {

                     alert('AQUI LES BLOQUEO' + parametros,mensaje);

                  });   
      
                  socket.on('serviciomensajesala',(parametros) => {

                     alert('AQUI LES BLOQUEO' + parametros,mensaje);

                  });    
      
      
                 socket.on('disconnect', function() {
                    console.log('User Disconnected to server');
                 });

                 socket.on('updateUserList', function(users) 
                 {
                   //console.log(users);
                  var ol = '';
                   $('#users').html('');
                  users.forEach(function(user) {
                   // ol.append($('<li class="nav-icon far fa-circle text-success">'+user.num_cliente +'   '+ user.nombre +'   '+ user.agencia+'<button type="button">'+user.id+'</button></li>'));
                    ol+=('<li class="nav-item"><a href="#" class="nav-link"> <i class="nav-icon far fa-circle text-success"></i><p class="text">'+user.num_cliente +'   '+ user.nombre +'   '+ user.agencia+'</p></a></li>');
                  });
                  $('#usuarioslinea').html(ol);
                });

                socket.on('serviciomensajedirecto', function(parametros) {
                  alert('serviciomensajedirecto: '+parametros.mensaje);
                });

                socket.on('serviciomensajesala', function(parametros) {
                  alert('serviciomensajesala: '+parametros.mensaje);
                });

       });   
     
   </script>


@stop	   
  



