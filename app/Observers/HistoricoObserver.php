<?php

namespace App\Observers;

use App\Models\Historico;
use Illuminate\Support\Str;


class HistoricoObserver
{
    public function creating(Historico $historico)
    {
        $historico->uuid = Str::uuid();
    }
}
