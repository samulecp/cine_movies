<?php

namespace App\Http\Controllers;

use App\Models\ClienteVirtual;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ClienteVirtualRegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'telefono' => ['required', 'string', 'max:30'],
            'carnet' => ['required', 'string', 'max:30', 'unique:cliente_virtuals,carnet'],
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
        ]);

        $user = DB::transaction(function () use ($validated) {
            $newUser = User::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'telefono' => $validated['telefono'],
                'password' => Hash::make($validated['password']),
                'role' => 'usu',
            ]);

            ClienteVirtual::create([
                'FechaRegistro' => now()->toDateString(),
                'telefono' => $validated['telefono'],
                'carnet' => $validated['carnet'],
                'Iduser' => $newUser->id,
            ]);

            return $newUser;
        });

        Auth::login($user);

        return redirect('/#cartelera');
    }
}
