@extends('adminlte::page')

@section('content_header')
<h1><b>Ventas/Listado de Ventas </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ventas Registrados</h3>
                <div class="card-tools">
                    <a href="/admin/ventas/create" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo</a>
                </div>
            </div>

            <div class="card-body">
                <table id="mitabla" class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Precio Total</th>
                            <th scope="col">Productos</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 1;
                        @endphp
                        @foreach ($ventas as $venta)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ $venta->fecha }}</td>
                            <td>{{ $venta->precio_total }}</td>
                            <td>
                                <ul>
                                    @foreach ($venta->detallesVenta as $detalle)
                                        <li>{{ $detalle->producto->nombre. ' '.$detalle->cantidad.' Unidades' }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('/admin/ventas',$venta->id) }}" class="btn btn-info btn-sm"><i
                                        class="fas fa-eye"></i></a>
                                        <a href="{{ url('/admin/ventas/'.$venta->id.'/edit') }}" class="btn btn-success btn-sm"><i
                                        class="fas fa-pencil"></i></a>
                                        <a href="{{ url('/admin/ventas/pdf/'.$venta->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fas fa-print"></i></a>
                                <form action="{{ url('/admin/ventas',$venta->id) }}" method="post"
                                    onclick="preguntar{{ $venta->id }}(event)" id="miFormulario{{ $venta->id }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                                <script>
                                    function preguntar{{ $venta->id }}(event){
                                        event.preventDefault();
                                        Swal.fire({
                                            title: "¿Desea Eliminar este registro?",
                                            text: "",
                                            icon: "question",
                                            showCancelButton: true,
                                            confirmButtonColor: "#3085d6",
                                            cancelButtonColor: "#d33",
                                            cancelButtonText: "Cancelar",
                                            confirmButtonText: "Eliminar"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    var form = $('#miFormulario{{ $venta->id }}');
                                                    form.submit();
                                                    // title: "Deleted!",
                                                    // text: "Your file has been deleted.",
                                                    // icon: "success"
                                                }
                                        });
                                    }
                                </script>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
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
    </script>
@stop
