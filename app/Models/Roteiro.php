<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roteiro extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'titulo',
        'descricao',
        'privado',
        'uuid',
        'prefeitura_id',
        'client_id',
        'capa'
    ];

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'roteiros_servicos', 'roteiro_id', 'servico_id')->withPivot('ordem');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function prefeitura()
    {
        return $this->belongsTo(Prefeitura::class);
    }
}
