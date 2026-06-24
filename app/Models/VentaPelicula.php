<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaPelicula extends Model
{
    protected $fillable = [
        'user_id',
        'proyeccion_id',
        'precio_total',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proyeccion()
    {
        return $this->belongsTo(Proyeccion::class);
    }

    public function detalles()
    {
        return $this->hasMany(
            DetalleVentaPelicula::class
        );
    }

    public function pago()
{
    return $this->hasOne(Pago::class);
}
}
