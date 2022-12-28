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

        $user = auth()->user();
        $user->roteirosLikes()->create(
            ['roteiro_id' => $roteiro->id,]
        );

        return response()->json(['message' => 'Roteiro curtido com sucesso!'], 201);
    }

    public function destroy(Request $request, $uuid)
    {
        $like = RoteirosLike::where('uuid', $uuid)->first();

        if (!$like) {
            return response()->json(['message' => 'Like não encontrado!'], 404);
        }

        $like->delete();

        return response()->json(['message' => 'Like removido com sucesso!'], 200);
    }
}
