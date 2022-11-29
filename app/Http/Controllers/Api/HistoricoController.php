<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\HistoricoResource;
use App\Http\Resources\NoticiaResource;
use App\Http\Resources\ServicoResource;
use App\Services\ModelService;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{

    protected $modelService;

    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function index(TenantRequest $request)
    {
        $historicos = $request->user()->historicos;

        $historicos = $this->modelService->handleModelByUuid($historicos);

        return [
            'servicos' => ServicoResource::collection($historicos['servicos']),
            'noticias' => NoticiaResource::collection($historicos['noticias']),
        ];
    }


    public function store(TenantRequest $request)
    {
        $request->validate([
            'descricao' => ['required', 'string',  'min:3', 'max:255'],
            'model_uuid' => ['required', 'uuid'],
            'model_type' => ['required', 'in:Servico,Noticia'],

        ]);

        if ($request->user()->historicos()->where('model_uuid', $request->model_uuid)->first()) {
            return response()->json(['message' => 'Historico já existe'], 400);
        }

        $data['descricao'] = $request->descricao;
        $data['model_uuid'] = $request->model_uuid;
        $data['model_type'] = $request->model_type;

        $request->user()->historicos()->create($data);

        return response()->json(['message' => 'Historico criado com sucesso'], 201);
    }


    public function destroy(TenantRequest $request, $uuid)
    {

        $historico = $request->user()->historicos()->where('model_uuid', $uuid)->first();

        if (!$historico) {
            return response()->json(['message' => 'Historico não encontrado'], 404);
        }

        $historico->delete();

        return response()->json(['message' => 'Historico deletado com sucesso'], 200);
    }
}
