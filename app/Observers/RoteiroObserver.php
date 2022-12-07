<?php

namespace App\Observers;

use App\Models\Roteiro;
use Illuminate\Support\Str;

class RoteiroObserver
{

    public function creating(Roteiro $roteiro)
    {
        $roteiro->client_id = auth()->user()->id;
        $roteiro->uuid = Str::uuid();
    }
}
