<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoticiaResource;
use App\Services\NoticiaService;
use Illuminate\Http\Request;
use App\Http\Requests\Tenant\TenantRequest;
use App\Services\NoticiaCategoriaService;

class NoticiaController extends Controller
{
    protected $noticiaService;

    public function __construct(NoticiaService $noticiaService, NoticiaCategoriaService $noticiaCategoriaService)
    {
        $this->noticiaService = $noticiaService;
        $this->noticiaCategoriaService = $noticiaCategoriaService;
    }

    public function index(TenantRequest $request)
    {
        $noticias = $this->noticiaService->getNoticiasAtivas();

        return NoticiaResource::collection($noticias);
    }

    public function show(TenantRequest $request, $uuid)
    {
        $noticia = $this->noticiaService->getNoticia($uuid);

        return new NoticiaResource($noticia);
    }

    public function noticiasByCategoria(TenantRequest $request, $uuidCategoria)
    {
        $categoria = $this->noticiaCategoriaService->noticiaCategoriaByUuid($uuidCategoria);
        $noticias = $this->noticiaService->getNoticiasByCategoria($categoria->id);

        return NoticiaResource::collection($noticias);
    }
}
