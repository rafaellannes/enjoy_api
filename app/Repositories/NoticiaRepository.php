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
        return $this->noticia->where('ativo', true)->paginate(3);
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

    public function getNoticasBySearch($search)
    {
        return $this->noticia->whereHas('categoria', function ($query) use ($search) {
            $query->where('descricao', 'like', "%{$search}%");
        })
            ->orWhere('titulo', 'like', "%{$search}%")
            ->orWhere('descricao', 'like', "%{$search}%")
            ->where('ativo', true)
            ->orderBy('created_at', 'desc')
            ->paginate();
    }
}
