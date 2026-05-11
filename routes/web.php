<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\CajeroController;
use App\Http\Controllers\ClientePresencialController;
use App\Http\Controllers\ClienteVirtualRegisterController;
use App\Http\Controllers\ClienteVirtualController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\LogUserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ClasificacionController;



/*
|--------------------------------------------------------------------------
| Rutas ciclo 1
|--------------------------------------------------------------------------
| Solo se exponen CU1, CU2, CU7, CU8, CU19, CU20 y CU21.
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [ClienteVirtualRegisterController::class, 'create'])->name('register');
    Route::post('/register', [ClienteVirtualRegisterController::class, 'store'])->name('register.store');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    LogUserActivity::class,
])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'tra') {
            app(ActivityController::class)->logActivity('Inicio de sesion', 'Acceso como cajero');
            return redirect('/cajero');
        }

        if ($user->role === 'adm') {
            app(ActivityController::class)->logActivity('Inicio de sesion', 'Acceso como administrador');
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'usu') {
            app(ActivityController::class)->logActivity('Inicio de sesion', 'Acceso como cliente virtual');
            return redirect('/#cartelera');
        }

        app(ActivityController::class)->logActivity('Inicio de sesion', 'Acceso sin rol valido');
        return redirect('/');
    })->name('dashboard');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:adm'])->name('admin.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/password', function () {
        return view('auth.update-password');
    })->name('password.edit');

    Route::get('/bitacora', [BitacoraController::class, 'index'])
        ->middleware('role:adm')
        ->name('bitacora.index');

    Route::get('/mis-compras', function () {
        return view('clienteVirtual.compras');
    })->middleware('role:usu')->name('mis-compras.index');

    // CU20: Gestionar administrador
    Route::resource('usuario', UsuarioController::class)
        ->except(['show'])
        ->middleware('role:adm');

    // CU1: Gestionar cliente presencial
    Route::resource('clientePresencial', ClientePresencialController::class)
        ->except(['show'])
        ->middleware('role:adm,tra');

    // CU2: Gestionar cliente virtual
    Route::resource('clienteVirtual', ClienteVirtualController::class)->middleware('role:adm,usu');

    // CU19: Gestionar cajero
    Route::resource('cajero', CajeroController::class)
        ->except(['show'])
        ->middleware('role:adm,tra');
});

Route::resource('peliculas', PeliculaController::class)
    ->middleware('role:adm');

    
    Route::resource('generos', GeneroController::class)->middleware('role:adm');
    Route::resource('clasificaciones', ClasificacionController::class)->middleware('role:adm');
