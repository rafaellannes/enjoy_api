<?php

namespace App\Repositories;

use App\Models\ServicoCategoria;

class ServicoCategoriaRepository
{
    protected $servicoCategoria;

    public function __construct(ServicoCategoria $servicoCategoria)
    {
        $this->servicoCategoria = $servicoCategoria;
    }

    public function getCategoriasAtivas()
    {
        return $this->servicoCategoria->where('ativo', true)->get();
    }

    public function getCategoriaByUuid($uuid)
    {
        return $this->servicoCategoria->where('uuid', $uuid)->first();
    }
}
