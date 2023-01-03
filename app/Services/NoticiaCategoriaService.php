<?php

namespace App\Services;

use App\Repositories\NoticiaCategoriaRepository;

class NoticiaCategoriaService
{
    protected $noticiaCategoriaRepository;

    public function __construct(NoticiaCategoriaRepository $noticiaCategoriaRepository)
    {
        $this->noticiaCategoriaRepository = $noticiaCategoriaRepository;

    }


    public function getNoticiaCategorias()
    {
        $categorias =  $this->noticiaCategoriaRepository->getNoticiaCategorias();

        return $categorias;
    }

    public function noticiaCategoriaByUuid($uuid)
    {
        return $this->noticiaCategoriaRepository->noticiaCategoriaByUuid($uuid);
    }
}
