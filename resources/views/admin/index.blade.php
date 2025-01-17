@extends('adminlte::page')


@section('content_header')
<h1><b>Bienvinido {{ $empresa->nombre_empresa }}</b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <a href="{{ url('/admin/roles') }}" class="info-box-icon bg-info">
                <span class=""><i class="fas fa-user-check"></i></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Roles registrados</span>
                <span class="info-box-number">{{ $total_roles }} Roles</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <a href="{{ url('/admin/usuarios') }}" class="info-box-icon bg-info">
                <span class=""><i class="fas fa-users"></i></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Usuarios registrados</span>
                <span class="info-box-number">{{ $total_usuarios }} Usuarios</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <a href="{{ url('/admin/categorias') }}" class="info-box-icon bg-success">
                <span class=""><i class="fas fa-tags"></i></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Categorias registrados</span>
                <span class="info-box-number">{{ $total_categorias }} Categorias</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <a href="{{ url('/admin/productos') }}" class="info-box-icon bg-warning">
                <span class=""><i class="fas fa-list"></i></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Productos registrados</span>
                <span class="info-box-number">{{ $total_productos }} Productos</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box">
            <a href="{{ url('/admin/proveedores') }}" class="info-box-icon bg-warning">
                <span class=""><i class="fas fa-list"></i></span>
            </a>
            <div class="info-box-content">
                <span class="info-box-text">Proveedores registrados</span>
                <span class="info-box-number">{{ $total_proveedores }} Proveedores</span>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')

@stop
