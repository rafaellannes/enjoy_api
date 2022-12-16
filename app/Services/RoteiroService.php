<?php

namespace App\Services;

use App\Repositories\RoteiroRepository;

class RoteiroService
{
    protected $roteiroRepository, $servicoService;

    public function __construct(RoteiroRepository $roteiroRepository, ServicoService $servicoService)
    {
        $this->roteiroRepository = $roteiroRepository;
        $this->servicoService = $servicoService;
    }

    public function roteirosByClient()
    {
        return $this->roteiroRepository->roteirosByClient();
    }

    public function store(array $data)
    {
        return $this->roteiroRepository->store($data);
    }

    public function roteiroByUuid(string $uuid)
    {
        return $this->roteiroRepository->roteiroByUuid($uuid);
    }

    public function attachRoteiroServico(array $data)
    {

        $servico = $this->servicoService->getServico($data['servico_uuid']);

        /*  dd($servico); */
        $roteiro = $this->roteiroRepository->roteiroByUuid($data['roteiro_uuid']);

        //validar se o servico já está no roteiro
        if ($roteiro->servicos->contains($servico->id)) {
            return false;
        }

        $servico->roteiros()->attach($roteiro->id, ['created_at' => now(), 'updated_at' => now()]);

        return true;


        //return $this->roteiroRepository->attachRoteiroServico($data);
    }

    public function dettachRoteiroServico(array $data)
    {
        $servico = $this->servicoService->getServico($data['servico_uuid']);

        $roteiro = $this->roteiroRepository->roteiroByUuid($data['roteiro_uuid']);

        //validar se existe o Servico no Roteiro
        if (!$roteiro->servicos->contains($servico->id)) {
            return false;
        }

        $servico->roteiros()->detach($roteiro->id);
        return true;
    }
}
