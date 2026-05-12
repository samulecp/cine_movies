<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;

class FormatoController extends Controller
{
    public function index()
    {
        $formatos = Formato::all();

        return view('formatos.index', compact('formatos'));
    }

    public function create()
    {
        return view('formatos.create');
    }

    public function store(Request $request)
    {
        $formato = Formato::create([
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
        ]);

        $this->registrarBitacora(
            'CREATE',
            'Creó un formato: ' . $formato->descripcion
        );

        return redirect()
            ->route('formatos.index')
            ->with('success', 'Formato registrado correctamente');
    }

    public function edit(Formato $formato)
    {
        return view('formatos.edit', compact('formato'));
    }

    public function update(Request $request, Formato $formato)
    {
        $formato->update([
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
        ]);

        $this->registrarBitacora(
            'UPDATE',
            'Editó el formato: ' . $formato->descripcion
        );

        return redirect()
            ->route('formatos.index')
            ->with('success', 'Formato actualizado correctamente');
    }

   


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formato $formato)
    {
        $this->registrarBitacora(
    'DELETE',
    'Eliminó el formato: ' . $formato->descripcion
);
        $formato->delete();
        return view('formatos.index', compact('formatos'));
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
