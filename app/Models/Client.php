<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Client  extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'notificacao',
        'descontos',
        'sexo',
        'data_nascimento',
        'photo',
        'telefone',
        'plataforma',
        'token_firebase',
        'token_data',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function historicos()
    {
        return $this->hasMany(Historico::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    public function cuponsGerados()
    {
        return $this->hasMany(CupomGerado::class);
    }

    public function roteiros()
    {
        return $this->hasMany(Roteiro::class);
    }

    public function roteirosLikes()
    {
        return $this->hasMany(LikesRoteiros::class);
    }
}
