<?php

namespace App\Repositories;

use App\Models\Servico;
use App\Models\ServicoCategoria;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;

class ServicoRepository
{
    protected $servico, $categoria;

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

        $result =  $this->categoria
            ->with('icone', 'subcategorias.servicosLimitados.tags.icone', 'subcategorias.servicosLimitados.redes', 'subcategorias.servicosLimitados.subcategoria.categoria') // Pega as categorias com as subcategorias e os serviços limitados a 3
            ->whereHas('subcategorias', function ($q) {
                $q->whereHas('servicos', function ($q) {
                    $q->where('ativo', true);
                });
            })
            ->get()
            ->take(2) // Pega apenas as duas primeiras categorias
            ->toArray();



        return $result;
    }

    public function getServicosGroupBySubcategoria()
    {
        $result = $this->subcategoria
            ->whereHas('servicos', function ($q) {
                $q->where('ativo', true);
            })
            ->with('servicos')
            ->get();

        return $result;
    }
}
