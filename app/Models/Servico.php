<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'titulo',
        'descricao',
        'contato',
        'endereco',
        'img',
        'latitude',
        'longitude',
        'prefeitura_id',
        'subcategoria_id',
        'user_id',
        'lojista_id',
        'ativo',
        'uuid',
    ];

    protected $casts = [
        'img' => 'array',
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function prefeitura()
    {
        return $this->belongsTo(Prefeitura::class);
    }

    /*     public function user()
    {
        return $this->belongsTo(User::class);
    } */

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'servico_tag');
    }

    public function redes()
    {
        return $this->belongsToMany(Rede::class, 'servico_rede')->withPivot('link');
    }

    public function cupons()
    {
        return $this->hasMany(Cupom::class);
    }

    public function roteiros()
    {
        return $this->belongsToMany(Roteiro::class, 'roteiros_servicos', 'servico_id', 'roteiro_id')->withPivot('ordem');
    }

    public function acessos()
    {
        return $this->hasMany(AcessoServico::class);
    }
}
