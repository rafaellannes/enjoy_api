<?php

namespace App\Services;

use App\Repositories\ServicoRepository;

class ServicoService
{
    protected $servicoRepository;


    public function __construct(ServicoRepository $servicoRepository)
    {
        $this->servicoRepository = $servicoRepository;
    }


    public function getServicosAtivos()
    {
        $servicos =  $this->servicoRepository->getServicosAtivos();

        return $servicos;
    }

    public function getServico($uuid)
    {
        $servico =  $this->servicoRepository->getServico($uuid);

        return $servico;
    }

    public function getServicosBySubcategoria($id)
    {
        $servicos =  $this->servicoRepository->getServicosBySubcategoria($id);

        return $servicos;
    }

    public function getServicosByCategoria($idCategoria)
    {
        $servicos =  $this->servicoRepository->getServicosByCategoria($idCategoria);

        return $servicos;
    }

    public function getServicosBySearch($search)
    {
        $servicos =  $this->servicoRepository->getServicosBySearch($search);

        return $servicos;
    }

    public function getServicosGroupByCategoria()
    {
        $data =  $this->servicoRepository->getServicosGroupByCategoria();

        //LIMPAR AS SUBCATEGORIAS QUE NÃO TEM SERVIÇOS
    /*     foreach ($data as $key_categoria => $categoria_value) {
            foreach ($data[$key_categoria]['subcategorias'] as $key_subcategoria => $value_subcategoria) {
                if ($value_subcategoria['servicos'] == null) {
                    unset($data[$key_categoria]['subcategorias'][$key_subcategoria]);

                    $data[$key_categoria]['subcategorias'] = array_values($data[$key_categoria]['subcategorias']);
                }
            }
        } */

        return $data;
    }

    public function getServicosGroupBySubcategoria()
    {
        $servicos =  $this->servicoRepository->getServicosGroupBySubcategoria();

        return $servicos;
    }
}
