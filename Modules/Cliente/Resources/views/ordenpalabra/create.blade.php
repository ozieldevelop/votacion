@extends('cliente::ordenpalabra.layout.template')

@push('plugincss')
<link rel="stylesheet" href="{{ Module::asset('cliente:plugins/nestable/nestable.css') }}"/>
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
                <p class="lead"><a href="#newModal" class="btn btn-success pull-right" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo Tema</a> Lista</p>
                <div class="dd" id="nestable">
                    {!!$tema!!}
                </div>

                <div class="callout callout-success" id="success-indicator" style="display:none; margin-right: 10px;margin-top: 10px;">
                    <h4>Se ha guardado correctamente! <span class="glyphicon glyphicon-ok"></span></h4>
                    <!--<p>This is a green callout.</p>-->
                </div>
            </div><!-- end panel-body -->
            <div class="panel-footer"></div><!-- end panel-footer -->
        </div>
    </div>
</div> <!-- end row -->


<!-- Modal para crear los Item -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('orden.insert') }}" class="form-horizontal" role="form">
                @csrf()
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Agregar Tema</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Tema</label>
                        <div class="col-lg-10">
                            <input type="text" name="titulo" class="form-control" id="mnu_text" placeholder="Agregar tema o sub tema">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Crear <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edite Menu dialog -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('orden.update') }}" class="form-horizontal" role="form">
                @method('PUT')
                @csrf()
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Editar Tema</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Tema</label>
                        <div class="col-lg-10">
                            <input type="text" name="titulo" class="form-control" id="mnu_text">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar <i class="fa fa-refresh"></i></button>
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

    <script>
        (function ($) {
            "use strict";

            $('.dd').nestable({
                dropCallback: function(details) {

                    var order = new Array();
                    
                    $("li[data-id='"+details.destId +"']")
                    .find('ol:first')
                    .children()
                    .each(function(index,elem) {
                        order[index] = $(elem).attr('data-id');
                    });

                    if (order.length === 0){
                        var rootOrder = new Array();
                        
                        $("#nestable > ol > li").each(function(index,elem) {
                            rootOrder[index] = $(elem).attr('data-id');
                        });
                    }

                    var token = $('form').find( 'input[name=_token]' ).val();
                    
                    $.post('{{url("ordenpab/reorder")}}',
                    {
                        source : details.sourceId,
                        destination: details.destId,
                        order:JSON.stringify(order),
                        rootOrder:JSON.stringify(rootOrder),
                        _token: token
                    },
                    function(data) {
                        
                        console.log('data '+JSON.stringify(data));
                    })
                    .done(function(infod) {
                        $( "#success-indicator" ).fadeIn(300).delay(3000).fadeOut();
                    })
                    .fail(function(info) {
                        console.log('erro '+JSON.stringify(info) );
                    })
                    .always(function() {  });
                }
            });

            $(".edit_toggle").on('click', function(e){
                e.preventDefault();
                var tema = JSON.parse( $(this).attr('rel') );
                $.each(tema, function(key, value) {
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