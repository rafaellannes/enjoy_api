<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'client_id',
        'prefeitura_id',
        'uuid',
        'model_uuid',
        'model_type',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function prefeitura()
    {
        return $this->belongsTo(Prefeitura::class);
    }
}
