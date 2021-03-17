@extends('cliente::layouts.master_tablero')


@section('content')





    <div class="col-sm-12 col-md-12 col-lg-12">     
                            <div class="card" >
                              <div class="card-header bg-light resaltado">ADJUNTOS  </div>
                              <div class="card-body" >

                                <!-- AREA DONDE SE LISTARAN LOS ARCHIVOS ADJUNTOS UNA VEZ SUBIDOS -->
                                <table  class="table" style="width:100%" id="gs_tbl_GestionesArchivos"> </table>
                              </div>
                            </div>
    </div>



 @if($tipoevent==2)

    <div class="col-sm-12 col-md-12 col-lg-12" style="display:none">     

      
                            <div class="card" >
                              <div class="card-header bg-light resaltado"> <label style="float-right; color:#c36c55"> NUEVA </label> PROPUESTAS</div>
                              <div class="card-body" >

                                  <table class="table" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                      </tr>
                                    </thead>
                                    <tbody id="PropuestasDir">

                                    </tbody>
                                  </table>
                                
                              </div>
                            </div>
      
  </div> 

@endif
  

  <div class="col-sm-12 col-md-12 col-lg-12"> &nbsp;</div>    
      
      
@if($tipoevent==2)
       <div class="col-sm-12 col-md-12 col-lg-12" style="display:none"> 
                            <div class="card" >
                              <div class="card-header bg-light resaltado">POSTULADOS</div>
                              <div class="card-body" >

                                  <table class="table" style="width:100%">
                                    <thead>
                                      <tr>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                      </tr>
                                    </thead>
                                    <tbody id="DirectivosDir">

                                    </tbody>
                                  </table>
                                
                              </div>
                            </div>
      </div>         
 @endif  
      
      


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
      
        /*
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
        */
      
      
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

                          
                                  
                                  var elboton2 = document.createElement("button");
                                  elboton2.setAttribute("type", "button");
                                  elboton2.setAttribute("onclick", "javascript:descargaradjunto("+cellValue+")");
                                  elboton2.setAttribute("class", "btn btn-info col-12");
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
                  $(selector).html('<thead class="thead-light"><tr><th></th><th></th><th></th></tr></thead>');
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
          var id_evento = $('#eventos').val();
							$.ajax
              ({
								url: '{{ url("cliente/cargaadjuntosScreenListar")}}/'  
								, data: { 'id_evento': {{ $id_evento }}  }             
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
                            url: '{{ url("cliente/alldatadirectivosgroup")}}/'
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
                                              elavatar = "../../../adjuntos/"+datoz[i]['foto'];
                                              tempcss ='';
                                            }	                                   
                                    @endif
                                    //console.log({{$tipoevent}});
                                     html +='<tr><th scope="row" style="vertical-align: text-bottom;"><img style="width:100px;heigth:100px;background:#fff !important;" src="'+ elavatar +'" alt="User Avatar"></th><td  style="vertical-align: text-bottom;font-weight:bold;">#' + datoz[i]['num_cliente'] +'</td><td  style="vertical-align: text-bottom;font-weight:bold;">'+ (datoz[i]["trato"].substring(0, 10)).toUpperCase()  +' '+ (datoz[i]["nombre"].substring(0, 10)).toUpperCase() +' '+ (datoz[i]["apellido"].substring(0, 10)).toUpperCase()  +' - '+ (datoz[i]["ocupacion"].substring(0, 10)).toUpperCase() +' '+ (datoz[i]["profesion"].substring(0, 10)).toUpperCase() +'</td></tr><tr><td colspan="3" style="vertical-align: text-bottom;">'+ (datoz[i]["memoria"]) +'</td></tr>';
                                  }
                                  $('#DirectivosDir').html(html);    
                            }
                     });
          }      
      
      $( document ).ready(function() {
        cargaadjuntosx(1);
          @if($tipoevent==2)
               evaluarasignararea();
          @endif
      });  
      
        function descargaradjunto(id)
        {

            window.open( '{{ url('/') }}' + '/cliente/descargarfile/'+id );
        }
      
      
      
      
      
    </script>


   <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"> </script>

   <script>
/*
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
    */ 
   </script>


@stop	   
  



