<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\HomeServicosResource;
use App\Http\Resources\ServicoResource;
use App\Services\ServicoCategoriaService;
use App\Services\ServicoService;
use App\Services\SubcategoriaService;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    protected $servicoService, $subcategoriaService, $servicoCategoriaService;

    public function __construct(ServicoService $servicoService, SubcategoriaService $subcategoriaService, ServicoCategoriaService $servicoCategoriaService)
    {
        $this->servicoService = $servicoService;
        $this->subcategoriaService = $subcategoriaService;
        $this->servicoCategoriaService = $servicoCategoriaService;
    }

    public function index(TenantRequest $request)
    {
        $servicos = $this->servicoService->getServicosAtivos();

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

        $servico = $this->servicoService->getServico($uuid);

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

        $subcategoria = $this->subcategoriaService->getSubcategoriaByUuid($uuid);

        $servicos = $this->servicoService->getServicosBySubcategoria($subcategoria->id);

        return ServicoResource::collection($servicos);
    }

    public function getServicosByCategoria(TenantRequest $request, $uuid)
    {

        $validator = \Validator::make(['uuid' => $uuid], [
            'uuid' => 'required|uuid|exists:servico_categorias,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'UUID inválido'], 400);
        }


        $categoria = $this->servicoCategoriaService->getCategoriaByUuid($uuid);

        $servicos = $this->servicoService->getServicosByCategoria($categoria->id);

        return ServicoResource::collection($servicos);
    }

    public function getServicosGroupByCategoria(TenantRequest $request)
    {

        $servicos = $this->servicoService->getServicosGroupByCategoria();


        return HomeServicosResource::collection($servicos);
    }

    public function getServicosGroupBySubcategoria(TenantRequest $request)
    {

        $servicos = $this->servicoService->getServicosGroupBySubcategoria();

        return $servicos;
    }
}
