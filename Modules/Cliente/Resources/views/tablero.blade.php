@extends('cliente::layouts.master_tablero')


@section('content')




<div class="col-sm-12 col-md-12 col-lg-12"> &nbsp;</div>


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
<div class="col-sm-12 col-md-12 col-lg-12"> 
    {{-- <div class="card" >
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
    </div> --}}
    <div class="card border-success">
        <div class="card-header bg-light"><h3>Realizar una nueva Propuesta</h3></div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div id="propuestas_board">
                {{-- <template> --}}
                    <div class="col-md-12">
                        {{-- <h3>Realizar una nueva Propuesta</h3> --}}
                        <form action="" method="">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-12 col-sm-12">
                                    <label for="titulo">Título:</label>
                                    <input type="text" name="titulo" class="form-control" placeholder="Título de su propuesta" 
                                        v-model="propuesta.titulo" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-row mb-2">
                                <div class="col-md-12 col-sm-12">
                                    <label for="detalle">Detalles adicionales de la propuesta:</label>
                                    <textarea type="text" name="detalle" class="form-control" placeholder="Mayores detalles." 
                                        v-model="propuesta.detalle" rows="7" cols="10">
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <div class="col-md-6 col-sm-12">
                                    <label for="secunda_asoc">Secunda la propuesta:</label>
                                    <input type="text" name="secunda_asoc" class="form-control" placeholder="Secundada Por:" 
                                        v-model="propuesta.secunda_asoc" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="secunda_asoc_id">Número de Cliente:</label>
                                    <input type="number" name="secunda_asoc_id" class="form-control" placeholder="# de cliente:" 
                                        v-model="propuesta.secunda_asoc_id" required>
                                </div>
                            </div>
                            <br>
                            <div>
                                <input type="hidden" name="numero_asoc" value="{{ $num_cliente }}" id="numero_asoc">
                                <input type="hidden" name="nombre_asoc" value="{{ $nombre }}" id="nombre_asoc">
                            </div>
                            <button class="btn btn-primary" @click="registrar($event)">Proponer</button>
                        </form>
                    </div>
                    <br><hr>
                    <div class="col-md-12">
                        <h3>Listado de mis Propuestas</h3>
                        <br>
                        <template>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="(item, index) in propuestas" :key="index">
                                <div class="d-flex justify-content-between align-items-center px-3" style="background-color: honeydew">
                                    <h5><strong class="mb-1" >@{{ item.titulo }}</strong></h5>
                                    {{-- <div>
                                        <button class="btn" @click="like(item.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                            </svg>
                                        </button>
                                        <span class="badge badge-primary badge-pill">@{{ item.aprovaciones }}</span>
                                        <button class="btn" @click="dislike(item.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/>
                                            </svg>
                                        </button>
                                        <span class="badge badge-danger badge-pill">@{{ item.desaprovaciones }}</span>
                                    </div> --}}
                                </div>
                                <p class="mb-1">@{{ item.detalle }}</p>
                                <small class="d-flex justify-content-center">
                                    Propuesta realizada por: <b>@{{ item.user_name }}</b>, Secundada por: <b>@{{ item.secunda_asoc }}</b>
                                </small>
                            </li>
                        </ul>
                        </template>
                    </div>
                {{-- </template> --}}
            </div>
            
            <button class="btn btn-success" onclick="bloquearpantallasala(1)"  style="display:none"> BOT&Oacute;N ENVIAR ACCION A TODOS LOS PERTENECIENTES A SALA CAPITULAR </button>
            <br/>
            <br/>
            <ul class="" role="menu" data-accordion="false" id="usuarioslinea">
            </ul>
            
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


<link rel="stylesheet" href="{{ asset('css/lolibox.css') }}">
<link rel="stylesheet" href="../../css/lolibox.min.css"/>
<script src="../../js/lobibox.js"></script>
<script src="../../js/herramientas.js"></script>
<script src="{{ asset('js/lobibox.js') }}"></script>

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
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const app = new Vue({
            el: '#propuestas_board',
            data: {
                descripcion: 'Listado de propuestas de los candidatos',
                hora: '29 de marzo 2021',
                propuestas: [],
                propuesta: {
                    titulo: null,
                    detalle: null,
                    secunda_asoc: null,
                    secunda_asoc_id: null,
                    user_id: $("#numero_asoc").val(),
                    user_name: $("#nombre_asoc").val(),
                    // user_id: document.getElementById('numero_asoc').value,
                    // user_name: document.getElementById('nombre_asoc').value,
                },
            },
            
            created() {
                this.cargarPropuestas();
            }, 

            methods: {
                cargarPropuestas: function() {
                    id = $("#numero_asoc").val();

                    axios.get('/cliente/propuestas/'+id)
                    .then( (response) => {
                        this.propuestas = response.data;
                        this.loaded = true;
                    })
                    .catch( function(err) {
                        alert("Hubo un error: " + err);
                    });
                },
                registrar: function(event) {
                    event.preventDefault();

                    if ( this.propuesta.titulo == null || this.propuesta.titulo == '' || this.propuesta.titulo ==undefined || this.propuesta.titulo.length <=0) 
                    {
                        lobibox_emergente('warning','top right',true,"Debe al menos, ingresar un titulo para su propuesta.");
                        
                        return false;
                    }

                    if ( this.propuesta.secunda_asoc == null || this.propuesta.secunda_asoc == '' || this.propuesta.secunda_asoc ==undefined || this.propuesta.secunda_asoc.length <=0) 
                    {
                        lobibox_emergente('warning','top right',true,"Debe ingresar el nombre de quien secunda su propuesta.");
                        
                        return false;
                    }

                    if ( this.propuesta.secunda_asoc_id == null || this.propuesta.secunda_asoc_id == '' || this.propuesta.secunda_asoc_id ==undefined || this.propuesta.secunda_asoc_id.length <=0) 
                    {
                        lobibox_emergente('warning','top right',true,"Debe ingresar un el número de asociado que secunda su propuesta.");
                        
                        return false;
                    }

                    axios.post('/cliente/propuesta/store', {
                        propuesta: this.propuesta
                    }).then( response => {
                        this.cargarPropuestas();
                        if (response.status == 201) {
                            lobibox_emergente('success','top right', true, 'Propuesta Registrada.');
                            // setTimeout(function(){ location.reload();  }, 2000);
                        }
                    }).catch( err => {
                        lobibox_emergente('warning','top right',true,"Hubo un error: " + err);
                    });
                },
                /* like: function(id) {
                    axios.put('api/propuesta/'+id, {
                        like: 1,
                    })
                    .then( response => {
                        newObj = this.propuestas.filter( function(elem) {
                            elem.aprovaciones = response.data.aprovaciones;
                        })
                    })
                    .catch( err => {
                        alert("Hubo un error: " + err);
                    });
                },
                dislike: function(id) {
                    axios.put('api/propuesta/'+id, {
                        like: -1,
                    })
                    .then( response => {
                        // this.cargarPropuestas();
                    })
                    .catch( err => {
                        alert("Hubo un error: " + err);
                    });
                },
                actualizarPropuesta: function() {

                } */
            }
        });
    </script>
@stop	   




