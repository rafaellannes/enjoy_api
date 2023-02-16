<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcessoServico extends Model
{
    use HasFactory;

    protected $table = 'acesso_servicos';

    protected $fillable = [
        'servico_id',
        'cliente_id',
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
