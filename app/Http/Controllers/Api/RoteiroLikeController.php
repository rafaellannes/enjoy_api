<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Services\RoteiroService;
use Illuminate\Http\Request;

class RoteiroLikeController extends Controller
{
    protected $roteiroService;

    public function __construct(RoteiroService $roteiroService)
    {
        $this->roteiroService = $roteiroService;
    }

    public function index(TenantRequest $request)
    {
        return $this->roteiroService->likesByClient();
    }

    public function store(TenantRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'roteiro_uuid' => 'required | exists:roteiros,uuid',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roteiro = $this->roteiroService->roteiroByUuid($request->roteiro_uuid);


        if ($this->roteiroService->checkAutorRoteiro($roteiro)) {
            return response()->json(['message' => 'Você não pode curtir seu próprio roteiro!'], 422);
        }

        if ($this->roteiroService->checkLikeRoteiro($roteiro)) {
            return response()->json(['message' => 'Você já curtiu este roteiro!'], 422);
        }

        $user = auth()->user();

        $user->roteirosLikes()->create(
            ['roteiro_id' => $roteiro->id,]
        );

        return response()->json(['message' => 'Roteiro curtido com sucesso!'], 201);
    }

    public function deslike(TenantRequest $request)
    {
        $validator = \Validator::make($request->all(), [
            'roteiro_uuid' => 'required | exists:roteiros,uuid',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $roteiro = $this->roteiroService->roteiroByUuid($request->roteiro_uuid);

        if (!$this->roteiroService->checkLikeRoteiro($roteiro)) {
            return response()->json(['message' => 'Você não curtiu este roteiro!'], 422);
        }

        $user = auth()->user();

        $user->roteirosLikes()->where('roteiro_id', $roteiro->id)->delete();

        return response()->json(['message' => 'Roteiro descurtido com sucesso!'], 201);
    }
}
