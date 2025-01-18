@extends('adminlte::page')

@section('content_header')
<h1><b>Clientes/registro de un nuevo Cliente </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los Roles</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/clientes/create') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre del Cliente</label>
                                <input type="text" class="form-control" value="{{ old('nombre_cliente') }}" name="nombre_cliente">
                                @error('nombre_cliente')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nit del/Codigo Cliente</label>
                                <input type="text" class="form-control" value="{{ old('nit_cliente') }}" name="nit_cliente">
                                @error('nit_cliente')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Telefono</label>
                                <input type="text" class="form-control" value="{{ old('telefono') }}" name="telefono">
                                @error('telefono')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <input type="text" class="form-control" value="{{ old('email') }}" name="email">
                                @error('email')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
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

@stop
