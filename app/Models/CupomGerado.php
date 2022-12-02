<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CupomGerado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cupom_id',
        'client_id',
        'data_resgate',
        'usado',
        'data_usado',
    ];

    public function cupom()
    {
        return $this->belongsTo(Cupom::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
