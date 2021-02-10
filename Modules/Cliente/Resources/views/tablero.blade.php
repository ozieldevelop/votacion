@extends('cliente::layouts.master_tablero')


@section('content')

    <div class="col-sm-12 col-md-12 col-lg-12">   
                 <div id="carouselExampleIndicators" class="carousel slide align-items-center justify-content-center" data-ride="carousel" >
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


    <div class="col-sm-12 col-md-12 col-lg-12">     
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


         <a href="#" class="btn btn-primary btn-block"><b>Cambiar Imagen de perfil</b></a>
     <button type="button" class="btn btn-block btn-primary" disabled>Acceder a Reuni&oacute;n</button>
     <a type="button" href="#" class="btn btn-block btn-primary">Votaci&oacute;n</a>
     <button type="button" class="btn btn-block btn-primary disabled">Bot&oacute;n no habilitado para persistencia</button>                    
                    
                    

                    
                    
                    
                  </div>
                  <div class="tab-pane" id="settings">
                        
                            <ul class="list-unstyled">
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
                            </ul>


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



      <div class="col-sm-12 col-md-12 col-lg-12">
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





@endsection

  
@section('page-script')



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
                                  for (var i = 0; i < datoz.length; i++)
                                  {
                                    if( datoz[i]['foto'] === undefined || datoz[i]['foto'] === null ) {
                                      elavatar = "./images/logo-footer.png";
                                    }
                                    else{
                                      elavatar = datoz[i]['tipo']+"base64,"+datoz[i]['foto'];
                                    }		
                                    if(i==0){
                                      var  activo ='active';
                                    }else{
                                     var  activo ='';
                                    }
                                    //html +='<div class="cuadritovotante col-sm-12 col-md-6" style="margin-top: 14px;"> <div class="card"><div class="card-header">'+ (datoz[i]["nombre"].substring(0, 10)) +' '+ (datoz[i]["apellido"].substring(0, 10))  +' <div class="card-actions"><a href="#" class="btn-setting" onclick="adminAspirante('+  datoz[i]['id_delegado'] +')"  style="color:black"><i class="icon-wrench"></i></a> &nbsp;<a href="#" class="btn-setting" onclick="delAspirante('+  datoz[i]['id_delegado'] +')"  style="color:black"><i class="icon-trash"></i></a></div></div><div class="card-body " id="collapseExample" style="text-align: center;"><img onclick="avatardisplayFn('+ datoz[i]['id_delegado'] +')"  class="img-fluid rounded-circle mx-auto d-block avatardisplay" id="img_'+ datoz[i]["id_delegado"] +'" style="background: #7e977e;width: 154px;height:155px;cursor:pointer" src="'+ elavatar +'" ><p style="text-align: center;">'+ datoz[i]['num_cliente'] +'</p></div></div></div>';
                                     html +='<div class="carousel-item '+activo+' "><div class="card card-widget widget-user shadow-lg"><div class="widget-user-header text-white" style="background: url(../dist/img/photo1.png) center center;"><h2 class="widget-user-username" style="font-size:43px !important">'+ (datoz[i]["trato"].substring(0, 10))  +' '+ (datoz[i]["nombre"].substring(0, 10)) +' '+ (datoz[i]["apellido"].substring(0, 10))  +' </h2></div><div class="widget-user-image"><img class="img-circle" src="'+ elavatar +'" alt="User Avatar"></div><div class="card-footer"><div class="row"><div class="col-sm-12 col-md-12 col-lg-12 border-right"><div class="description-block"><h5 class="description-header">'+ (datoz[i]["ocupacion"].substring(0, 10)) +' '+ (datoz[i]["profesion"].substring(0, 10)) +'</h5><span class="description-text"># '+ datoz[i]['num_cliente'] +'</span></div></div></div></div></div></div>';
                                  }
                              
                              
                              
                                  $('#DirectivosDir').html(html);    
                    
                            }
                     });


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
           /*
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
              mode: "htmlmixed",
              theme: "monokai"
            }).setValue(JSON.stringify(modelo,undefined,2));
           */
           document.querySelector('.CodeMirror').CodeMirror.setValue(JSON.stringify(modelo,undefined,2))


         }  
      
      evaluarasignararea();
      
</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"> </script>

    <script>

          var socket = io("{{ env('PUBLISHER_URL') }}:{{ env('BROADCAST_PORT') }}");


          /**************************** FUNCIONES ESCUCHAS *************************/
          socket.on('connect', function() {
           // var param = JSON.stringify(modelo,undefined,2);
            //console.log(window.location.search);
           // var param = $.deparam(window.location.search);
            //console.log(typeof (param));
           //console.log(param);
           //console.log(modelo);
           // param.push(modelo);
            var parametros = ({ 'num_cliente' : modelo.num_cliente,'nombre' : modelo.nombre,'agencia' : modelo.agencia,'sala' : {{ $id_evento }} ,'name_evento' : encodeURI('{{ $nombreevento }}')   });
            //console.log(parametros);
           // var parametros = JSON.parse(modelotrue);
            socket.emit('join', parametros, function(err) {

              if (err){
                alert(err);
              }else{

              }
            });



          });

          socket.on('disconnect', function() {
            console.log('User Disconnected to server');
          });


           socket.on('updateUserList', function(users) {
            var ol = '';
             $('#users').html('');
            users.forEach(function(user) {
             // ol.append($('<li class="nav-icon far fa-circle text-success">'+user.num_cliente +'   '+ user.nombre +'   '+ user.agencia+'<button type="button">'+user.id+'</button></li>'));
              ol+=('<li class="nav-item"><a href="#" class="nav-link"> <i class="nav-icon far fa-circle text-success"></i><p class="text">'+user.num_cliente +'   '+ user.nombre +'   '+ user.agencia+'</p></a></li>');
            });
            $('#usuarioslinea').html(ol);
          });
      

    </script>


@stop	   
  



