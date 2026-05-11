<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientePresencial extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ci',
        'nit',
    ];
}
