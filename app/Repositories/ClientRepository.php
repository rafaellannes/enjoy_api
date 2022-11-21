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
}
