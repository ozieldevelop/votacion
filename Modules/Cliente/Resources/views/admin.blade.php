@extends('cliente::layouts.master_tablero')


@section('content')
    <div class="card col-md-12">
        <div class="card-header"><h3>Control de Propuestas</h3></div>
        <div class="card-body">
            <div id="control_table">
                <template>
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Título</th>
                            <th scope="col">Detalle</th>
                            <th scope="col">Creador</th>
                            <th scope="col"># Asociado</th>
                            <th scope="col">Secundador</th>
                            <th scope="col"># Asociado</th>
                            <th scope="col" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in propuestas" :key="index">
                            <th scope="row">@{{ item.id }}</th>
                            <td>@{{ item.titulo }}</td>
                            <td>@{{ item.detalle }}</td>
                            <td>@{{ item.user_name }}</td>
                            <td>@{{ item.user_id }}</td>
                            <td>@{{ item.secunda_asoc }}</td>
                            <td>@{{ item.secunda_id }}</td>
                            <td>
                                <button v-if="!item.estado" class="btn btn-info" @click="aprobarPropuesta(item, true)">
                                    Aprobar
                                </button>
                                <button v-else class="btn btn-warning" @click="aprobarPropuesta(item, false)">
                                    Deshabilitar
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger" @click="eliminarPropuesta(item)">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    </thead>
                </table>
                </template>
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        
        margin-bottom: 0px;
    }
    
    /* td.wrapper {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 200px;
    } */

    /* td.wrapper:hover {
        overflow: visible;
    } */

</style>
  
@section('page-script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        const app = new Vue({
            el: '#control_table',
            data: {
                propuestas: null,
            },
            created() {
                this.cargarPropuestas();
            },
            methods: {
                cargarPropuestas: function() {
                    axios.get('/cliente/propuestas')
                    .then( (response) => {
                        this.propuestas = response.data;
                    })
                    .catch( function(err) {
                        alert("Hubo un error: " + err);
                    });
                },
                aprobarPropuesta: function (item, estado) {
                    axios.put('/cliente/propuesta/'+item.id, {
                        estado: estado,
                    })
                    .then( response => {
                        this.cargarPropuestas();
                    })
                    .catch( err => {
                        alert("Hubo un error: " + err);
                    });
                },
                eliminarPropuesta: function (item) {
                    axios.delete('/cliente/propuesta/'+item.id)
                    .then(response => {
                        this.cargarPropuestas();
                    })
                    .catch(err => {
                        alert("Hubo un error: " + err);
                    });
                },
            }
        })
    </script>
@stop
