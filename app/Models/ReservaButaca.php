<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservaButaca extends Model
{
    protected $fillable = [

        'proyeccion_id',

        'butaca_id',

        'user_id',

        'estado'
    ];

    public function proyeccion()
    {
        return $this->belongsTo(Proyeccion::class);
    }

    public function butaca()
    {
        return $this->belongsTo(Butaca::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
