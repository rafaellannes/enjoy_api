<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['descricao', 'icone_id', 'ativo'];

    public function tagsAtivas()
    {
        return $this->where('ativo', true)->with('icone')->get();
    }



    public function icone()
    {
        return $this->belongsTo(Icone::class);
    }
}
