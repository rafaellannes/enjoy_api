<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\SubcategoriaResource;
use App\Services\ServicoCategoriaService;
use App\Services\SubcategoriaService;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    protected $subcategoriaService, $servicoCategoriaService;

    public function __construct(SubcategoriaService $subcategoriaService, ServicoCategoriaService $servicoCategoriaService)
    {
        $this->subcategoriaService = $subcategoriaService;
        $this->servicoCategoriaService = $servicoCategoriaService;
    }


    public function subcategoriasByCategoria(TenantRequest $request, $uuid)
    {
        $validator = \Validator::make(['uuid' => $uuid], [
            'uuid' => 'required|uuid|exists:servico_categorias,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'UUID inválido'], 400);
        }


        $idioma = $request->idioma ?? 'pt';

        $categoria = $this->servicoCategoriaService->getCategoriaByUuid($uuid);

        $subcategorias = $this->subcategoriaService->getSubcategoriasByCategoria($categoria->id, $idioma);

        return SubcategoriaResource::collection($subcategorias);
    }
}
