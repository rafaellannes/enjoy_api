<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServicoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        foreach ($this['img'] as $img) {
            $imgArr[] = [
                'url' => 'storage/img/servicos/' . $img,
            ];
        }
        return [
            'titulo' => $this['titulo'],
            'descricao' => $this['descricao'],
            'telefone' => $this['contato'],
            'endereco' => $this['endereco'],
            'img' => $imgArr,
            'latitude' => $this['latitude'],
            'longitude' => $this['longitude'],
            'identify' => $this['uuid'],
            'subcategoria' => [
                'descricao' => $this['subcategoria']['descricao'],
                'categoria' => $this['subcategoria']['categoria']['descricao'],
                'identify' => $this['subcategoria']['uuid'],
            ],
            'redes' => RedeSocialResource::collection($this['redes']),
            'tags' => TagResource::collection($this['tags']),
        ];
    }
}
