<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\CupomResource;
use App\Http\Resources\ResgateCupomResource;
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

        $validator = \Validator::make(['uuid' => $uuidServico], [
            'uuid' => 'required|uuid| exists:servicos,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Serviço não encontrado'], 404);
        }

        $servico = $this->servicoService->getServico($uuidServico);

        $cupons = $this->cupomService->getCuponsByServico($servico->id);

        return CupomResource::collection($cupons);
    }

    public function resgatarCupom(TenantRequest $request, $uuidCupom)
    {

        $validator = \Validator::make(['uuid' => $uuidCupom], [
            'uuid' => 'required|uuid| exists:cupons,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Cupom não encontrado'], 404);
        }

        $cupom = $this->cupomService->getCupom($uuidCupom);

        $user = auth()->user();


        //validar se o usuário já resgatou o cupom
        if ($cupom->gerados->contains('client_id', $user->id)) {
            return response()->json(['message' => 'Você já resgatou esse cupom'], 400);
        }

        $cupomGerado = $cupom->gerados()->create([
            'client_id' => $user->id,
            'cupom_id' => $cupom->id,
            'data_resgate' => now(),
        ]);

        return response()->json(
            ['message' => 'Cupom resgatado com sucesso',],
            201

        );
    }

    public function cuponsByClient(TenantRequest $request)
    {
        $user = auth()->user();

        $cupons = $user->cuponsGerados()->with('cupom')->get();

        return ResgateCupomResource::collection($cupons);
    }
}
