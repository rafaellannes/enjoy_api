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

    public function servicosAvailableByRoteiro($uuidRoteiro)
    {
        $roteiro = $this->roteiroRepository->roteiroByUuid($uuidRoteiro);

        /*   return $roteiro->servicos; */

        $servicosRecomendadosBySubcategoria = $this->servicoService->getServicosGroupBySubcategoria();

        /*  return $servicosRecomendadosBySubcategoria; */

        //Excluir os servicos que já estão no roteiro
        foreach ($servicosRecomendadosBySubcategoria as $keySubCategoria => $subcategoria) {
            foreach ($subcategoria['servicos'] as $key => $servico) {

                if ($roteiro->servicos->contains($servico['id'])) {
                    unset($servicosRecomendadosBySubcategoria[$keySubCategoria]['servicos'][$key]);
                    $servicosRecomendadosBySubcategoria[$keySubCategoria]['servicos'] = array_values($servicosRecomendadosBySubcategoria[$keySubCategoria]['servicos']);
                }
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
