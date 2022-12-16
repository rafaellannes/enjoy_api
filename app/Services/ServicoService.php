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

    public function getServico($uuid, $idioma = null)
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

    public function getServicosByCategoria($idCategoria, $idioma)
    {
        $servicos =  $this->servicoRepository->getServicosByCategoria($idCategoria);

        foreach ($servicos as $servico) {
            $servico->titulo = $this->translateService->translate($servico->titulo, $idioma);
            $servico->descricao = $this->translateService->translate($servico->descricao, $idioma);
        }
        return $servicos;
    }

    public function getServicosBySearch($search, $idioma)
    {
        $servicos =  $this->servicoRepository->getServicosBySearch($search);

        foreach ($servicos as $servico) {
            $servico->titulo = $this->translateService->translate($servico->titulo, $idioma);
            $servico->descricao = $this->translateService->translate($servico->descricao, $idioma);
        }

        return $servicos;
    }

    public function getServicosGroupByCategoria($idioma)
    {
        $data =  $this->servicoRepository->getServicosGroupByCategoria();

        /*   foreach ($servicos as $servico) {
            $servico->titulo = $this->translateService->translate($servico->titulo, $idioma);
            $servico->descricao = $this->translateService->translate($servico->descricao, $idioma);
        } */

        //LIMPAR AS SUBCATEGORIAS QUE NÃO TEM SERVIÇOS
        foreach ($data as $key_categoria => $categoria_value) {
            foreach ($data[$key_categoria]['subcategorias'] as $key_subcategoria => $value_subcategoria) {
                if ($value_subcategoria['servicos_limitados'] == null) {
                    unset($data[$key_categoria]['subcategorias'][$key_subcategoria]);

                    $data[$key_categoria]['subcategorias'] = array_values($data[$key_categoria]['subcategorias']);
                }
            }
        }

        return $data;
    }

    public function getServicosGroupBySubcategoria()
    {
        $servicos =  $this->servicoRepository->getServicosGroupBySubcategoria();

        return $servicos;
    }
}
