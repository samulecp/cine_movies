<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $table = 'peliculas';

    protected $fillable = [
        'nombre',
        'duracion',
        'direccionPelicula',
        'genero_id',
        'clasificacion_id'
    ];

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class);
    }

    public function proyecciones()
{
    return $this->hasMany(Proyeccion::class);
}
}