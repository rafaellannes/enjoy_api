<?php

namespace App\Services;

use App\Repositories\CLientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct(CLientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function createClient(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->clientRepository->createClient($data);
    }
}
