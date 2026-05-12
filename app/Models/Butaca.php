<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Butaca extends Model
{
    protected $fillable = ['sala_id', 'fila_id', 'columna_id', 'estado'];
    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }
    public function fila()
    {
        return $this->belongsTo(Fila::class);
    }
    public function columna()
    {
        return $this->belongsTo(Columna::class);
    }
}
