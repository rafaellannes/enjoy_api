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

    public function updateClient(array $data)
    {

        $client = auth()->user();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        if (isset($data['photo']) && $client->photo) {
            \Storage::delete($client->photo);
        }

        if (isset($data['photo'])) {
            $data['photo'] = $data['photo']->store('clients/profile', 'public');
        }

        return $this->clientRepository->updateClient($data, $client);
    }
}
