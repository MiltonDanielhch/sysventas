<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistemas de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    @php
    // Ruta absoluta de la imagen en el servidor
    $imagenPath = public_path('storage/'.$empresa->logo);

    // Verificar si el archivo existe antes de proceder
    if (file_exists($imagenPath)) {
        $imagenBase64 = base64_encode(file_get_contents($imagenPath));  // Convertir a base64
        $imagenSrc = "data:image/jpeg;base64," . $imagenBase64;  // Cambiar tipo si es diferente
    } else {
        $imagenSrc = '';  // Si no existe, no mostrar imagen
    }
@endphp

<!-- Usar la imagen base64 en la etiqueta <img> -->
<table border="0" style="font-size: 8pt">
    <tr>
        <td style="text-align:center">
            @if($imagenSrc)
                <img src="{{ $imagenSrc }}" alt="logo" width="100px">
            @else
                <p>Imagen no encontrada</p>
            @endif
        </td>
        <td width="500px"></td>
        <td style="text-align:center">
            <b>NIT: </b>{{ $empresa->nit }}<br>
            <b>Nro de Factura: </b>{{ $venta->id }}<br>
        </td>
        <tr>
            <td style="text-align:center">
                {{ $empresa->nombre_empresa }}<br>
                {{ $empresa->tipo_empresa }}<br>
                {{ $empresa->correo }}<br>
                Telf: {{ $empresa->telefono }}<br>
            </td>
            <td with="500px" style="text-align: center"><h1>FACTURA</h1></td>
            <td style="text-align: center"><h4>ORIGNAL</h4></td>
        </tr>
    </tr>
</table>

<br>

<?php
// Mapeo manual de los meses en español
$meses = [
    '01' => 'enero', '02' => 'febrero', '03' => 'marzo', '04' => 'abril', '05' => 'mayo', '06' => 'junio',
    '07' => 'julio', '08' => 'agosto', '09' => 'septiembre', '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre'
];

$fecha_db = $venta->fecha; // Suponiendo que $fecha_db es una fecha en formato 'Y-m-d' (ejemplo: '2025-01-19')
$fecha_parts = explode('-', $fecha_db); // Dividimos la fecha en año, mes y día
$dia = $fecha_parts[2]; // Día
$mes = $meses[$fecha_parts[1]]; // Mes en español
$anio = $fecha_parts[0]; // Año

$fecha_formateada = "$dia de $mes de $anio"; // Formato final: "19 de enero de 2025"
?>

<table border="1">
    <tr>
        <td width="400px"><b>Fecha: </b><?php echo $fecha_formateada; ?></td>
        <td width="100px"></td>
        <td><b>Nit/CI: </b>{{$venta->cliente->nit_codigo}}</td>
    </tr>
    <tr>
        <td><b>Señor(es): </b>{{$venta->cliente->nombre_cliente}}</td>
    </tr>
</table>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
    <br>
    <div class="container mt-4">
        <table>
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>SubTotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $contador = 1;
                    $subtotal = 0
                @endphp
                @foreach ($venta->detallesVenta as $detalle)
                    @php
                        $subtotal = $detalle->cantidad * $detalle->producto->precio_venta
                    @endphp
                    <tr>
                        <td>{{ $contador }}</td>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->producto->descripcion }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ $moneda->symbol . " " . $detalle->producto->precio_venta }}</td>
                        <td>{{ $subtotal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
