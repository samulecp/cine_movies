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
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\FormatoController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\FilaController;
use App\Http\Controllers\ColumnaController;
use App\Http\Controllers\ButacaController;
use App\Http\Controllers\LenguajeController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProyeccionController;
use App\Http\Controllers\ReservaButacaController;
use App\Http\Controllers\VentaPeliculaController;

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

    if ($user->role === 'adm') {
        app(ActivityController::class)
            ->logActivity('Inicio de sesion', 'Acceso como administrador');

        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'tra') {
        app(ActivityController::class)
            ->logActivity('Inicio de sesion', 'Acceso como cajero');

        return redirect('/cajero');
    }

    if ($user->role === 'usu') {
        app(ActivityController::class)
            ->logActivity('Inicio de sesion', 'Acceso como cliente virtual');

        return redirect()->route('cartelera.index');
    }

    return redirect('/');
})->name('dashboard');
});
Route::get('/cartelera', function () {
    return view('cartelera.index');
})->name('cartelera.index');
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


Route::resource('proveedor', ProveedorController::class)->middleware('role:adm');



Route::resource('puestos', PuestoController::class)->middleware('role:adm');

Route::get(
    '/proyeccion/{id}/asientos',
    [ReservaButacaController::class, 'seleccionar']
)->name('asientos.seleccionar');

Route::resource('formatos', FormatoController::class)->middleware('role:adm');
Route::resource('salas', SalaController::class)->middleware('role:adm');
Route::resource('filas', FilaController::class)->middleware('role:adm');
Route::resource('columnas', ColumnaController::class)->middleware('role:adm');
Route::resource('butacas', ButacaController::class)->middleware('role:adm');
Route::resource('proyecciones', ProyeccionController::class)->middleware('role:adm');
Route::resource('lenguajes', LenguajeController::class)->middleware('role:adm');
Route::post('/reservas', [ReservaButacaController::class, 'store'])
    ->name('reservas.store');
Route::post(
    '/ventas/resumen',
    [VentaPeliculaController::class,'resumen']
)->name('ventas.resumen');
Route::post(
    '/ventas',
    [VentaPeliculaController::class,'store']
)->name('ventas.store');

Route::get(
    '/pagos/{venta}',
    [PagoController::class, 'create']
)->name('pagos.create');

Route::post(
    '/pagos/{venta}',
    [PagoController::class, 'store']
)->name('pagos.store');

Route::get(
    '/ventas/{venta}/ticket',
    [VentaPeliculaController::class,'ticket']
)->name('ventas.ticket');

Route::get(
    '/pelicula/{pelicula}',
    [VentaPeliculaController::class, 'funciones']
)->name('pelicula.funciones');