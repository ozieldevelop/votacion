@extends('cliente::layouts.master')

@section('content')


    <div class="row justify-content-center" style="background-color: #fff">
        <div class="col-md-12">
            <div class="card mt-2 mb-2">
                {{-- <div class="card-header"><h4>Formulario de Registro</h4></div> --}}
                <div id="register_form" class="card-body">
                    
                    <div class="text-center" >                        
                        <div style="clear: left;">
                            <p style="float: left;"><img src="/images/logo-cooperativa.png" alt=""></p>
                            <h5><strong>COOPERATIVA PROFESIONALES, R.L.</strong></h5>
                        </div>
                        <div>
                            <i><strong>Éxito, cooperación y confianza</strong></i>
                        </div>
                        <div>
                            <h4>Inscripción al Seminario Web</h4>
                        </div>
                    </div>
                    <hr>                    
                    <div class="form-row">
                        <div class="col-md-12">
                            <p>Tema: <span><strong>{{ $nombreevento }}</strong></span></p>
                            {{-- <p>Tema: <span><strong>@{{ tema }}</strong></span></p> --}}
                        </div>
                        <div class="col-md-12">
                            <p>Descripción: <span><strong>@{{ descripcion }}</strong></span></p>
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
                    <form action="{{ route('postRegistro') }}" method="post">
                        @csrf
                        <hr>
                        <div class="form-row">
                            <div class="col">
                                <label for="numero_asoc">Número de Asociado:</label>
                                <input id="numero_asoc" name="numero_asoc" type="text" class="form-control" placeholder="101">
                            </div>
                            <div class="col">
                                <label for="nombre_asoc">Nombre del Asociado:</label>
                                <input id="nombre_asoc" name="nombre_asoc" type="text" class="form-control" placeholder="Juan Perez">
                            </div>
                        </div>
                        <br>
                        <div class="form-row mb-2">
                            <div class="col">
                                <label for="email">Dirección de Correo Electronico:</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Ejemplo: juan.perez@cooprofesionales.com.pa">
                            </div>
                            <div class="col">
                                <label for="email_confirmation">Confirmar Correo Electronico:</label>
                                <input id="email_confirmation" name="email_confirmation" type="email" class="form-control" placeholder="Ejemplo: juan.perez@cooprofesionales.com.pa">
                            </div>
                        </div><br>
                        <button type="submit" class="btn btn-primary">Registrarme</button>
                    </form>
                </div>
            </div>
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
            },
            
            mounted() {
                this.cargarAsociados();
            }, 

            methods: {
                cargarAsociados: function() {
                    axios.get('/api/asociados')
                    .then( (response) => {
                        this.asociados + response.data.data;
                    })
                    .catch( function(err) {
                        alert("Hubo un error: " + err);
                    });
                }
            }
        });
    </script>
@stop	   
