<?php

namespace App\Models;

///use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    public $timestamps = false; // Desactiva el manejo de timestamps
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];



    public function clienteVirtual()
    {
        return $this->hasOne(ClienteVirtual::class, 'Iduser');
    }

    public function cajero()
    {
        return $this->hasOne(Cajero::class, 'Iduser'); // Cambia 'Iduser' por el nombre real de tu clave foránea
    }



}

