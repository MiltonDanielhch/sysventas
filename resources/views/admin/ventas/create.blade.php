@extends('adminlte::page')

@section('content_header')
<h1><b>Ventas/registro de un nueva venta</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/ventas/create') }}" id="form_venta" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="number" id="cantidad" class="form-control" style="text-align: center; background:antiquewhite"  value="1"
                                        name="cantidad">
                                        @error('cantidad')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="codigo">Codigo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                          </div>
                                          <input id="codigo" type="text" class="form-control" placeholder="codigo">
                                        @error('codigo')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div style="height: 32px"></div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-search"></i></button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Listado de Productos</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="mitabla" class="table table-striped table-hover table-sm table-responsive">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col" style="text-align: center">Acción</th>
                                                                    <th scope="col">Categoría</th>
                                                                    <th scope="col">Código</th>
                                                                    <th scope="col">Nombre</th>
                                                                    <th scope="col">Descripción</th>
                                                                    <th scope="col">Stock</th>
                                                                    <th scope="col">Precio Compra</th>
                                                                    <th scope="col">Precio Venta</th>
                                                                    <th scope="col">Imagen</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($productos as $producto)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td style="text-align: center; vertical-align: middle">
                                                                            <button class="btn btn-info seleccionar-btn" data-id="{{ $producto->codigo }}" type="button">Seleccionar</button>
                                                                        </td>
                                                                        <td>{{ $producto->categoria->nombre }}</td>
                                                                        <td style="vertical-align: middle">{{ $producto->codigo }}</td>
                                                                        <td>{{ $producto->nombre }}</td>
                                                                        <td>{{ $producto->descripcion }}</td>
                                                                        <td>{{ $producto->stock }}</td>
                                                                        <td>{{ $producto->precio_compra }}</td>
                                                                        <td>{{ $producto->precio_venta }}</td>
                                                                        <td>
                                                                            <img src="{{ url('storage/'.$producto->imagen) }}" width="10%" alt="imagen">
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <!-- Aquí puedes añadir botones si es necesario -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{ url('/admin/productos/create') }}" type="button" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_cliente">Buscar Cliente</button>
                                    <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#exampleModal_crear_cliente"><i class="fas fa-plus"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Listado de Clientes</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <table id="mitabla2" class="table table-striped table-hover table-sm table-responsive">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col" style="text-align: center">Acción</th>
                                                                <th scope="col">Nombre del Cliente</th>
                                                                <th scope="col">Nit/Codigo</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($clientes as $cliente)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td style="text-align: center; vertical-align: middle">
                                                                        <button class="btn btn-info seleccionar-btn-cliente" data-id="{{ $cliente->id }}" data-nit="{{ $cliente->nit_codigo }}" data-nombrecliente="{{ $cliente->nombre_cliente }}" type="button">Seleccionar</button>
                                                                    </td>
                                                                    <td>{{ $cliente->nombre_cliente }}</td>
                                                                    <td>{{ $cliente->nit_codigo }}</td>
                                                                    <td>{{ $cliente->telefono }}</td>
                                                                    <td>{{ $cliente->email }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- Aquí puedes añadir botones si es necesario -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_crear_cliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo cliente</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name">Nombre del Cliente</label>
                                                                    <input type="text" class="form-control" value="{{ old('nombre_cliente') }}" id="nombre_cliente" >
                                                                    @error('nombre_cliente')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name">Nit del/Codigo Cliente</label>
                                                                    <input type="text" class="form-control" value="{{ old('nit_cliente') }}" id="nit_cliente" >
                                                                    @error('nit_cliente')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name">Telefono</label>
                                                                    <input type="text" class="form-control" value="{{ old('telefono') }}"  id="telefono">
                                                                    @error('telefono')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="name">Email</label>
                                                                    <input type="text" class="form-control" value="{{ old('email') }}"  id="email">
                                                                    @error('email')
                                                                        <small style="color:red;">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <!-- Aquí puedes añadir botones si es necesario -->
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar</button>
                                                    <button type="button" onclick="guardar_cliente()" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label for="">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="nombre_cliente_select" value="S/N" disabled>
                                    <label for="">Nit/Codigo</label>
                                    <input type="text" class="form-control" id="nit_cliente_select" value="0" disabled>
                                    <input type="text" class="form-control" id="id_cliente" name="cliente_id" hidden>
                                </div>
                                {{-- <hr> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Columna para la tabla (Izquierda) -->
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
                                    @foreach ($tmp_ventas as $tmp_venta)
                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>{{ $tmp_venta->producto->codigo }}</td>
                                            <td>{{ $tmp_venta->cantidad }}</td>
                                            <td>{{ $tmp_venta->producto->nombre }}</td>
                                            <td>{{ $tmp_venta->producto->precio_venta }}</td>
                                            <td>{{ $costo = $tmp_venta->cantidad * $tmp_venta->producto->precio_venta }}</td>
                                            <td style="text-align: center">
                                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $tmp_venta->id }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @php
                                            $total_cantidad += $tmp_venta->cantidad;
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

                        <!-- Columna para los campos (Derecha) -->
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de Compra</label>
                                        <input type="date" class="form-control" value="{{ old('fecha',date('Y-m-d')) }}" name="fecha" required>
                                        @error('fecha')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="precio_total">Precio Total</label>
                                        <input type="text" style="text-align: center; background:rgb(235, 170, 8)" class="form-control" value="{{ $total_venta }}" name="precio_total" required>
                                        @error('precio_total')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="row"> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-save"></i>
                                                Registrar Venta</button>
                                        </div>
                                    </div>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    function guardar_cliente(){
        const data = {
            nombre_cliente: $('#nombre_cliente').val(),
            nit_cliente: $('#nit_cliente').val(),
            telefono: $('#telefono').val(),
            email: $('#email').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '{{ route("admin.ventas.cliente.store" )}}',
            type: 'POST',
            data: data,
            success:function (response){
                if(response.success){
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Se Agrego al Cliente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        location.reload();
                    }else{
                        alert('El cliente no fue eliminado');
                    }
            },
            error: function (xhr, status, error){
                alert('error, no se pudo registrar al cliente');
            }
        });
    }

    $('.seleccionar-btn-cliente').click(function(event) {
        event.preventDefault();  // Evitar el envío del formulario

        var id_cliente = $(this).data('id');
        var nombre_cliente = $(this).data('nombrecliente');
        var nit_codigo = $(this).data('nit');

        $('#nombre_cliente_select').val(nombre_cliente);
        $('#nit_cliente_select').val(nit_codigo);
        $('#id_cliente').val(id_cliente);

        // Cierra el modal
        $('#exampleModal_cliente').modal('hide');
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
                url: "{{ url('/admin/ventas/create/tmp') }}/"+id,
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
    $('#form_venta').on('keypress', function(e){
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
                    url: "{{ route('admin.ventas.tmp_ventas') }}",
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
