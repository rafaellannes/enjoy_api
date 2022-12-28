<?php

namespace App\Observers;

use App\Models\LikesRoteiros;
use Illuminate\Support\Str;

class RoteiroLikeObserver
{

    public function creating(LikesRoteiros $roteirosLike)
    {
        $roteirosLike->uuid = Str::uuid();
    }
}
