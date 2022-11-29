<?php

namespace App\Repositories;

use App\Models\Servico;
use App\Models\ServicoCategoria;
use Illuminate\Support\Facades\DB;

class ServicoRepository
{
    protected $servico, $categoria;

    public function __construct(Servico $servico, ServicoCategoria $categoria)
    {
        $this->servico = $servico;
        $this->categoria = $categoria;
    }

    public function getServicosAtivos()
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)->paginate(3);
    }

    public function getServico($uuid)
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)
            ->where('uuid', $uuid)->first();
    }

    public function getServicosBySubcategoria($idSubcategoria)
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)
            ->where('subcategoria_id', $idSubcategoria)->paginate(3);
    }

    public function getServicosByCategoria($idCategoria)
    {
        return $this->servico
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)
            ->whereHas('subcategoria', function ($query) use ($idCategoria) {
                $query->where('categoria_id', $idCategoria);
            })->paginate(3);
    }

    public function getServicosBySearch($search)
    {
        return $this->servico->whereHas('subcategoria', function ($q) use ($search) {
            $q->where('descricao', 'like', "%{$search}%");
        })
            ->OrwhereHas('tags', function ($q) use ($search) {
                $q->where('descricao', 'like', "%{$search}%");
            })
            ->Orwhere('titulo', 'like', "%{$search}%")
            ->Orwhere('descricao', 'like', "%{$search}%")
            ->Orwhere('endereco', 'like', "%{$search}%")
            ->with('subcategoria.categoria', 'redes', 'tags.icone')
            ->where('ativo', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getServicosGroupByCategoria()
    {

        $result =  $this->categoria
            ->with('icone', 'subcategorias.servicosLimitados.tags.icone', 'subcategorias.servicosLimitados.redes', 'subcategorias.servicosLimitados.subcategoria.categoria')
            ->whereHas('subcategorias', function ($q) {
                $q->whereHas('servicos', function ($q) {
                    $q->where('ativo', true);
                });
            })
            ->get()
            ->take(2)
            ->toArray();



        return $result;

        /*     return  DB::table('servicos')
            ->join('subcategorias', 'servicos.subcategoria_id', '=', 'subcategorias.id')
            ->join('servico_categorias as cat', 'subcategorias.categoria_id', '=', 'cat.id')
            ->join('prefeituras', 'servicos.prefeitura_id', '=', 'prefeituras.id')
            ->select('servicos.*', 'cat.descricao as categoria', 'cat.uuid as uuid_categoria')
            ->where('servicos.ativo', true)
            ->where('prefeituras.uuid', request('uuid'))
            ->get(); */
    }
}
