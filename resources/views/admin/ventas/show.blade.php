@extends('adminlte::page')

@section('content_header')
<h1><b>Ventas/Detalle venta</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>

            <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                               <div class="col-md-8">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="background: #343a40; color:white">
                                            <th>Nro</th>
                                            <th>Codigo</th>
                                            <th>Cantidad</th>
                                            <th>Nombre</th>
                                            <th>Costo</th>
                                            <th>Total</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                            $total_cantidad = 0;
                                            $total_venta = 0;
                                        @endphp
                                        @foreach ($venta->detallesVenta as $detalle)
                                            <tr>
                                                <td>{{ $cont++ }}</td>
                                                <td>{{ $detalle->producto->codigo }}</td>
                                                <td>{{ $detalle->cantidad }}</td>
                                                <td>{{ $detalle->producto->nombre }}</td>
                                                <td>{{ $detalle->producto->precio_venta }}</td>
                                                <td>{{ $costo = $detalle->cantidad * $detalle->producto->precio_venta }}</td>
                                            </tr>
                                            @php
                                                $total_cantidad += $detalle->cantidad;
                                                $total_venta += $costo;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="text-align: right"><b>Total Cantidad</b></td>
                                            <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>
                                            <td colspan="2" style="text-align: right"><b>Total Venta</b></td>
                                            <td style="text-align: center"><b>{{ $total_venta }}</b></td>
                                        </tr>
                                    </tfoot>
                                </table>
                               </div>

                                <div class="col-md-4">
                                    <label for="">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="nombre_cliente_select" value="{{ $venta->cliente->nombre_cliente ?? 'S/N' }}" disabled>
                                    <input type="text" class="form-control" id="id_cliente" value="{{ $venta->cliente->nit_codigo ?? 'S/N' }}"  name="cliente_id" hidden>
                                    <label for="">Nit/Codigo</label>
                                    <input type="text" class="form-control" id="nombre_cliente_select" value="{{ $venta->cliente->nit_codigo ?? 'S/N' }}" disabled >

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fecha">Fecha de Venta</label>
                                                <input type="date" class="form-control" value="{{ $venta->fecha }}" name="fecha" disabled>
                                                @error('fecha')
                                                    <small style="color:red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="precio_total">Precio Total</label>
                                                <input type="text" style="text-align: center; background:rgb(235, 170, 8)" class="form-control" value="{{ $total_venta }}" name="precio_total" disabled>
                                                @error('precio_total')
                                                    <small style="color:red;">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div class="row"> --}}
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="{{ url('/admin/ventas') }}" type="submit" class="btn btn-secondary btn-lg btn-block">Volver</a>
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
     $('.seleccionar-btn-proveedor').click(function() {
         var empresa = $(this).data('empresa');
         var id_proveedor = $(this).data('id');

        //  alert(id_proveedor);
        $('#empresa_proveedor').val(empresa);
        $('#id_proveedor').val(id_proveedor);

        // Cierra el modal
        $('#exampleModal_proveedor').modal('hide');


    });
    $('.seleccionar-btn').click(function() {
        var id_producto = $(this).data('id');

        $('#codigo').val(id_producto);

        // Cierra el modal
        $('#exampleModal').modal('hide');

        // Fuerza la actualización del DOM
        setTimeout(function() {
            $('#exampleModal').on('hidden.bs.modal', function () {
                $('#codigo').focus();
                // Redibujar el DOM
                $(document).trigger('resize');
            });
        }, 300);
    });

    $('.delete-btn').click(function(){
        // alert("as");
        var id = $(this).data('id');
        if(id){
            $.ajax({
                url: "{{ url('/admin/compras/create/tmp') }}/"+id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success:function (response){
                    if(response.success){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Se Elimino el Producto",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    }else{
                        alert('El producto no fue eliminado');
                    }
                },
                error:function (error){
                    alert(error);
                }
            });
        }
    });

    $('#codigo').focus();
    $('#form_compra').on('keypress', function(e){
        if(e.keyCode === 13){
            e.preventDefault();
        }
    });

    $('#codigo').on('keyup', function(e){
        if(e.which === 13){
            var codigo = $(this).val();
            var cantidad = $('#cantidad').val();
            if(codigo.length > 0){
                $.ajax({
                    url: "{{ route('admin.compras.tmp_compras') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        codigo: codigo,
                        cantidad: cantidad
                    },
                    success:function (response){
                        if(response.success){
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "El Registro del Producto",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        }else{
                            alert('El producto no fue encontrado');
                        }
                    },
                    error:function (error){
                        alert(error);
                    }
                });
            }
        }
    });
</script>

<script>
    $('#mitabla').DataTable({
       "pageLength": 10,
       "language": {
            "processing": "Procesando...",
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
       }

    });

    $('#mitabla2').DataTable({
       "pageLength": 10,
       "language": {
            "processing": "Procesando...",
            "info": "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
       }

    });
</script>
@stop
