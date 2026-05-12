<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formato extends Model
{
    protected $fillable = ['descripcion', 'precio'];
    public function salas()
    {
        return $this->hasMany(Sala::class);
    }
}
