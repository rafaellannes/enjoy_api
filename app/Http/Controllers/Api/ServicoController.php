<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\ServicoResource;
use App\Services\ServicoService;
use App\Services\SubcategoriaService;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    protected $servicoService, $subcategoriaService;

    public function __construct(ServicoService $servicoService, SubcategoriaService $subcategoriaService)
    {
        $this->servicoService = $servicoService;
        $this->subcategoriaService = $subcategoriaService;
    }

    public function index(TenantRequest $request)
    {
        $idioma = $request->idioma ?? 'pt';
        $servicos = $this->servicoService->getServicosAtivos($idioma);

        return ServicoResource::collection($servicos);
    }

    public function show(TenantRequest $request, $uuid)
    {

        $validator = \Validator::make(['uuid' => $uuid], [
            'uuid' => 'required|uuid|exists:servicos,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'UUID inválido'], 400);
        }

        $idioma = $request->idioma ?? 'pt';
        $servico = $this->servicoService->getServico($uuid, $idioma);

        return new ServicoResource($servico);
    }

    public function getServicosBySubcategoria(TenantRequest $request, $uuid)
    {

        $validator = \Validator::make(['uuid' => $uuid], [
            'uuid' => 'required|uuid|exists:subcategorias,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'UUID inválido'], 400);
        }

        $idioma = $request->idioma ?? 'pt';

        $subcategoria = $this->subcategoriaService->getSubcategoriaByUuid($uuid);

        $servicos = $this->servicoService->getServicosBySubcategoria($subcategoria->id, $idioma);

        return ServicoResource::collection($servicos);
    }
}
