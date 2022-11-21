<?php

namespace App\Services;

use App\Repositories\PrefeituraRepository;

class PrefeituraService
{
    public function __construct(PrefeituraRepository $prefeituraRepository)
    {
        $this->prefeituraRepository = $prefeituraRepository;
    }

    public function all()
    {
        return $this->prefeituraRepository->all();
    }
}
