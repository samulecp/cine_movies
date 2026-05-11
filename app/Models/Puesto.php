<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $table = 'puestos'; // Asegúrate de que este nombre sea correcto

    protected $fillable = [
        'nombre',
    ];



    public function cajeros()
    {
        return $this->hasMany(Cajero::class, 'Idpuesto'); // 'idpuesto' es la clave foránea en la tabla `cajeros` que apunta a `puestos`
    }

}
