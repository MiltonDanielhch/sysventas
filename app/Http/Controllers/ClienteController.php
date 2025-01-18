<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
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
        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'se registro el cliente correctamente')
            ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        return view('admin.clientes.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'nombre_cliente' =>  'required',
            'nit_cliente' => 'required',
            'telefono' => 'required',
            'email' => 'required',
        ]);
        $cliente = Cliente::find($id);
        $cliente->nombre_cliente = $request->nombre_cliente;
        $cliente->nit_codigo = $request->nit_cliente;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'se actualizo el cliente correctamente')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Cliente::destroy($id);

        return redirect()->route('admin.clientes.index')
        ->with('mensaje', 'se elimino el cliente correctamente')
        ->with('icono', 'success');
    }
}
