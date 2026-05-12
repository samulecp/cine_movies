<?php

namespace App\Http\Controllers;

use App\Models\Butaca;
use App\Models\Sala;
use App\Models\Fila;
use App\Models\Columna;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ButacaController extends Controller
{
    public function index()
    {
        $butacas = Butaca::with([
            'sala',
            'fila',
            'columna'
        ])->get();

        return view('butacas.index', compact('butacas'));
    }

    public function create()
    {
        $salas = Sala::all();

        $filas = Fila::all();

        $columnas = Columna::all();

        return view('butacas.create',
            compact('salas', 'filas', 'columnas'));
    }

    public function store(Request $request)
    {
        $butaca = Butaca::create([

            'sala_id' => $request->sala_id,

            'fila_id' => $request->fila_id,

            'columna_id' => $request->columna_id,

            'estado' => 'Disponible',
        ]);

        $this->registrarBitacora(
            'CREATE',
            'Se registró la butaca ID: '.$butaca->id
        );

        return redirect()->route('butacas.index');
    }

    


    /**
     * Display the specified resource.
     */
    public function show(Butaca $butaca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Butaca $butaca)
    {
        return view('butacas.edit', compact('butacas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Butaca $butaca)
    {
        $butaca->update($request->all());
        $this->registrarBitacora(

        'UPDATE',

        'Editó butaca: ' . $butaca->id
    );
        return redirect()->route('butacas.index')->with('success', 'Butaca actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Butaca $butaca)
    {
         $this->registrarBitacora(
    'DELETE',
    'Eliminó la butaca: ' . $butaca->id
);
        $butaca->delete();
        return view('butacas.index', compact('butacas'));
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
