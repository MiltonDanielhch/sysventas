<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
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
        $paises = DB::table('countries')->get();
        $estados  = DB::table('states')->get();
        $ciudades = DB::table('cities')->get();
        $monedas = DB::table('currencies')->get();
        return view('admin.empresas.create', compact('paises', 'estados', 'ciudades', 'monedas'));
    }

    public function buscar_estado($id_pais){
        try{
            $estados = DB::table('states')->where('country_id', $id_pais)->get();
            return view('admin.empresas.cargar_estado', compact('estados'));

        }catch(\Exception $exception){
            return response()->json(['mensaje'=>'Error']);
        }
    }

    public function buscar_ciudad($id_estado){
        try{
            $ciudades = DB::table('cities')->where('state_id', $id_estado)->get();
            return view('admin.empresas.cargar_ciudades', compact('ciudades'));

        }catch(\Exception $exception){
            return response()->json(['mensaje'=>'Error']);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);
        $request->validate([
            'nombre_empresa'=>'required',
            'tipo_empresa'=>'required',
            'nit'=>'required|unique:empresas',
            'telefono'=>'required',
            'correo'=>'required|unique:empresas',
            'cantidad_impuesto'=>'required',
            'nombre_impuesto'=>'required',
            'direccion'=>'required',
            'logo'=>'required|image|mimes:jpg, jpeg, png'
        ]);

        $empresa = new Empresa();

        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->logo = $request->file('logo')->store('logos', 'public');

        $empresa->save();

        return redirect()->route('admin.index')->with('mensaje', 'se registro la empresa de la mamera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
