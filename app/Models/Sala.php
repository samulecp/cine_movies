<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    protected $fillable = ['formato_id', 'capacidad', 'estado'];
    public function formato()
    {
        return $this->belongsTo(Formato::class);
    }
    public function butacas()
    {
        return $this->hasMany(Butaca::class);
    }

    public function proyecciones()
{
    return $this->hasMany(Proyeccion::class);
}
}
