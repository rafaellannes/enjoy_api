<?php

namespace App\Services;

use App\Repositories\ServicoRepository;

class ServicoService
{
    protected $servicoRepository;
    protected $translateService;


    public function __construct(ServicoRepository $servicoRepository, TranslateService $translateService)
    {
        $this->servicoRepository = $servicoRepository;
        $this->translateService = $translateService;
    }


    public function getServicosAtivos($idioma)
    {
        $servicos =  $this->servicoRepository->getServicosAtivos();

        foreach ($servicos as $servico) {
            $servico->titulo = $this->translateService->translate($servico->titulo, $idioma);
            $servico->descricao = $this->translateService->translate($servico->descricao, $idioma);
        }

        return $servicos;
    }

    public function getServico($uuid, $idioma)
    {
        $servico =  $this->servicoRepository->getServico($uuid);

        $servico->titulo = $this->translateService->translate($servico->titulo, $idioma);
        $servico->descricao = $this->translateService->translate($servico->descricao, $idioma);

        return $servico;
    }

    public function getServicosBySubcategoria($id, $idioma)
    {
        $servicos =  $this->servicoRepository->getServicosBySubcategoria($id);

        foreach ($servicos as $servico) {
            $servico->titulo = $this->translateService->translate($servico->titulo, $idioma);
            $servico->descricao = $this->translateService->translate($servico->descricao, $idioma);
        }

        return $servicos;
    }

/*     public function getServicosByCategoria($idCategoria, $idioma)
    {
        $servicos =  $this->servicoRepository->getServicosByCategoria($idCategoria);

        foreach ($servicos as $servico) {
            $servico->titulo = $this->translateService->translate($servico->titulo, $idioma);
            $servico->descricao = $this->translateService->translate($servico->descricao, $idioma);
        }
        return $servicos;
    } */
}
