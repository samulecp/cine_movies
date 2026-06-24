<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Return the response for a successful login.
     */
    public function toResponse($request)
    {
        $user = $request->user();

        if (! $user) {
            return redirect('/');
        }

        return match ($user->role) {
            'adm' => redirect()->route('admin.dashboard'),
            'tra' => redirect('/cajero'),
            'usu' => redirect()->route('cartelera.index'),
            default => redirect('/'),
        };
    }
}
