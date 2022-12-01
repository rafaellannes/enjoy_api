<?php

namespace App\Repositories;

use App\Models\NoticiaCategoria;

class NoticiaCategoriaRepository
{
    protected $noticiaCategoria;

    public function __construct(NoticiaCategoria $noticiaCategoria)
    {
        $this->noticiaCategoria = $noticiaCategoria;
    }

    public function getNoticiaCategorias()
    {
        return $this->noticiaCategoria
            ->has('noticias')
            ->where('ativo', true)
            ->paginate();
    }

    public function noticiaCategoriaByUuid($uuid)
    {
        return $this->noticiaCategoria
            ->where('uuid', $uuid)
            ->where('ativo', true)
            ->first();
    }
}
