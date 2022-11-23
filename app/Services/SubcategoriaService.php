<?php

namespace App\Services;

use App\Repositories\SubcategoriaRepository;

class SubcategoriaService
{
    protected $subcategoriaRepository, $translateService;

    public function __construct(SubcategoriaRepository $subcategoriaRepository, TranslateService $translateService)
    {
        $this->subcategoriaRepository = $subcategoriaRepository;
        $this->translateService = $translateService;
    }

    public function getSubcategoriaByUuid($uuid)
    {
        $subcategoria = $this->subcategoriaRepository->getSubcategoriaByUuid($uuid);

        return $subcategoria;
    }

    public function getSubcategoriasByCategoria($idCategoria, $idioma)
    {
        $subcategorias = $this->subcategoriaRepository->getSubcategoriasByCategoria($idCategoria);

        foreach ($subcategorias as $subcategoria) {
            $subcategoria->descricao = $this->translateService->translate($subcategoria->descricao, $idioma);
        }

        return $subcategorias;
    }
}
