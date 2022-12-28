<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikesRoteiros extends Model
{
    use HasFactory;

    protected $table = 'likes_roteiros';

    protected $fillable = [
        'client_id',
        'roteiro_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function roteiro()
    {
        return $this->belongsTo(Roteiro::class);
    }
}
