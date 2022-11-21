<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefeitura extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao', 'dominio', 'uuid', 'ativo', 'url'
    ];

    protected $casts = [
        'created_at' => 'date:d/m/Y',
    ];

    /*    public function clients()
    {
        return $this->hasMany(Client::class);
    } */
}
