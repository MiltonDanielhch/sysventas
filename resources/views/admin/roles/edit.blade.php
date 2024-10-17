@extends('adminlte::page')

@section('content_header')
<h1><b>Roles/Modificar rol </b></h1>
<hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Ingrese los Roles</h3>
            </div>

            <div class="card-body">
                <form action="{{ url('/admin/roles',$role->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre del Rol</label>
                                <input type="text" class="form-control" value="{{ $role->name }}" name="name">
                                @error('name')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Modificar</button>
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
