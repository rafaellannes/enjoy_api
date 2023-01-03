<?php

namespace App\Services;

use App\Repositories\SubcategoriaRepository;

class SubcategoriaService
{
    protected $subcategoriaRepository;

    public function __construct(SubcategoriaRepository $subcategoriaRepository)
    {
        $this->subcategoriaRepository = $subcategoriaRepository;

    }

    public function getSubcategoriaByUuid($uuid)
    {
        $subcategoria = $this->subcategoriaRepository->getSubcategoriaByUuid($uuid);

        return $subcategoria;
    }

    public function getSubcategoriasByCategoria($idCategoria)
    {
        $subcategorias = $this->subcategoriaRepository->getSubcategoriasByCategoria($idCategoria);

        return $subcategorias;
    }
}
