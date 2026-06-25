<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'estado'
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleVentaProducto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pago()
    {
        return $this->hasOne(Pago::class, 'venta_producto_id');
    }
}