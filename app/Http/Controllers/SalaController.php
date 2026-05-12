<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\Formato;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::with('formato')->get();

        return view('salas.index', compact('salas'));
    }

    public function create()
    {
        $formatos = Formato::all();

        return view('salas.create', compact('formatos'));
    }

    public function store(Request $request)
    {
        $sala = Sala::create([

            'formato_id' => $request->formato_id,

            'capacidad' => $request->capacidad,

            'estado' => $request->estado,
        ]);

        $this->registrarBitacora(
            'Registro Sala',
            'Se registró la sala ID: '.$sala->id
        );

        return redirect()->route('salas.index');
    }

    


    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        return view('salas.edit', compact('salas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sala $sala)
    {
        $sala->update($request->all());
        $this->registrarBitacora(

        'UPDATE',

        'Editó sala: ' . $sala->id
    );
        return redirect()->route('salas.index')->with('success', 'Sala actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        $this->registrarBitacora(
    'DELETE',
    'Eliminó la sala: ' . $sala->id
);
        $sala->delete();
        return view('salas.index', compact('salas'));
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
