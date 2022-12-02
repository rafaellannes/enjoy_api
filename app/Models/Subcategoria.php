<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'descricao',
        'categoria_id',
        'prefeitura_id',
        'ativo',
        'uuid',
    ];

    public function subcategoriasAtivas()
    {
        return $this->where('ativo', true)->get();
    }

    public function categoria()
    {
        return $this->belongsTo(ServicoCategoria::class, 'categoria_id');
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }

    public function servicosLimitados()
    { // limita a 3 serviços por subcategoria na home
        return $this->hasMany(Servico::class)
            ->where('ativo', true)
            ->limit(10);
    }
}
