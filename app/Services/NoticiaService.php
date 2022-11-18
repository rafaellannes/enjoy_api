<?php

namespace App\Services;

use App\Repositories\NoticiaRepository;

class NoticiaService
{
    protected $noticiaRepository;

    public function __construct(NoticiaRepository $noticiaRepository)
    {
        $this->noticiaRepository = $noticiaRepository;
    }

    public function getNoticiasAtivas()
    {
        return $this->noticiaRepository->getNoticiasAtivas();
    }

    public function getNoticia($uuid)
    {
        return $this->noticiaRepository->getNoticia($uuid);
    }

    public function getNoticiasByCategoria($idCategoria)
    {
        return $this->noticiaRepository->getNoticiasByCategoria($idCategoria);
    }
}
