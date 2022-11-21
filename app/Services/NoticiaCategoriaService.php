<?php

namespace App\Services;

use App\Repositories\NoticiaCategoriaRepository;

class NoticiaCategoriaService
{
    protected $noticiaCategoriaRepository;

    public function __construct(NoticiaCategoriaRepository $noticiaCategoriaRepository, TranslateService $translateService)
    {
        $this->noticiaCategoriaRepository = $noticiaCategoriaRepository;
        $this->translateService = $translateService;
    }


    public function getNoticiaCategorias($idioma)
    {
        $categorias =  $this->noticiaCategoriaRepository->getNoticiaCategorias();
        foreach ($categorias as $categoria) {
            $categoria->descricao = $this->translateService->translate($categoria->descricao, $idioma);
        }

        return $categorias;
    }

    public function noticiaCategoriaByUuid($uuid)
    {
        return $this->noticiaCategoriaRepository->noticiaCategoriaByUuid($uuid);
    }
}
