<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'venta_pelicula_id',
        'metodo_pago',
        'monto',
        'estado'
    ];

    public function ventaPelicula()
    {
        return $this->belongsTo(
            VentaPelicula::class,
            'venta_pelicula_id'
        );
    }
}
