@extends('adminlte::page')

@section('content_header')
<h1><b>Compras/Modificar datos de la compra</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Modificar los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/compras', $compra->id) }}" id="form_compra" method="post" >
                    @csrf
                    @method('put')
                    <input type="text" value="{{ $compra->id }}" id="id_compra" name="id_compra" hidden>
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
                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_proveedor">Buscar Proveedor</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal_proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Listado de Proveedores</h5>
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
                                                                <th scope="col">Empresa</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Nombre del Proveedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($proveedores as $proveedor)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td style="text-align: center; vertical-align: middle">
                                                                        <button class="btn btn-info seleccionar-btn-proveedor" data-id="{{ $proveedor->id }}" data-empresa="{{ $proveedor->empresa }}" type="button">Seleccionar</button>
                                                                    </td>
                                                                    <td>{{ $proveedor->empresa }}</td>
                                                                    <td>{{ $proveedor->telefono }}</td>
                                                                    <td>{{ $proveedor->nombre }}</td>
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

                                </div>

                                <div class="col-md-2">
                                    <input type="text" class="form-control" id="empresa_proveedor" value="{{ $compra->detalles->first()->proveedor->empresa }}" disabled>
                                    <input type="text" class="form-control" id="id_proveedor" value="{{$compra->detalles->first()->proveedor->id}}" name="proveedor_id">
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
                                        $total_compra = 0;
                                    @endphp
                                    @foreach ($compra->detalles as $detalle)
                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>{{ $detalle->producto->codigo }}</td>
                                            <td>{{ $detalle->cantidad }}</td>
                                            <td>{{ $detalle->producto->nombre }}</td>
                                            <td>{{ $detalle->producto->precio_compra }}</td>
                                            <td>{{ $costo = $detalle->cantidad * $detalle->producto->precio_compra }}</td>
                                            <td style="text-align: center">
                                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $detalle->id }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @php
                                            $total_cantidad += $detalle->cantidad;
                                            $total_compra += $costo;
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align: right"><b>Total Cantidad</b></td>
                                        <td style="text-align: center"><b>{{ $total_cantidad }}</b></td>
                                        <td colspan="2" style="text-align: right"><b>Total Compra</b></td>
                                        <td style="text-align: center"><b>{{ $total_compra }}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Columna para los campos (Derecha) -->
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de Compra</label>
                                        <input type="date" class="form-control" value="{{ $compra->fecha }}" name="fecha" required>
                                        @error('fecha')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="comprobante">Comprobante</label>
                                        <input type="text" class="form-control" value="{{ $compra->comprobante }}" name="comprobante" required>
                                        @error('comprobante')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="precio_total">Precio Total</label>
                                        <input type="text" style="text-align: center; background:rgb(235, 170, 8)" class="form-control" value="{{ $total_compra }}" name="precio_total" required>
                                        @error('precio_total')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="row"> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-lg btn-block"><i class="fas fa-save"></i>
                                                Actualizar Compra</button>
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
        // alert(id);
        if(id){
            $.ajax({
                url: "{{ url('/admin/compras/detalle') }}/"+id,
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
            var id_compra = $('#id_compra').val();
            var id_proveedor = $('#id_proveedor').val();
            if(codigo.length > 0){
                $.ajax({
                    url: "{{ route('admin.detalle.compras.store') }}",
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        codigo: codigo,
                        cantidad: cantidad,
                        id_compra: id_compra,
                        id_proveedor: id_proveedor
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
                        } else {
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
