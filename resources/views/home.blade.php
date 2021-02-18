@extends('layouts.dashboard')

@section('content')

        <div class="col-md-12">
          <br/><br/><br/><br/><br/>

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
   

                  
                  <button class="btn btn-success" onclick="bloquearpantallasala(1)"> BOT&Oacute;N ENVIAR ACCION A TODOS LOS PERTENECIENTES A SALA CAPITULAR </button>
                  <br/>
                  <br/>
                  <ul class="" role="menu" data-accordion="false" id="usuarioslinea">
                  </ul>
                  
                </div>
            </div>
        </div>

 	<div class="col-md-12" >

		<iframe style="width:100%;height:600px" src="http://eaguilars.com:9999/meeting.html?name=Q0ROMS45LjBXaW4xMCNjaHJvbWUvODcuMC40MjgwLjY2&mn=7330814308&email=ZWFndWlsYXJzQGdtYWlsLmNvbQ%3D%3D&pwd=5gBJnD&role=0&lang=en-US&signature=LU03cFpoTkJTY2F2Sm05QWM5SzFOUS43MzMwODE0MzA4LjE2MTM0MTg3MzUxOTEuMC5RMVd1dGU1a1dtWnU5Tk9XMVFCbnNVME1IeVhPSnVpY0xTcy9panRmdWE4PQ&china=0&apiKey=-M7pZhNBScavJm9Ac9K1NQ" sandbox="allow-pointer-lock allow-popups allow-scripts allow-same-origin" allow="microphone; camera;"></iframe>
		
	</div> 
@section('page-script')




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
            var parametros = ({ 'num_cliente' : 0 ,'nombre' : 'Administrador','agencia' : 'Sede','sala' : 1 ,'name_evento' : 'administrador'   });
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
             console.log(users);
            // return false;
            var ol = '';
             $('#users').html('');
            users.forEach(function(user) {
              if(user.num_cliente!=0){
                // ol.append($('<li class="nav-icon far fa-circle text-success">'+user.num_cliente +'   '+ user.nombre +'   '+ user.agencia+'<button type="button">'+user.id+'</button></li>'));
                ol+=("<button type='button' onclick=mensajedirecto('"+(user.id)+"')>MENSAJE TEST DIRECTO</button> - "+user.id+" - "+user.num_cliente +"   "+ user.nombre +"   "+ user.agencia+"</br>");
              }
            });
            $('#usuarioslinea').html(ol);
          });

      
          function mensajesala(sala)
          {
            alert(identificador);
          }      
      
          function bloquearpantalladirecto(identificador)
          {
            //alert(identificador);
          }      
      
          function bloquearpantallasala(lasala)
          {
            var parametros = {
              sala : lasala
            }
            socket.emit('atencion', parametros, function(err) { });      
          }
      

      
      
          function mensajedirecto(identificador)
          {
            var parametros = {
              usuario : identificador,
              mensaje : 'test'
            }
            socket.emit('mensajedirecto', parametros, function(err) { });      
          }     
      
      
      
    </script>


@stop	   