@extends('cliente::ordenpalabra.layout.template')

@push('plugincss')
<link rel="stylesheet" type="text/css" href="{{ Module::asset('cliente:plugins/nestable/nestable.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ Module::asset('cliente:plugins/select2/css/select2.min.css') }}">

    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #337ab7;
            font-size: 20px;
            color: #fff;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
            color: #fff;
        }
    </style>
@endpush

@section('header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Crear árbol de temas<small>crear temas y subtemas</small></h1>
</section>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8">
        
        <div class="panel panel-primary">
            <div class="panel-heading">Añadir tema al árbol</div>

            <div class="panel-body">
                <div class="dd" id="nestable">
                    {!!$tema!!}
                </div>
            </div><!-- end panel-body -->
            
            </div><!-- end panel-footer -->
        </div>
    </div>
</div> <!-- end row -->

<!-- Modal Suscribir -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('orden.suscriptores.add') }}" class="form-horizontal" role="form">
                @csrf()
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Suscribir Asociados</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subs" class="col-lg-2 control-label">Tema</label>
                        <div class="col-lg-10">
                            <select name="suscriptores[]" class="form-control select2" multiple="multiple" data-placeholder="Selecciona los Asocidos" id="subs" style="width: 100%;">
                                @foreach ($datacliente as $cli)
                                    <option value="{{ $cli->CLDOC }}">{{ $cli->NOMBRE }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">suscribir <i class="fa fa-users"></i></button>
                </div>

                <input type="hidden" name="id">
                <input type="hidden" name="parent_id">
            </form>
        </div>
    </div>
</div>

<!-- Delete Menu dialog -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('orden.delete')}}" method="post">
                @method('DELETE')
                @csrf()
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Eliminar Tema</h4>
                </div>
                <div class="modal-body">
                    <p>Deseas Eliminar el Tema ?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="" />
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Si <i class="fa fa-trash"></i></button>
                </div>

                <input type="hidden" name="id">
            </form>
        </div>
    </div>
</div>

@endsection

@push('pluginjs')
<script src="{{ Module::asset('cliente:plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ Module::asset('cliente:plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        (function ($) {
            "use strict";

            //Nestable Init
            $(".dd").nestable({ maxDepth: 0 });
            //Select2 Init
            
            $(".select2").select2({
                multiple: true,
                allowClear: true,
            });

            $(".edit_toggle").on('click', function(e){
                e.preventDefault();
                var tema = JSON.parse( $(this).attr('rel') );
                $.each(tema, function(key, value) {
                    console.log(value);
                    $('#editModal').find('input[name='+key+']').val(value);
                });
            });

            $('.delete_toggle').click(function(e){
                e.preventDefault();
                $('#deleteModal').find('input[name=id]').val( $(this).attr('rel') );
            });

            $('.alert-dismissible').fadeIn(100).delay(3000).fadeOut();
        })(jQuery);
    </script>
@endpush