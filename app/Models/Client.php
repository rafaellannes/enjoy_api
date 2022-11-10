<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Client  extends Authenticatable
{
    use HasFactory, TenantTrait, HasApiTokens;

    protected $fillable = [
        'prefeitura_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function prefeitura()
    {
        return $this->belongsTo(Prefeitura::class);
    }
}
