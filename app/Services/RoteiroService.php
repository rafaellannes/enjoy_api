<?php

namespace App\Services;

use App\Repositories\RoteiroRepository;

class RoteiroService
{
    protected $roteiroRepository;

    public function __construct(RoteiroRepository $roteiroRepository)
    {
        $this->roteiroRepository = $roteiroRepository;
    }

    public function roteirosByClient()
    {
        return $this->roteiroRepository->roteirosByClient();
    }

    public function store(array $data)
    {
        return $this->roteiroRepository->store($data);
    }

    public function roteiroByUuid(string $uuid)
    {
        return $this->roteiroRepository->roteiroByUuid($uuid);
    }
}
