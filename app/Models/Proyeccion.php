<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    use HasFactory;

    protected $table = 'proyeccions';

    protected $fillable = [
        'fecha',
        'horaIni',
        'horaFin',
        'sala_id',
        'pelicula_id',
        'lenguaje_id',
    ];

    /**
     * Relaciones
     */

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }

    public function lenguaje()
    {
        return $this->belongsTo(Lenguaje::class);
    }
}