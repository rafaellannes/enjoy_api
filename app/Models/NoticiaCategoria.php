<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticiaCategoria extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['descricao', 'prefeitura_id', 'ativo'];


    public function noticias()
    {
        return $this->hasMany(Noticia::class);
    }

    public function prefeitura()
    {
        return $this->belongsTo(Prefeitura::class);
    }




}
