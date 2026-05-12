<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cajero;
use App\Models\Puesto;
use Illuminate\Support\Facades\DB;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class CajeroController extends Controller
{

    public function index()
    {
        $usuarios = User::whereHas('cajero.puesto')->with(['cajero.puesto'])->get();
        return view('cajero.index', compact('usuarios'));
    }



    public function create()
    {
        $puestoCajero = Puesto::whereRaw('LOWER(nombre) = ?', ['cajero'])->first();

        if (! $puestoCajero) {
            return redirect('/cajero')->with('error', 'No existe un puesto configurado con nombre "cajero".');
        }
        
        return view('cajero.create', compact('puestoCajero'));
    }


    public function store(Request $request)
    {
        $puestoCajero = Puesto::whereRaw('LOWER(nombre) = ?', ['cajero'])->first();

        if (! $puestoCajero) {
            return redirect('/cajero')->with('error', 'No existe un puesto configurado con nombre "cajero".');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'HoraEntrada' => 'required|date_format:H:i',
            'HoraSalida' => 'required|date_format:H:i|after:HoraEntrada',
        ]);
        
        DB::transaction(function () use ($request, $puestoCajero) {
            $usuario = User::create([
                'name' => $request->input('name'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role' => 'tra',
            ]);

            Cajero::create([
                'Iduser' => $usuario->id,
                'HoraEntrada' => $request->input('HoraEntrada'),
                'HoraSalida' => $request->input('HoraSalida'),
                'Idpuesto' => $puestoCajero->id,
            ]);
        });

        $this->registrarBitacora(
    'CREATE',
    'Creó cajero: ' . $request->name
);

        return redirect('/cajero');
    }



















    public function edit($id)
    {
        $usuario = User::with(['cajero', 'cajero.puesto'])->find($id);

        if (!$usuario) {
            return redirect('/cajero')->with('error', 'Usuario no encontrado');
        }

     //   dd($usuario->cajero); // Esto te mostrará la información del cajero

        $puestos = Puesto::all();

        return view('cajero.edit', compact('usuario', 'puestos'));
    }











    public function update(Request $request, $cajeroId)
    {
        // Validación de los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->input('user_id'),
         ///   'HoraEntrada' => 'required|date_format:H:i',
          ////  'HoraSalida' => 'required|date_format:H:i',
            'Idpuesto' => 'required|exists:puestos,id',
        ]);

        // Buscar el usuario por el ID
        $usuario = User::find($request->input('user_id'));
        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        // Actualizar datos del usuario
        $usuario->update([
            'name' => $request->input('name'),
            'lastname' => $request->input('lastname'),

            'email' => $request->input('email'),
        ]);

        // Buscar el cajero asociado usando el ID del cajero que se ha enviado
        $cajero = Cajero::find($cajeroId); // Aquí se busca el cajero directamente por su ID

        if ($cajero) {
            // Actualizar información del cajero
            $cajero->update([
                'HoraEntrada' => $request->input('HoraEntrada'),
                'HoraSalida' => $request->input('HoraSalida'),
                'Idpuesto' => $request->input('Idpuesto'),
            ]);
        } else {
            return redirect()->back()->with('error', 'Cajero no encontrado');
        }
        $this->registrarBitacora(
    'UPDATE',
    'Editó cajero: ' . $request->name
);

        return redirect()->route('cajero.index')
            ->with('success', 'Datos del cajero actualizados correctamente')
            ->with('reload', true);
    }






public function destroy($id)
{
    $usuario = User::find($id);

    if ($usuario) {
        // Antes de eliminar el usuario, asegúrate de eliminar el cajero asociado
        if ($usuario->cajero) {
            $usuario->cajero->delete();
        }
        $this->registrarBitacora(
    'DELETE',
    'Eliminó cajero: ' . $usuario->name
);
        $usuario->delete(); // Luego elimina el usuario
        return redirect('/cajero')->with('success', 'Usuario eliminado exitosamente');
    } else {
        return redirect('/cajero')->with('error', 'Usuario no encontrado');
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
