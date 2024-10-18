@extends('adminlte::page')

@section('content_header')
<h1><b>Categorias/Listado de Categorias </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Categorias Registradas</h3>
                <div class="card-tools">
                    <a href="/admin/categorias/create" class="btn btn-primary"><i class="fa fa-plus"></i> Crear Nuevo</a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped table-hover table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre de la Categoria</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" style="text-align: center">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contador = 1;
                        @endphp
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $contador++ }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->descripcion }}</td>
                            <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ url('/admin/categorias',$categoria->id) }}" class="btn btn-info btn-sm"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ url('/admin/categorias/'.$categoria->id.'/edit') }}" class="btn btn-success btn-sm"><i
                                        class="fas fa-pencil"></i></a>
                                <form action="{{ url('/admin/categorias',$categoria->id) }}" method="post"
                                    onclick="preguntar{{ $categoria->id }}(event)" id="miFormulario{{ $categoria->id }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                                <script>
                                    function preguntar{{ $categoria->id }}(event){
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
                                                    var form = $('#miFormulario{{ $categoria->id }}');
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

@stop
