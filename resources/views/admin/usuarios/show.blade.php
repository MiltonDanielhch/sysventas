@extends('adminlte::page')

@section('content_header')
<h1><b>Usuarios/usuario registrado</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">datos registrados</h3>
            </div>

            <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role">Rol del Rol</label>
                                <p>{{ $usuario->roles->pluck('name')->implode(', ') }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Nombre del usuario</label>
                                <p>{{ $usuario->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <p>{{ $usuario->email }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="created_at">Fecha y hora de registro</label>
                                <p>{{ $usuario->created_at }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/usuarios') }}" class="btn btn-primary"><i class="fas fa-save"></i>Volver</a>
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

@stop
