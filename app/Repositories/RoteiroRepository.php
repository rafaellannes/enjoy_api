<?php

namespace App\Repositories;

use App\Models\Roteiro;

class RoteiroRepository
{
    protected $roteiro;

    public function __construct(Roteiro $roteiro)
    {
        $this->roteiro = $roteiro;
    }

    public function roteirosByClient()
    {
        return $this->roteiro->where('client_id', auth()->user()->id)
            /* ->with('servicos') */
            ->get();
    }

    public function store(array $data)
    {
        return  $this->roteiro->create($data);

        //$roteiro->servicos()->attach($data['servicos']);

        /* return $roteiro; */
    }

    public function roteiroByUuid(string $uuid)
    {
        return $this->roteiro
            ->with('servicos')
            ->where('uuid', $uuid)
            ->first();
    }
}
