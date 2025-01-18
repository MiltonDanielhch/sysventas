@extends('adminlte::page')

@section('content_header')
<h1><b>Clientes/Datos del Cliente </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Datos Registrados</h3>
            </div>

            <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre del Cliente</label>
                                <p>{{ $cliente->nombre_cliente }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nit del/Codigo Cliente</label>
                                <p>{{ $cliente->nit_codigo }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Telefono</label>
                                <p>{{ $cliente->telefono }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <p>{{ $cliente->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/clientes') }}" class="btn btn-secondary"> Cancelar</a>
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
