<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeServicosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        foreach ($this['subcategorias'] as $subcategoria) {
            foreach ($subcategoria['servicos_limitados'] as $service) {
                foreach ($service['img'] as $img) {
                    $imgArr[] = [
                        'url' => 'storage/img/servicos/' . $img,
                    ];
                }

                $servicos[] = [
                    'titulo' => $service['titulo'],
                    'descricao' => $service['descricao'],
                    'identify' => $service['uuid'],
                    'telefone' => $service['contato'],
                    'endereco' => $service['endereco'],
                    'img' => $imgArr,
                    'latitude' => $service['latitude'],
                    'longitude' => $service['longitude'],
                    'redes' => RedeSocialResource::collection($service['redes']),
                    'tags' => TagResource::collection($service['tags']),
                ];
            }
        }

        return [
            'descricao' => $this['descricao'],
            'uuid' => $this['uuid'],
            'icone' => $this['icone']['descricao'],
            'servicos' => $servicos,
        ];
    }
}
