<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoticiaResource;
use App\Services\NoticiaService;
use Illuminate\Http\Request;
use App\Http\Requests\Tenant\TenantRequest;


class NoticiaCategoriaController extends Controller
{
    protected $noticiaService;

    public function __construct(NoticiaService $noticiaService)
    {
        $this->noticiaService = $noticiaService;
    }

    public function index(/* TenantRequest $request */)
    {
        $noticias = $this->noticiaService->getNoticiasAtivas();

        return NoticiaResource::collection($noticias);
    }
}
