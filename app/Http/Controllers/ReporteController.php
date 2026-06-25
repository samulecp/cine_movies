<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaPelicula;
use App\Models\DetalleVentaProducto;
use App\Models\ReservaButaca;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    // 🔥 FUNCIÓN BASE (NO DUPLICAS CÓDIGO)
    private function datos($desde, $hasta)
    {
        return [
            'gananciasPeliculas' => VentaPelicula::with('proyeccion.pelicula')
                ->when($desde && $hasta, function ($q) use ($desde, $hasta) {
                    $q->whereBetween('created_at', [$desde, $hasta]);
                })
                ->get()
                ->groupBy('proyeccion.pelicula_id'),

            'topProductos' => DetalleVentaProducto::with('producto')
                ->when($desde && $hasta, function ($q) use ($desde, $hasta) {
                    $q->whereBetween('created_at', [$desde, $hasta]);
                })
                ->get()
                ->groupBy('producto_id'),

            'formatos' => ReservaButaca::with('proyeccion.sala.formato')
                ->when($desde && $hasta, function ($q) use ($desde, $hasta) {
                    $q->whereBetween('created_at', [$desde, $hasta]);
                })
                ->get()
                ->groupBy(function ($r) {
                    return $r->proyeccion->sala->formato->nombre ?? 'Sin formato';
                }),
        ];
    }

    // 📊 INDEX (VISTA)
    public function index(Request $request)
    {
        $data = $this->datos($request->desde, $request->hasta);

        return view('reportes.index', array_merge($data, [
            'desde' => $request->desde,
            'hasta' => $request->hasta
        ]));
    }

    // 📄 PDF
    public function pdf(Request $request)
    {
        $data = $this->datos($request->desde, $request->hasta);

        return Pdf::loadView('reportes.pdf', $data)
            ->download('reporte_cine.pdf');
    }

    // 📊 CSV
    public function csv(Request $request)
    {
        $data = $this->datos($request->desde, $request->hasta);

        $filename = "reporte_cine.csv";

        return response()->streamDownload(function () use ($data) {

            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Película', 'Total Ventas']);

            foreach ($data['gananciasPeliculas'] as $ventas) {
                fputcsv($handle, [
                    $ventas->first()->proyeccion->pelicula->nombre ?? '',
                    $ventas->sum('precio_total')
                ]);
            }

            fclose($handle);

        }, $filename);
    }
}