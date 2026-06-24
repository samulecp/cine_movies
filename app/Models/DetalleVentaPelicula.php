<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentaPelicula extends Model
{
    protected $fillable = [

        'venta_pelicula_id',

        'butaca_id',

        'precio_venta'
    ];

    public function venta()
    {
        return $this->belongsTo(
            VentaPelicula::class,
            'venta_pelicula_id'
        );
    }

    public function butaca()
    {
        return $this->belongsTo(
            Butaca::class
        );
    }
}
