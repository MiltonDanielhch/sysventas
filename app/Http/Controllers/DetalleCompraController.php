<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
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
        // Buscar el producto por código
        $producto = Producto::where('codigo', $request->codigo)->first();

        // ID de la compra
        $compra_id = $request->id_compra;

        if ($producto) {
            // Buscar si el producto ya existe en los detalles de la compra
            $detalle_compra_existe = DetalleCompra::where('producto_id', $producto->id)
                ->where('compra_id', $compra_id)
                ->first();

            // Si el producto ya está en la compra, actualizamos la cantidad
            if ($detalle_compra_existe) {
                $detalle_compra_existe->cantidad += $request->cantidad;
                $detalle_compra_existe->save();

                // Actualizamos el stock del producto
                $producto->stock -= $request->cantidad;
                $producto->save();

                // Devolvemos la respuesta con los detalles del producto y la cantidad actualizada
                return response()->json([
                    'success' => true,
                    'message' => 'Producto actualizado en la compra.',
                    'producto' => $producto,
                    'cantidad' => $detalle_compra_existe->cantidad
                ]);
            } else {
                // Si el producto no está en la compra, lo agregamos
                $detalle_compra = new DetalleCompra();
                $detalle_compra->cantidad = $request->cantidad;
                $detalle_compra->compra_id = $compra_id;
                $detalle_compra->producto_id = $producto->id;
                $detalle_compra->save();

                // Actualizamos el stock del producto
                $producto->stock -= $request->cantidad;
                $producto->save();

                // Devolvemos la respuesta con los detalles del producto y la cantidad
                return response()->json([
                    'success' => true,
                    'message' => 'Producto agregado a la compra.',
                    'producto' => $producto,
                    'cantidad' => $detalle_compra->cantidad
                ]);
            }
        } else {
            // Si el producto no se encuentra
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado.',
            ]);
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(DetalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleCompra $detalleCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detalleCompra = DetalleCompra::find($id);
        $producto = Producto::find($detalleCompra->producto_id);

        $producto->stock += $detalleCompra->cantidad;
        $producto->save();

        DetalleCompra::destroy($id);

        return response()->json(['success'=>true]);
    }
}
