<?php

namespace App\Observers;

use App\Models\Favorito;
use Illuminate\Support\Str;

class FavoritoObserver
{

    public function creating(Favorito $favorito)
    {
        $favorito->uuid = Str::uuid();
    }
}
