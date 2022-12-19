<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Services\RoteiroService;
use App\Tenant\Rules\UniqueTenant;
use Illuminate\Http\Request;

class RoteiroController extends Controller
{
    protected $roteiroService;

    public function __construct(RoteiroService $roteiroService)
    {
        $this->roteiroService = $roteiroService;
    }
    public function index(TenantRequest $request)
    {
        return $this->roteiroService->roteirosByClient();
    }

    public function store(TenantRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'titulo' => ['required', 'max:255', 'min:3', 'string', new UniqueTenant('roteiros')],
            'descricao' => 'required | max:255 | min:3 | string',
            'privado' => 'required | boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $this->roteiroService->store($request->except('uuid'));

        return response()->json(['message' => 'Roteiro criado com sucesso!'], 201);
    }

    public function show(TenantRequest $request, $uuid)
    {
        $roteiro = $this->roteiroService->roteiroByUuid($uuid);

        if (!$roteiro) {
            return response()->json(['message' => 'Roteiro não encontrado!'], 404);
        }

        return $roteiro;
    }

    public function update(TenantRequest $request, $uuid)
    {
        $roteiro = $this->roteiroService->roteiroByUuid($uuid);

        if (!$roteiro) {
            return response()->json(['message' => 'Roteiro não encontrado!'], 404);
        }

        $validator = \Validator::make($request->all(), [
            'titulo' => ['required', 'max:255', 'min:3', 'string', new UniqueTenant('roteiros', $roteiro->id)],
            'descricao' => 'sometimes | max:255 | min:3 | string',
            'privado' => 'required | boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roteiro->update($request->except('uuid'));

        return response()->json(['message' => 'Roteiro atualizado com sucesso!'], 200);
    }

    public function destroy(TenantRequest $request, $uuid)
    {
        $roteiro = $this->roteiroService->roteiroByUuid($uuid);

        if (!$roteiro) {
            return response()->json(['message' => 'Roteiro não encontrado!'], 404);
        }

        $roteiro->servicos()->detach();
        $roteiro->delete();

        return response()->json(['message' => 'Roteiro excluído com sucesso!'], 200);
    }


    public function attachRoteiroServico(TenantRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'roteiro_uuid' => 'required | exists:roteiros,uuid',
            'servico_uuid' => 'required | exists:servicos,uuid',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$this->roteiroService->attachRoteiroServico($request->all())) {
            return response()->json(['message' => 'Serviço já está no roteiro!'], 422);
        }

        return response()->json(['message' => 'Serviço adicionado ao roteiro com sucesso!'], 201);
    }

    public function dettachRoteiroServico(TenantRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'roteiro_uuid' => 'required | exists:roteiros,uuid',
            'servico_uuid' => 'required | exists:servicos,uuid',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$this->roteiroService->dettachRoteiroServico($request->all())) {
            return response()->json(['message' => 'Serviço não está no roteiro!'], 422);
        }

        return response()->json(['message' => 'Serviço removido do roteiro com sucesso!'], 200);
    }

    public function servicosAvailable(TenantRequest $request, $uuidRoteiro)
    {

        $validator = \Validator::make(['uuidRoteiro' => $uuidRoteiro], [
            'uuidRoteiro' => 'required|uuid| exists:roteiros,uuid'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return $this->roteiroService->servicosAvailableByRoteiro($uuidRoteiro);
    }
}
