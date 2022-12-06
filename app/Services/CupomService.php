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
        //CUPONS POR SERVIÇO DISPONÍVEIS PARA RESGATE POR USUARIO
        $cupons =  $this->cupomRepository->getCuponsByServico($idServico);


        $user = auth()->user();

        //validar se o usuário já resgatou o cupom
        $cupons = $cupons->filter(function ($cupom) use ($user) {
            return !$cupom->gerados->contains('client_id', $user->id);
        });

        $cupons = array_values($cupons->toArray());

        return $cupons;
    }
}
