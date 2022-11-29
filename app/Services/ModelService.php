<?php

namespace App\Services;

class ModelService
{
    protected $noticiaService, $servicoService;

    public function __construct(NoticiaService $noticiaService, ServicoService $servicoService)
    {
        $this->noticiaService = $noticiaService;
        $this->servicoService = $servicoService;
    }

    public function handleModelByUuid($model, $idioma = null)
    {

        foreach ($model as $item) {
            if ($item->model_type == 'Noticia') {
                $noticias[] = $this->noticiaService->getNoticia($item->model_uuid, $idioma);
            } else if ($item->model_type == 'Servico') {
                $servicos[] = $this->servicoService->getServico($item->model_uuid, $idioma);
            }
        }


        $model = [
            'noticias' => $noticias,
            'servicos' => $servicos
        ];

        return $model;
    }
}
