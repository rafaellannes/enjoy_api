<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\HistoricoResource;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function index(TenantRequest $request)
    {
        $historicos = $request->user()->historicos;

        return HistoricoResource::collection($historicos);
    }

    public function store(TenantRequest $request)
    {
        $request->validate([
            'descricao' => ['required', 'string',  'min:3', 'max:255']
        ]);

        $data['descricao'] = $request->descricao;
        $historico = $request->user()->historicos()->create($data);

        return new HistoricoResource($historico);
    }

    public function destroy(TenantRequest $request, $uuid)
    {

        $historico = $request->user()->historicos()->where('uuid', $uuid)->first();

        if (!$historico) {
            return response()->json(['message' => 'Historico não encontrado'], 404);
        }

        $historico->delete();

        return response()->json(['message' => 'Historico deletado com sucesso'], 200);
    }
}
