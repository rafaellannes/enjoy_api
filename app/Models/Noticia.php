<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'titulo',
        'img',
        'descricao',
        'data_evento',
        'prefeitura_id',
        'noticia_categoria_id',
        'user_id',
        'ativo',
    ];

    protected $casts = [
        'img' => 'array',
    ];

    /*     public function categoria()
    {
        return $this->belongsTo(NoticiaCategoria::class, 'noticia_categoria_id');
    }

    public function prefeitura()
    {
        return $this->belongsTo(Prefeitura::class);
    } */

    public function ativos()
    {
        return $this->where('ativo', true)->paginate();
    }
}
