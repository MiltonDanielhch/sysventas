<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TmpCompra;
use Illuminate\Http\Request;

class TmpCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function tmp_compras(Request $request){
        // echo $request->codigo;
        $producto = Producto::where('codigo', $request->codigo)->first();

        $session_id = session()->getId();

        if($producto){

            $tmp_compra_existe = TmpCompra::where('producto_id',$producto->id)
                                            ->where('session_id', $session_id)
                                            ->first();

            if ($tmp_compra_existe){
                $tmp_compra_existe->cantidad += $request->cantidad;
                $tmp_compra_existe->save();
                return response()->json(['success'=>true, 'message'=>'el producto fue encontrado']);
            }else{
                $tmp_compra = new TmpCompra();

                $tmp_compra->cantidad = $request->cantidad;
                $tmp_compra->producto_id = $producto->id;
                $tmp_compra->session_id = session()->getId();

                $tmp_compra->save();
                return response()->json(['success'=>true, 'message'=>'el producto fue encontrado']);
            }
        }else{
            return response()->json(['success'=>false, 'message'=>'el producto no fue encontrado']);
        }

    }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TmpCompra $tmpCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // echo $id;
        // dd($id);
        TmpCompra::destroy($id);
        return response()->json(['success'=>true]);
    }
}
