@extends('cliente::layouts.master')

@section('content')
    <div class="card mt-2 mb-2">
        <div class="card-header text-center">
            <div class="" style="float: left;">
                <img src="/images/logo-cooperativa.png" alt="" style="height:90px;">
            </div>
            <div>
                <h4><b>COOPERATIVA PROFESIONALES, R.L.</b></h4>
                <p><i><b>Éxito, cooperación y confianza</b></i></p>
                <h4>Inscripción a la Reunión Capitular</h4>
            </div>
        </div>
        <div class="card-body" id="register_form" >
            <div class="form-row">
                <div class="col-md-12">
                    <p>Tema: <span><strong>{{ $nombreevento }}</strong></span></p>
                    {{-- <p>Tema: <span><strong>@{{ tema }}</strong></span></p> --}}
                </div>
                <div class="col-md-12" style="display:none">
                    <p>Descripción: <span><strong>@{{ descripcion }}</strong></span></p>
                    {{-- <p>Descripción: <span><strong>@{{ descripcion }}</strong></span></p> --}}
                </div>
                <div class="col-md-12">
                    {{-- <p>Hora: <span><strong>@{{ hora }}</strong></span></p> --}}
                    <p>Hora: <span><strong>{{ $f_inicia }}</strong></span></p>
                </div>
            </div>
            <hr>
            <div class="col-sm-12 col-md-12 col-lg-12">
                {!! $mensaje !!}
            </div>
            <hr>
            @if($existecuentazoom==0)
                <form action="" method="">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 col-sm-12">
                            <label for="numero_asoc">Número de Asociado:</label>
                            <input type="text" class="form-control" placeholder="Ejemplo: 101"
                                value="{{ $cldoc }}" disabled>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="nombre_asoc">Nombre:</label>
                            <input type="text" class="form-control" placeholder="Ejemplo:Juan"
                                value="{{ $nombre }}" disabled>
                        </div>
                    </div>
                    <br>
                    <div class="form-row mb-2">
                        <div class="col-md-6 col-sm-12">
                            <label for="email">Dirección de Correo Electronico:</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Ejemplo: juan.perez@cooprofesionales.com.pa"
                                v-model="datos.email">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="email_confirmation">Confirmar Correo Electronico:</label>
                            <input id="email_confirmation" name="email_confirmation" type="email" class="form-control" placeholder="Ejemplo: juan.perez@cooprofesionales.com.pa"
                                v-model="datos.email_confirmation">
                        </div>
                    </div><br>
                    <div>
                        <input type="hidden" name="numero_asoc" value="{{ $cldoc }}" id="numero_asoc">
                        <input type="hidden" name="nombre_asoc" value="{{ $nombre }}" id="nombre_asoc">
                        <input type="hidden" name="tipoevent" value="{{ $tipoevent }}" id="tipo_event">
                        <input type="hidden" name="id_evento" value="{{ $id_evento }}" id="id_evento">
                        <input type="hidden" name="agencia" value="{{ $agencia }}" id="agencia">
                        <input type="hidden" name="trato" value="{{ $trato }}" id="trato">
                        <input type="hidden" name="fecha_nac" value="{{ $fecha_nac }}" id="fecha_nac">
                        {{-- <input type="hidden" name="asistire" value="{{ $asistire }}" id="asistire"> --}}
                        {{-- <input type="hidden" name="soy_aspirante" value="{{ $soy_aspirante }}" id="soy_aspirante"> --}}
                        {{-- <input type="hidden" name="cantidato_delegado" value="{{ $cantidato_delegado }}" id="cantidato_delegado"> --}}
                        {{-- <input type="hidden" name="junta_directores" value="{{ $junta_directores }}" id="junta_directores"> --}}
                        {{-- <input type="hidden" name="comite_credito" value="{{ $comite_credito }}" id="comite_credito"> --}}
                        {{-- <input type="hidden" name="junta_vigilancia" value="{{ $junta_vigilancia }}" id="junta_vigilancia"> --}}
                    </div>
                    <button class="btn btn-primary" @click="registrar($event)">Registrarme</button>
                </form>
            @else
                <a type="button"style="" href="{{ env('APP_URL', './') }}/cliente/dashboard/?wget={{ $enlace["wget"] }}&id_evento={{ $enlace["id_evento"] }}" class="btn btn-block btn-success" >INGRESAR EN PANEL</a>
            @endif
        </div>
    </div>
@endsection()

@section('page-script')

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const app = new Vue({
            el: '#register_form',
            // components: { App }
            data: {
                tema: 'Seminario de prueba',
                descripcion: 'Seminario web en zoom (prueba)',
                hora: '29 de febrero 2021',
                asociados: [],
                datos: {
                    numero_asoc: $("#numero_asoc").val(),
                    // apellido_asoc: $("#nombre_asoc").val(),
                    nombre_asoc: $("#nombre_asoc").val(),
                    email: null,
                    email_confirmation: null,
                    tipoevent: $("#tipo_event").val(),
                    id_evento: $("#id_evento").val(),
                    agencia: $("#agencia").val(),
                    trato: $("#trato").val(),
                    fecha_nac: $("#fecha_nac").val(),
                    asistire: 1,
                    f_asistire_regis: moment().format('YYYY-MM-DD HH:mm:ss'),
                    // soy_aspirante: $("#soy_aspirante").val(),
                    // cantidato_delegado: $("#cantidato_delegado").val(),
                    // junta_directores: $("#junta_directores").val(),
                    // comite_credito: $("#comite_credito").val(),
                    // junta_vigilancia: $("#junta_vigilancia").val(),
                }
            },
            
            mounted() {
                this.cargarAsociados();
            }, 

            methods: {
                cargarAsociados: function() {
                   /*  axios.get('/api/asociados')
                    .then( (response) => {
                        this.asociados + response.data.data;
                    })
                    .catch( function(err) {
                        // alert("Hubo un error: " + err);
                    }); */
                },
                registrar: function(event) {
                    event.preventDefault();
                    
                    if(this.datos.email!=null && this.datos.email_confirmation!=null) {

                        if (this.datos.email == this.datos.email_confirmation) {
                            axios.post('cliente/inscripcion/guardaasistencia', {
                                datos: this.datos
                            }).then( response => {
                                if (response.status == 200) {
                                    lobibox_emergente('success','top right',true,'Registro Guardado.');
                                    setTimeout(function(){ location.reload();  }, 2000);
                                }
                            }).catch( err => {
                                lobibox_emergente('warning','top right',true,"Hubo un error: " + err);
                            });
                        } else {
                            lobibox_emergente('warning','top right',true,"Ambos campos de dirección de correo no coinciden.");
                        }
                    } else {
                        lobibox_emergente('warning','top right',true,"Llene ambos campos de dirección de correo y la confirmación del mismo.");
                    }
                }
            }
        });
    </script>
@stop	   
