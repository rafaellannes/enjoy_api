<?php

namespace App\Services;

use App\Repositories\NoticiaRepository;

class NoticiaService
{
    protected $noticiaRepository;
    protected $translateService;


    public function __construct(NoticiaRepository $noticiaRepository, TranslateService $translateService)
    {
        $this->noticiaRepository = $noticiaRepository;
        $this->translateService = $translateService;
    }


    public function getNoticiasAtivas($idioma)
    {
        $noticias =  $this->noticiaRepository->getNoticiasAtivas();

        foreach ($noticias as $noticia) {
            $noticia->titulo = $this->translateService->translate($noticia->titulo, $idioma);
            $noticia->descricao = $this->translateService->translate($noticia->descricao, $idioma);
        }


        return $noticias;
    }

    public function getNoticia($uuid, $idioma)
    {
        $noticia =  $this->noticiaRepository->getNoticia($uuid);


        $noticia->titulo = $this->translateService->translate($noticia->titulo, $idioma);
        $noticia->descricao = $this->translateService->translate($noticia->descricao, $idioma);

        return $noticia;
    }

    public function getNoticiasByCategoria($idCategoria, $idioma)
    {
        $noticias =  $this->noticiaRepository->getNoticiasByCategoria($idCategoria);

        foreach ($noticias as $noticia) {
            $noticia->titulo = $this->translateService->translate($noticia->titulo, $idioma);
            $noticia->descricao = $this->translateService->translate($noticia->descricao, $idioma);
        }
        return $noticias;
    }
}
