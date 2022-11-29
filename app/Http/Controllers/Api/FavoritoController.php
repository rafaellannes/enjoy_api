<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoticiaResource;
use App\Http\Resources\ServicoResource;
use App\Services\ModelService;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    protected $modelService;

    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
    }

    public function index(Request $request)
    {
        $favoritos = $request->user()->favoritos;

        if ($favoritos->count() == 0) {
            return response()->json(['message' => 'Nenhum favorito encontrado'], 404);
        }

        $favoritos = $this->modelService->handleModelByUuid($favoritos);

        return [
            'servicos' => ServicoResource::collection($favoritos['servicos']),
            'noticias' => NoticiaResource::collection($favoritos['noticias']),
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_uuid' => ['required', 'uuid'],
            'model_type' => ['required', 'in:Servico,Noticia'],

        ]);

        if ($request->user()->favoritos()->where('model_uuid', $request->model_uuid)->first()) {
            return response()->json(['message' => 'Favorito já existe'], 400);
        }

        $data['descricao'] = $request->descricao;
        $data['model_uuid'] = $request->model_uuid;
        $data['model_type'] = $request->model_type;

        $request->user()->favoritos()->create($data);

        return response()->json(['message' => 'Favorito criado com sucesso'], 201);
    }

    public function destroy(Request $request, $model_uuid)
    {
        $favorito = $request->user()->favoritos()->where('model_uuid', $model_uuid)->first();

        if (!$favorito) {
            return response()->json(['message' => 'Favorito não encontrado'], 404);
        }

        $favorito->delete();

        return response()->json(['message' => 'Favorito deletado com sucesso'], 200);
    }
}
