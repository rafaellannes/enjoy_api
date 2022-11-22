<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\ServicoCategoriaResource;
use App\Services\ServicoCategoriaService;
use Illuminate\Http\Request;

class ServicoCategoriaController extends Controller
{
    protected $servicoCategoriaService;

    public function __construct(ServicoCategoriaService $servicoCategoriaService)
    {
        $this->servicoCategoriaService = $servicoCategoriaService;
    }


    public function index(TenantRequest $request)
    {
        $idioma = $request->idioma ?? 'pt';
        $categorias = $this->servicoCategoriaService->getCategoriasAtivas($idioma);

        return ServicoCategoriaResource::collection($categorias);
    }
}
