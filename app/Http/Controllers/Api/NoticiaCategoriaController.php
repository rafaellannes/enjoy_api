<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\TenantRequest;
use App\Http\Resources\NoticiaCategoriaResource;
use App\Services\NoticiaCategoriaService;
use Illuminate\Http\Request;

class NoticiaCategoriaController extends Controller
{
    protected $noticiaCategoriaService;

    public function __construct(NoticiaCategoriaService $noticiaCategoriaService)
    {
        $this->noticiaCategoriaService = $noticiaCategoriaService;
    }

    public function index(TenantRequest $request)
    {

        $noticiaCategorias = $this->noticiaCategoriaService->getNoticiaCategorias();

        if ($noticiaCategorias->count() == 0) {
            return response()->json(['message' => 'Nenhuma categoria encontrada'], 404);
        }

        return NoticiaCategoriaResource::collection($noticiaCategorias);
    }
}
