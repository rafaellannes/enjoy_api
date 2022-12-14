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
    protected $noticiaService, $noticiaCategoriaService;

    public function __construct(NoticiaService $noticiaService, NoticiaCategoriaService $noticiaCategoriaService)
    {
        $this->noticiaService = $noticiaService;
        $this->noticiaCategoriaService = $noticiaCategoriaService;
    }

    public function index(TenantRequest $request)
    {
        $noticias = $this->noticiaService->getNoticiasAtivas();

        if ($noticias->count() == 0) {
            return response()->json(['message' => 'Nenhuma notícia encontrada'], 404);
        }

        return NoticiaResource::collection($noticias);
    }

    public function show(TenantRequest $request, $uuid)
    {
        $validator = \Validator::make(['uuid' => $uuid], [
            'uuid' => 'required|uuid| exists:noticias,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Notícia não encontrada'], 404);
        }

        $noticia = $this->noticiaService->getNoticia($uuid);


        return new NoticiaResource($noticia);
    }

    public function noticiasByCategoria(TenantRequest $request, $uuidCategoria)
    {

        $validator = \Validator::make(['uuid' => $uuidCategoria], [
            'uuid' => 'required|uuid| exists:noticia_categorias,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }


        $categoria = $this->noticiaCategoriaService->noticiaCategoriaByUuid($uuidCategoria);
        $noticias = $this->noticiaService->getNoticiasByCategoria($categoria->id);

        return NoticiaResource::collection($noticias);
    }
}
