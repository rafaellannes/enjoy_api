<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use Illuminate\Http\Request;

use App\Services\{
    CupomService,
    ServicoService
};

class CupomController extends Controller
{
    protected $cupomService, $servicoService;

    public function __construct(CupomService $cupomService, ServicoService $servicoService)
    {
        $this->cupomService = $cupomService;
        $this->servicoService = $servicoService;
    }

    public function cuponsDisponiveisByServico(TenantRequest $request, $uuidServico)
    {
        $user = $request->user();

        $validator = \Validator::make(['uuid' => $uuidServico], [
            'uuid' => 'required|uuid| exists:servicos,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        $servico = $this->servicoService->getServico($uuidServico);

        $cupons = $this->cupomService->getCuponsByServico($servico->id);

        //validar se o usuário já resgatou o cupom
        $cupons = $cupons->filter(function ($cupom) use ($user) {
            return !$cupom->gerados->contains('client_id', $user->id);
        });

        $cupons = array_values($cupons->toArray());

        return response()->json($cupons);
    }
}
