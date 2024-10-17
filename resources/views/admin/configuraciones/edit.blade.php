@extends('adminlte::page')

@section('content_header')
    <h1><b>Configuraciones/Editar</b></h1>
    <hr>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        {{-- Card Box --}}
        <div class="card card-outline card-success">

            {{-- Card Header --}}
            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                <h3 class="card-title float-none ">
                    Datos Registrados
                </h3>
            </div>

            {{-- Card Body --}}
            <div class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                <form action="{{ url('/admin/configuracion', $empresa->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-md-3">
                             <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png" class="form-control" >
                                @error('logo')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                                <br>
                                <center>
                                    <output id="list">
                                        <img src="{{ asset('storage/'.$empresa->logo) }}" width="80%" alt="logo">
                                    </output>
                                </center>
                                <script>
                                    function archivo(evt){
                                       var files = evt.target.files; //file List objet
                                       //Obtenemos la imagen del campo "file"
                                       for(var i = 0, f; f = files[i]; i++ ){
                                          //solo admitimos imagenes
                                          if(!f.type.match('image.*')){
                                            continue;
                                          }
                                          var reader = new FileReader();
                                          reader.onload = (function (theFile){
                                            return function (e) {
                                                //insertamos la imagen
                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbail" src="',e.target.result,'" width="70%" title="',escape(theFile.name),'"/>'].join('');
                                            };
                                          })(f);
                                          reader.readAsDataURL(f);

                                       }

                                    }
                                    document.getElementById('file').addEventListener('change', archivo, false);
                               </script>
                             </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pais">Pais</label>
                                        <select name="pais" id="select_pais" class="form-control">
                                            @foreach ($paises as $pais)
                                                <option value="{{ $pais->id }}" {{ $empresa->pais == $pais->id ? 'selected':''  }}>{{ $pais->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="departamento">Departamento</label>
                                        <select name="departamento" id="select_departamento_2" class="form-control">
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{ $departamento->id }}" {{ $empresa->departamento == $departamento->id ? 'selected':''  }}>{{ $departamento->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="respuesta_pais">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <select name="ciudad" id="select_ciudad_2" class="form-control">
                                            @foreach ($ciudades as $ciudad)
                                                <option value="{{ $ciudad->id }}" {{ $empresa->ciudades == $ciudad->id ? 'selected':''  }}>{{ $ciudad->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="respuesta_estado">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre_empresa">Nombre de la Empresa</label>
                                        <input type="text" value="{{ $empresa->nombre_empresa }}" name="nombre_empresa"  class="form-control" required>
                                        @error('nombre_empresa')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipo_empresa">Tipo de la Empresa</label>
                                        <input type="text"  value="{{ $empresa->tipo_empresa }}" name="tipo_empresa" class="form-control" required>
                                        @error('tipo_empresa')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nit">NIT</label>
                                        <input type="text"  value="{{$empresa->nit }}" name="nit" class="form-control" required>
                                        @error('nit')
                                            <small style="color:red;">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label>
                                       <select name="moneda" id="" class="form-control">
                                            @foreach ($monedas as $moneda)
                                                <option value="{{ $moneda->id }}" {{ $empresa->moneda == $moneda->id ? 'selected':''  }}>{{ $moneda->symbol }}</option>
                                            @endforeach
                                       </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre_impuesto">Nombre del Impuesto</label>
                                            <input type="text"  value="{{ $empresa->nombre_empresa }}" name="nombre_impuesto" class="form-control" required>
                                            @error('nombre_impuesto')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad_impuesto">Cantidad</label>
                                            <input type="number"  value="{{ $empresa->cantidad_impuesto }}" name="cantidad_impuesto" class="form-control" required>
                                            @error('cantidad_impuesto')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="telefono">Telefono de la Empresa</label>
                                            <input type="text"  value="{{ $empresa->telefono }}" name="telefono" class="form-control" required>
                                            @error('telefono')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="correo">Correo de la Empresa</label>
                                            <input type="email"  value="{{ $empresa->correo }}" name="correo" class="form-control" required>
                                            @error('correo')
                                                <small style="color:red;">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input id="pac-input"  value="{{ $empresa->direccion }}" class="form-control" name="direccion" type="text" placeholder="Buscar..." required>
                                        @error('direccion')
                                        <small style="color:red;">{{ $message }}</small>
                                    @enderror

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="codigo_postal">Codigo Postal</label>
                                        <select name="codigo_postal" id="" class="form-control">
                                            @foreach ($paises as $pais)
                                                <option value="{{ $pais->phone_code }}"{{ $empresa->codigo_postal == $pais->phone_code ? 'selected':''  }}>{{  $pais->phone_code  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn  btn-primary btn-block">Actualizar datos</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- Card Footer --}}
            @hasSection('auth_footer')
                <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                    @yield('auth_footer')
                </div>
            @endif
        </div>
    </div>
</div>

@stop

@section('css')
@stop

@section('js')
<script>
    $('#select_pais').on('change', function(){
        var id_pais = $('#select_pais').val();
        // alert(pais);
        if(id_pais){
            $.ajax({
                url:"{{ url('/admin/configuracion/pais/') }}"+'/'+id_pais,
                type:"GET",
                success: function (data){
                    $('#select_departamento_2').css('display', 'none');
                    $('#respuesta_pais').html(data);
                }
            });
        }else{
            alert('debe seleccionar un pais');
        }
    });
</script>
<script>
    $(document).on('change', '#select_estado', function(){
        var id_estado = $(this).val();
        // alert(id_estado);
        if(id_estado){
            $.ajax({
                url:"{{ url('/admin/configuracion/estado') }}"+'/'+id_estado,
                type:"GET",
                success: function (data){
                    $('#select_ciudad_2').css('display', 'none');
                    $('#respuesta_estado').html(data);
                }
            });
        }else{
            alert('debe seleccionar un estado');
        }
    });
</script>
@stop
