<?php

namespace App\Repositories;

use App\Models\Cupom;
use Illuminate\Database\Eloquent\Builder;

class CupomRepository
{

    protected $cupom;

    public function __construct(Cupom $cupom)
    {
        $this->cupom = $cupom;
    }

    public function getCupom($uuid)
    {
        return $this->cupom
            ->where('uuid', $uuid)
            ->where('ativo', true)
            ->first();
    }

    public function getCuponsByServico($idServico)
    {
        return $this->cupom
            ->where('servico_id', $idServico)
            ->where('ativo', true)
            ->where('vigencia_inicio', '<=', now())
            ->where('vigencia_fim', '>=', now())
            ->withCount('gerados')
            ->get()
            ->filter(function ($query) {
                return $query->gerados_count < $query->max_resgates;
            });
    }
}
