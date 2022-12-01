<?php

namespace App\Repositories;

use App\Models\Subcategoria;

class SubcategoriaRepository
{
    protected $subcategoria;

    public function __construct(Subcategoria $subcategoria)
    {
        $this->subcategoria = $subcategoria;
    }

    public function getSubcategoriaByUuid($uuid)
    {
        return $this->subcategoria->where('uuid', $uuid)->first();
    }

    public function getSubcategoriasByCategoria($idCategoria)
    {
        return $this->subcategoria
            ->has('servicos')
            ->where('categoria_id', $idCategoria)
            ->where('ativo', true)
            ->get();
    }
}
