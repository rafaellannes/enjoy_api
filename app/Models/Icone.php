<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icone extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'icone',
        'link_img',
    ];
}
