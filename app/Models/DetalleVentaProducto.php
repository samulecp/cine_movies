<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVentaProducto extends Model
{
    protected $fillable = [
        'venta_producto_id',
        'producto_id',
        'cantidad',
        'precio'
    ];

    public function venta()
    {
        return $this->belongsTo(VentaProducto::class, 'venta_producto_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}