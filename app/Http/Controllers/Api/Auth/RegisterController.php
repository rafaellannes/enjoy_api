<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }


    public function register(RegisterRequest $request)
    {
        if (!$request->password) {
            return response()->json(['message' => 'Password is required'], 400);
        }

        $client = $this->clientService->createClient($request->all());

        return new ClientResource($client);
    }
}
