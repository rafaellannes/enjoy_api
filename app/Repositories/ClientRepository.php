<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function createClient($data)
    {
        return $this->client->create($data);
    }

    public function updateClient($data, Client $client)
    {
        $client->update($data);

        return $client;
    }

    public function removeClient(Client $client)
    {
        $client->delete();

        return $client;
    }
}
