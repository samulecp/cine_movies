<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\ClientePresencial;

class ClientePresencialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar todos los clientes presenciales
        $usuarios = ClientePresencial::all();

        // Pasar los datos a la vista
        return view('clientePresencial.index', compact('usuarios'));
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientePresencial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuarios = new ClientePresencial();
        $usuarios->nombre = $request->get('nombre');
        $usuarios->ci = $request->get('ci');
        $usuarios->nit = $request->get('nit');
        $usuarios->save();
        $this->registrarBitacora(
    'CREATE',
    'Creó cliente presencial: ' . $request->nombre
);
        return redirect('/clientePresencial');
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuarios = ClientePresencial::find($id); // Encuentra el usuario por ID
        return view('clientePresencial.edit')->with('usuario', $usuarios);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuarios=ClientePresencial::find($id);
        $usuarios->nombre= $request->get('nombre');
        $usuarios->ci= $request->get('ci');
        $usuarios->nit= $request->get('nit');
        $usuarios->save();
        $this->registrarBitacora(
    'UPDATE',
    'Editó cliente presencial: ' . $request->nombre
);
        return redirect('/clientePresencial');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
     // Busca el usuario por ID
     $usuario = ClientePresencial::find($id);

     // Verifica si el usuario existe
     if ($usuario)
     {
        $usuario->delete();
        $this->registrarBitacora(
    'DELETE',
    'Eliminó cliente presencial: ' . $usuario->nombre
);
        return redirect('/clientePresencial')->with('success', 'Usuario eliminado exitosamente');
     } else
     {
        return redirect('/clientePresencial')->with('error', 'Usuario no encontrado');
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
