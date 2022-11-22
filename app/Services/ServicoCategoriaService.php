<?php

namespace App\Services;

use App\Repositories\ServicoCategoriaRepository;

class ServicoCategoriaService
{
    protected $servicoCategoriaRepository, $translateService;

    public function __construct(ServicoCategoriaRepository $servicoCategoriaRepository, TranslateService $translateService)
    {
        $this->servicoCategoriaRepository = $servicoCategoriaRepository;
        $this->translateService = $translateService;
    }

    public function getCategoriasAtivas($idioma)
    {
        $categorias = $this->servicoCategoriaRepository->getCategoriasAtivas();
        foreach ($categorias as $categoria) {
            $categoria->descricao = $this->translateService->translate($categoria->descricao, $idioma);
        }

        return $categorias;
    }
}
