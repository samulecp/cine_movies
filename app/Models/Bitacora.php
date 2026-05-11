<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacora'; // Nombre de la tabla
    

    protected $fillable = [
        'user_id',
        'accion',
        'descripcion',
        'fecha_hora',
        'ip_address',
        'device_info',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}