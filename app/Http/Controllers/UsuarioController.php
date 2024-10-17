<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresa_id = Auth::user()->empresa_id;
        $usuarios = User::where('empresa_id', $empresa_id)->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',
        ]);
        $usuario = new  User();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->empresa_id = Auth::user()->empresa_id;

        $usuario->save();

        $usuario->assignRole($request->role);

        // $usuario->assignRole('administrador');

        return redirect()->route('admin.usuarios.index')->with('mensaje', 'se registro al Usuario de la mamera correcta')->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,
        ]);

        $usuario = User::find($id);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if($request->filled('password')){
            $usuario->password = Hash::make($request->password);
        }
        $usuario->empresa_id = Auth::user()->empresa_id;

        $usuario->save();

        $usuario->syncRoles($request->role);

        // $usuario->assignRole('administrador');

        return redirect()->route('admin.usuarios.index')->with('mensaje', 'se modifico al Usuario de la mamera correcta')->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('admin.usuarios.index')->with('mensaje', 'se elimino el usuario de la mamera correcta')->with('icono', 'success');
    }
}
