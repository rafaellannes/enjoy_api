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
        return $this->noticiaCategoriaRepository->getNoticiaCategorias();
    }

    public function noticiaCategoriaByUuid($uuid)
    {
        return $this->noticiaCategoriaRepository->noticiaCategoriaByUuid($uuid);
    }
}
