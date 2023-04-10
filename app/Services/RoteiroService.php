<?php

namespace App\Services;

use App\Repositories\RoteiroRepository;

class RoteiroService
{
    protected $roteiroRepository, $servicoService, $locationService;

    public function __construct(RoteiroRepository $roteiroRepository, ServicoService $servicoService, LocationService $locationService)
    {
        $this->roteiroRepository = $roteiroRepository;
        $this->servicoService = $servicoService;
        $this->locationService = $locationService;
    }

    public function roteirosByClient()
    {
        $roteiros =  $this->roteiroRepository->roteirosByClient();

        $roteiros->map(function ($item) {
            $item['like'] = false;
            return $item;
        });

        return $roteiros;
    }

    public function store(array $data)
    {
        return $this->roteiroRepository->store($data);
    }

    public function roteiroByUuid(string $uuid)
    {
        $roteiros =  $this->roteiroRepository->roteiroByUuid($uuid);


        return $roteiros;
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

        $servico->roteiros()->attach(
            $roteiro->id,
            [
                'created_at' => now(),
                'updated_at' => now(),
                'data_hora' => $data['data_hora']
            ]
        );

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

    public function servicosAvailableByRoteiro($uuidRoteiro)
    {
        $roteiro = $this->roteiroRepository->roteiroByUuid($uuidRoteiro);

        $servicosRecomendadosBySubcategoria = $this->servicoService->getServicosGroupBySubcategoria();

        // Excluir os serviços que já estão no roteiro em cada subcategoria
        foreach ($servicosRecomendadosBySubcategoria as $keySubCategoria => &$subcategoria) {
            $subcategoria['servicos'] = array_filter($subcategoria['servicos'], function ($servico) use ($roteiro) {
                return !$roteiro->servicos->contains($servico['id']);
            });

            // Remover subcategoria vazia
            if (empty($subcategoria['servicos'])) {
                unset($servicosRecomendadosBySubcategoria[$keySubCategoria]);
            }
        }

        return $servicosRecomendadosBySubcategoria;
    }

    public function roteirosAvailableByServico($uuidServico)
    {
        $servico = $this->servicoService->getServico($uuidServico);

        $roteiros = $this->roteiroRepository->roteirosByClient();

        foreach ($roteiros as $key => $roteiro) {
            if ($servico->roteiros->contains($roteiro->id)) {
                $roteiros->forget($key);
            }
        }

        /* $roteiros =  array_values($roteiros->toArray()); */

        //convert array to object
        /* $roteiros = json_decode(json_encode($roteiros)); */

        return $roteiros;
    }

    public function roteirosPublicos()
    {
        return $this->roteiroRepository->getRoteirosPublicos();
    }

    public function roteirosLikeByClient()
    {
        $roteiros =  $this->roteiroRepository->roteirosLikeByClient();

        $roteiros->map(function ($item) {
            $item['like'] = true;
            return $item;
        });

        return $roteiros;
    }

    public function checkAutorRoteiro(Object $roteiro)
    {

        if ($roteiro->client_id == auth()->user()->id) {
            return true;
        }

        return false;
    }

    public function checkLikeRoteiro(Object $roteiro)
    {
        return $roteiro->likesRoteiros->where('client_id', auth()->user()->id)->first() ?  true :  false;
    }
}
