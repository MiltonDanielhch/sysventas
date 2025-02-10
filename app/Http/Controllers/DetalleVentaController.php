<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de la entrada
        $request->validate([
            'codigo' => 'required|string',
            'cantidad' => 'required|integer|min:1', // Asegurarse de que la cantidad sea positiva
            'id_venta' => 'required|integer', // Asegurarse de que se pase el id_venta
        ]);

        // Buscar el producto en la base de datos por código
        $producto = Producto::where('codigo', $request->codigo)->first();

        // Verificar si el producto existe
        if ($producto) {
            $venta_id = $request->id_venta;
            $cantidad_a_agregar = $request->cantidad;

            // Verificar si el producto ya está en los detalles de la venta
            $detalle_venta_existe = DetalleVenta::where('producto_id', $producto->id)
                ->where('venta_id', $venta_id)
                ->first();

            // Si ya existe, solo actualizamos la cantidad
            if ($detalle_venta_existe) {
                $detalle_venta_existe->cantidad += $cantidad_a_agregar;
                $detalle_venta_existe->save();

                // Actualizar el stock del producto
                if ($producto->stock >= $cantidad_a_agregar) {
                    $producto->stock -= $cantidad_a_agregar;
                    $producto->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'El producto fue encontrado y se actualizó la cantidad.',
                        'producto' => $producto,
                        'cantidad_actualizada' => $detalle_venta_existe->cantidad
                    ]);
                } else {
                    // Si no hay suficiente stock
                    return response()->json([
                        'success' => false,
                        'message' => 'No hay suficiente stock para agregar la cantidad solicitada.',
                    ]);
                }
            } else {
                // Si no existe, creamos el detalle de venta
                if ($producto->stock >= $cantidad_a_agregar) {
                    $detalle_venta = new DetalleVenta();
                    $detalle_venta->cantidad = $cantidad_a_agregar;
                    $detalle_venta->venta_id = $venta_id;
                    $detalle_venta->producto_id = $producto->id;
                    $detalle_venta->save();

                    // Actualizar el stock del producto
                    $producto->stock -= $cantidad_a_agregar;
                    $producto->save();

                    return response()->json([
                        'success' => true,
                        'message' => 'El producto fue agregado a la venta.',
                        'producto' => $producto,
                        'detalle' => $detalle_venta
                    ]);
                } else {
                    // Si no hay suficiente stock
                    return response()->json([
                        'success' => false,
                        'message' => 'No hay suficiente stock para agregar el producto.',
                    ]);
                }
            }
        } else {
            // Si el producto no se encuentra
            return response()->json([
                'success' => false,
                'message' => 'El producto no fue encontrado.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $detalleVenta = DetalleVenta::find($id);
        $producto = Producto::find($detalleVenta->producto_id);

        $producto->stock += $detalleVenta->cantidad;
        $producto->save();

        DetalleVenta::destroy($id);

        return response()->json(['success'=>true]);
    }
}
