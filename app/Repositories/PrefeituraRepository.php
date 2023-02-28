<?php

namespace App\Repositories;

use App\Models\Prefeitura;

class PrefeituraRepository
{
    protected $prefeitura;

    public function __construct(Prefeitura $prefeitura)
    {
        $this->prefeitura = $prefeitura;
    }

    public function all()
    {
        return $this->prefeitura->with('estado')->get();
    }
}
