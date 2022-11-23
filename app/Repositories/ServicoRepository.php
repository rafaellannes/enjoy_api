<?php

namespace App\Repositories;

use App\Models\Servico;

class ServicoRepository
{
    protected $servico;

    public function __construct(Servico $servico)
    {
        $this->servico = $servico;
    }

    public function getServicosAtivos()
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)->paginate(3);
    }

    public function getServico($uuid)
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)
            ->where('uuid', $uuid)->first();
    }

    public function getServicosBySubcategoria($idSubcategoria)
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)
            ->where('subcategoria_id', $idSubcategoria)->paginate(3);
    }

    public function getServicosByCategoria($idCategoria)
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)
            ->whereHas('subcategoria', function ($query) use ($idCategoria) {
                $query->where('categoria_id', $idCategoria);
            })->paginate(3);
    }
}
