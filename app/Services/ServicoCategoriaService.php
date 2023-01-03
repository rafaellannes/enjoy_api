<?php

namespace App\Services;

use App\Repositories\ServicoCategoriaRepository;

class ServicoCategoriaService
{
    protected $servicoCategoriaRepository;

    public function __construct(ServicoCategoriaRepository $servicoCategoriaRepository)
    {
        $this->servicoCategoriaRepository = $servicoCategoriaRepository;

    }

    public function getCategoriasAtivas()
    {
        $categorias = $this->servicoCategoriaRepository->getCategoriasAtivas();

        return $categorias;
    }

    public function getCategoriaByUuid($uuid)
    {
        return $this->servicoCategoriaRepository->getCategoriaByUuid($uuid);
    }
}
