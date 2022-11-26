<?php

namespace App\Services;

use App\Repositories\ClientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function createClient(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->clientRepository->createClient($data);
    }

    public function updateClient(array $data, int $id)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        return $this->clientRepository->updateClient($data, $id);
    }
}
