@extends('adminlte::page')

@section('content_header')
<h1><b>Proveedores/Modificar datos del Proveedores </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Ingrese los datos</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/proveedores',$proveedor->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Nombre de la Empresa</label>
                                        <input type="text" class="form-control" value="{{ $proveedor->empresa }}"
                                        name="empresa">
                                        @error('empresa')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="direccion">Direccion</label>
                                        <input type="text" class="form-control" value="{{ $proveedor->direccion }}"
                                            name="direccion">
                                        @error('direccion')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" class="form-control" value="{{ $proveedor->telefono }}"
                                            name="telefono">
                                        @error('telefono')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" value="{{ $proveedor->email }}"
                                        name="email">
                                        @error('email')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre del Proveedor</label>
                                        <input type="text" class="form-control" name="nombre" value="{{ $proveedor->nombre }}" required>
                                        @error('nombre')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular del Proveedor</label>
                                        <input type="text" class="form-control" name="celular" value="{{ $proveedor->celular }}" required>
                                        @error('celular')
                                        <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{ url('/admin/proveedores') }}" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>
                                    Modificar</button>
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
