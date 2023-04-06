<?php

namespace App\Repositories;

use App\Models\Servico;
use App\Models\ServicoCategoria;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;

class ServicoRepository
{
    protected $servico, $categoria, $subcategoria;

    public function __construct(Servico $servico, ServicoCategoria $categoria, Subcategoria $subcategoria)
    {
        $this->servico = $servico;
        $this->categoria = $categoria;
        $this->subcategoria = $subcategoria;
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

        $categorias = $this->categoria
            ->with('icone')
            ->whereHas('subcategorias.servicos')
            ->take(2)
            ->get();

        foreach ($categorias as $key => $categoria) {
            $categorias[$key]['subcategorias'] = $categoria->subcategorias()
                ->where('ativo', true)
                ->with(['servicos' => function ($query) {
                    $query->where('ativo', true)
                        ->take(4);
                }])
                ->get()
                ->filter(function ($subcategoria) {
                    return $subcategoria->servicos->isNotEmpty();
                })
                ->values();
        }

        return $categorias;
    }



    public function getServicosGroupBySubcategoria()
    {
        $result = $this->subcategoria
            ->whereHas('servicos', function ($q) {
                $q->where('ativo', true);
            })
            ->with('servicos.tags.icone', 'servicos.redes', 'servicos.subcategoria.categoria')
            ->get()
            ->toArray();

        return $result;
    }
}
