<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    use HasFactory, TenantTrait;

    protected $table = 'cupons';
    protected $fillable = [
        'descricao',
        'detalhes',
        'max_resgates',
        'vigencia_inicio',
        'vigencia_fim',
        'valor',
        'tipo',
        'lojista_id',
        'servico_id',
        'ativo',
    ];

    protected $casts = [

        'created_at' => 'date:d/m/Y H:i',
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function gerados()
    {
        return $this->hasMany(CupomGerado::class);
    }
}
