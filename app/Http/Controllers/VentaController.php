<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DetalleVenta;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\TmpCompra;
use App\Models\TmpVenta;
use App\Models\Venta;
// use Barryvdh\DomPDF\PDF;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Nnjeim\World\Models\Currency;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('detallesVenta', 'cliente')->get();
        return view('admin.ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::with('categoria')->get();
        // $productos = Producto::with('empresa_id', Auth::user()->empresa_id)->with('empresa')->get();
        $clientes = Cliente::where('empresa_id', Auth::user()->empresa_id)->with('empresa')->get();
        $session_id = session()->getId();
        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();
        // dd($productos);

        return view('admin.ventas.create', compact('productos', 'clientes', 'tmp_ventas'));
    }

    public function cliente_store(Request $request){
        $validate = $request->validate([
            'nombre_cliente' =>  'required',
            'nit_cliente' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);
        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->nit_codigo = $request->nit_cliente;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->empresa_id = Auth::user()->empresa_id;
        $cliente->save();

        return response()->json(['success'=>true, 'message'=>'se registro al cliente correctamente']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
                // $datos = request()->all();
        // return response()->json($datos);
        $request->validate([
            'fecha' => 'required',
            'precio_total' => 'required',
        ]);
        $session_id = session()->getId();

        $venta = new Venta();
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_total;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->cliente_id = $request->cliente_id;
        $venta->save();

        $tmp_ventas = TmpVenta::where('session_id', $session_id)->get();

        foreach ($tmp_ventas as $tmp_venta){

            $producto = Producto::where('id', $tmp_venta->producto_id)->first();

            $detalle_venta = new DetalleVenta();
            $detalle_venta->cantidad = $tmp_venta->cantidad;
            $detalle_venta->venta_id = $venta->id;
            $detalle_venta->producto_id = $tmp_venta->producto_id;
            $detalle_venta->save();

            $producto->stock -= $tmp_venta->cantidad;
            $producto->save();
        }
        TmpVenta::where('session_id', $session_id)->delete();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'se registro la compra de la manera correcta')
            ->with('icono', 'success');
    }

    public function pdf($id)
    {
        // Obtener la empresa y venta
        $id_empresa = Auth::user()->empresa_id;
        $empresa = Empresa::where('id', $id_empresa)->first();
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);
        $moneda = Currency::find($empresa->moneda);
        // Configurar DOMPDF para manejar imágenes locales y habilitar HTML5 y PHP
        $pdf = PDF::loadView('admin.ventas.pdf', compact('empresa', 'venta', 'moneda'));

        // Habilitar el manejo de imágenes locales
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true, // Habilitar soporte de HTML5
            'isPhpEnabled' => true, // Permite el uso de PHP dentro de DOMPDF
            'isJavascriptEnabled' => true // Habilitar el soporte de JavaScript si es necesario
        ]);

        // Devolver el PDF para su descarga
        return $pdf->stream('ventas.pdf');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);
        return view('admin.ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        $venta = Venta::with('detallesVenta', 'cliente')->findOrFail($id);
        return view('admin.ventas.edit', compact('venta', 'productos', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'fecha' => 'required',
            'precio_total' => 'required',
        ]);

        $venta = Venta::find($id);
        $venta->fecha = $request->fecha;
        $venta->precio_total = $request->precio_total;
        $venta->cliente_id = $request->cliente_id;
        $venta->empresa_id = Auth::user()->empresa_id;
        $venta->save();

        return redirect()->route('admin.ventas.index')
            ->with('mensaje', 'se actualizo la venta de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::find($id);

        foreach ($venta->detallesVenta as $detalle){
            $producto = Producto::find($detalle->producto_id);
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        $venta->detallesVenta()->delete();
        Venta::destroy($id);

        return redirect()->route('admin.ventas.index')
        ->with('mensaje', 'se elimino la venta de la manera correcta')
        ->with('icono', 'success');
    }
}


