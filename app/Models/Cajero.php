<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Permission\Traits\HasRoles;

class Cajero extends Model
{
    use HasFactory;
  //  use HasRoles;

    protected $table = 'cajeros'; // Asegúrate de que este nombre sea correcto

    protected $fillable = [
        'HoraEntrada',
        'HoraSalida',
        'Iduser',
        'Idpuesto',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'Idpuesto'); // Relación pertenece a (BelongsTo) con Puesto
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'Iduser'); // Cambia 'Iduser' por el nombre real de tu clave foránea
    }


}
