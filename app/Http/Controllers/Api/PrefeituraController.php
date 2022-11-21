<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrefeituraResource;
use App\Services\PrefeituraService;
use Illuminate\Http\Request;

class PrefeituraController extends Controller
{
    public function __construct(PrefeituraService $prefeituraService)
    {
        $this->prefeituraService = $prefeituraService;
    }

    public function index()
    {
        $prefeituras =  $this->prefeituraService->all();

        return PrefeituraResource::collection($prefeituras);
    }
}
