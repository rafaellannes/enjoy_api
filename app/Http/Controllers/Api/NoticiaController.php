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
        $idioma = $request->idioma ?? 'pt';
        $noticias = $this->noticiaService->getNoticiasAtivas($idioma);

       /*  dd($noticias); */

        return NoticiaResource::collection($noticias);
    }

    public function show(TenantRequest $request, $uuid)
    {
        $idioma = $request->idioma ?? 'pt';
        $noticia = $this->noticiaService->getNoticia($uuid, $idioma);

        return new NoticiaResource($noticia);
    }

    public function noticiasByCategoria(TenantRequest $request, $uuidCategoria)
    {
        $idioma = $request->idioma ?? 'pt';

        $categoria = $this->noticiaCategoriaService->noticiaCategoriaByUuid($uuidCategoria);
        $noticias = $this->noticiaService->getNoticiasByCategoria($categoria->id, $idioma);

        return NoticiaResource::collection($noticias);
    }
}
