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
        $producto = Producto::where('codigo', $request->codigo)->first();

        $compra_id = $request->id_compra;

        if($producto){
            $detalle_compra_existe = DetalleCompra::where('producto_id',$producto->id)
                ->where('compra_id', $compra_id)
                ->first();

            if($detalle_compra_existe){
                $detalle_compra_existe->cantidad += $request->cantidad;
                $detalle_compra_existe->save();
                return response()->json(['success'=>true, 'message'=>'el producto fue encontrado']);
            }else{
                $detalle_compra = new DetalleCompra();
                $detalle_compra->cantidad = $request->cantidad;
                $detalle_compra->compra_id = $compra_id;
                $detalle_compra->producto_id = $producto->id;
                $detalle_compra->save();
            }
        }else{
            return response()->json(['success'=>false, 'message'=>'el producto no fue encontrado']);
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
        DetalleCompra::destroy($id);
        return response()->json(['success'=>true]);
    }
}
