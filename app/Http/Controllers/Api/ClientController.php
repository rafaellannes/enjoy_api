<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function update(RegisterRequest $request)
    {
        $clientLogado = $request->user();
        $client = $this->clientService->updateClient($request->all(), $clientLogado->id);

        return new ClientResource($client);
    }
}
