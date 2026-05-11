<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClienteVirtual;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ClienteVirtualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperar solo los usuarios que tienen un cliente virtual asociado
        $usuarios = User::with('clienteVirtual')
            ->where('role', 'usu')
            ->whereHas('clienteVirtual')
            ->get();

        return view('clienteVirtual.index', compact('usuarios'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clienteVirtual.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'telefono' => 'required|string|max:30',
            'carnet' => 'required|string|max:30|unique:cliente_virtuals,carnet',
            'password' => 'required|string|min:8|confirmed',
        ]);

        DB::transaction(function () use ($validated) {
            $usuario = User::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'usu',
            ]);

            ClienteVirtual::create([
                'FechaRegistro' => now()->toDateString(),
                'telefono' => $validated['telefono'],
                'carnet' => $validated['carnet'],
                'Iduser' => $usuario->id,
            ]);
        });

        return redirect('/clienteVirtual');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::with('clienteVirtual')
            ->where('role', 'usu')
            ->whereHas('clienteVirtual')
            ->findOrFail($id);

        return view('clienteVirtual.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = User::with('clienteVirtual')
            ->where('role', 'usu')
            ->whereHas('clienteVirtual')
            ->findOrFail($id);

        return view('clienteVirtual.edit')->with('usuario', $usuario);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = User::with('clienteVirtual')->where('role', 'usu')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'telefono' => 'required|string|max:30',
            'carnet' => 'required|string|max:30|unique:cliente_virtuals,carnet,' . optional($usuario->clienteVirtual)->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $usuario->name = $validated['name'];
        $usuario->lastname = $validated['lastname'];
        $usuario->email = $validated['email'];

        if (! empty($validated['password'])) {
            $usuario->password = Hash::make($validated['password']);
        }

        $usuario->role = 'usu';
        $usuario->save();

        if ($usuario->clienteVirtual) {
            $usuario->clienteVirtual->update([
                'telefono' => $validated['telefono'],
                'carnet' => $validated['carnet'],
            ]);
        }

        return redirect('/clienteVirtual');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
     // Busca el usuario por ID
        $usuario = User::where('role', 'usu')->find($id);

     // Verifica si el usuario existe
     if ($usuario)
     {
        $usuario->delete();
        return redirect('/clienteVirtual')->with('success', 'Usuario eliminado exitosamente');
     } else
     {
        return redirect('/clienteVirtual')->with('error', 'Usuario no encontrado');
     }
    }

 }
