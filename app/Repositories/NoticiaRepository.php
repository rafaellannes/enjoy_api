<?php

namespace App\Repositories;

use App\Models\Noticia;

class NoticiaRepository
{
    protected $noticia;
    protected $categoria;

    public function __construct(Noticia $noticia)
    {
        $this->noticia = $noticia;
    }

    public function getNoticiasAtivas()
    {
        return $this->noticia->where('ativo', true)->paginate(1);
    }

    public function getNoticia($uuid)
    {
        return $this->noticia->where('uuid', $uuid)->first();
    }

    public function getNoticiasByCategoria($idCategoria)
    {
        return $this->noticia
            ->where('noticia_categoria_id', $idCategoria)
            ->where('ativo', true)
            ->paginate();
    }
}
