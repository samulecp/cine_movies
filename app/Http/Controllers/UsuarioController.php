<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::where('role', 'adm')->get();

    // Pasar los datos a la vista
            return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuarios=new User();
        $usuarios->name= $request->get('name');
        $usuarios->lastname= $request->get('lastname');
        $usuarios->email= $request->get('email');
        $usuarios->password = Hash::make($request->get('password'));
        $usuarios->role= 'adm';
        $usuarios->save();
        $this->registrarBitacora(
    'CREATE',
    'Creó administrador: ' . $request->name
    );
        return redirect('/usuario');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::find($id); // Encuentra el proveedor por ID
        return view('usuario.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuarios = User::where('role', 'adm')->findOrFail($id);
        $usuarios->name= $request->get('name');
        $usuarios->lastname= $request->get('lastname');
        $usuarios->email= $request->get('email');
        $usuarios->password= $usuarios->password;
        $usuarios->role= 'adm';
        $usuarios->save();
        $this->registrarBitacora(
    'UPDATE',
    'Editó administrador: ' . $request->name
    );
        return redirect('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::where('role', 'adm')->find($id);

     // Verifica si el proveedor existe
     if ($usuario)
     {
        $usuario->delete();
        $this->registrarBitacora(
    'DELETE',
    'Eliminó administrador: ' . $usuario->nombre
    );
        return redirect('/usuario')->with('success', 'Adm eliminado exitosamente');
     } else
     {
        return redirect('/usuario')->with('error', 'Adm no encontrado');
     }
    }

    private function registrarBitacora($accion, $descripcion)
{
    Bitacora::create([
        'user_id' => Auth::id(),
        'accion' => $accion,
        'descripcion' => $descripcion,
        'fecha_hora' => now(),
        'ip_address' => request()->ip(),
        'device_info' => request()->userAgent(),
    ]);
}

}
