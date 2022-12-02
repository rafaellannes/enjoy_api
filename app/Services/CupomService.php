<?php

namespace App\Services;

use App\Repositories\CupomRepository;

class CupomService
{
    protected $cupomRepository;

    public function __construct(CupomRepository $cupomRepository)
    {
        $this->cupomRepository = $cupomRepository;
    }

    public function getCupom($uuid)
    {
        return $this->cupomRepository->getCupom($uuid);
    }

    public function getCuponsByServico($idServico)
    {
        return $this->cupomRepository->getCuponsByServico($idServico);
    }
}
