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
        $noticias =  $this->noticiaRepository->getNoticiasAtivas();

        return $noticias;
    }

    public function getNoticia($uuid)
    {
        $noticia =  $this->noticiaRepository->getNoticia($uuid);

        return $noticia;
    }

    public function getNoticiasByCategoria($idCategoria)
    {
        $noticias =  $this->noticiaRepository->getNoticiasByCategoria($idCategoria);

        return $noticias;
    }

    public function getNoticiasBySearch($search)
    {
        $noticias =  $this->noticiaRepository->getNoticasBySearch($search);

        return $noticias;
    }
}
