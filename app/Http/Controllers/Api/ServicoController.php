<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\ServicoResource;
use App\Services\ServicoService;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    protected $servicoService;

    public function __construct(ServicoService $servicoService)
    {
        $this->servicoService = $servicoService;
    }

    public function index(TenantRequest $request)
    {
        $idioma = $request->idioma ?? 'pt';
        $servicos = $this->servicoService->getServicosAtivos($idioma);

        return ServicoResource::collection($servicos);
    }

    public function show(TenantRequest $request, $uuid)
    {
        $idioma = $request->idioma ?? 'pt';
        $servico = $this->servicoService->getServico($uuid, $idioma);

        return new ServicoResource($servico);
    }
}
