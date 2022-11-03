<?php

namespace App\Repositories;

use App\Models\Noticia;

class NoticiaRepository
{
    protected $noticia;

    public function __construct(Noticia $noticia)
    {
        $this->noticia = $noticia;
    }

    public function getNoticiasAtivas()
    {
        return $this->noticia->ativos();
    }
}
