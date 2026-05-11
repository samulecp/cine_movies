<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return redirect('/clientePresencial')->with('success', 'Usuario eliminado exitosamente');
     } else
     {
        return redirect('/clientePresencial')->with('error', 'Usuario no encontrado');
     }
    }

 }
