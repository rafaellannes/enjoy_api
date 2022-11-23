<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\NoticiaResource;
use App\Http\Resources\ServicoResource;
use App\Services\NoticiaService;
use App\Services\ServicoService;
use Illuminate\Http\Request;

class PesquisaController extends Controller
{
    protected $servicoService, $noticiaService;

    public function __construct(ServicoService $servicoService, NoticiaService $noticiaService)
    {
        $this->servicoService = $servicoService;
        $this->noticiaService = $noticiaService;
    }

    public function search(TenantRequest $request, $search)
    {
        $validator = \Validator::make(['search' => $search], [
            'search' => 'required|string|min:3'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Pesquisa inválida'], 400);
        }

        $idioma = $request->idioma ?? 'pt';

        $noticias = $this->noticiaService->getNoticiasBySearch($search, $idioma);
        $servicos = $this->servicoService->getServicosBySearch($search, $idioma);


        return response()->json([
            'noticias' => NoticiaResource::collection($noticias),
            'servicos' => ServicoResource::collection($servicos)
        ]);
    }
}
