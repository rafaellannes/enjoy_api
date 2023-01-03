<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\TranslateService;

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
                $imgArr = [];
                foreach ($service['img'] as $img) {
                    $imgArr[] = [
                        'url' => 'storage/img/servicos/' . $img,
                    ];
                }

                $servicos[] = [
                    'titulo' => TranslateService::translate($service['titulo']),
                    'descricao' => TranslateService::translate($service['descricao']),
                    'identify' => $service['uuid'],
                    'telefone' => $service['contato'],
                    'endereco' => $service['endereco'],
                    'img' => $imgArr,
                    'latitude' => $service['latitude'],
                    'longitude' => $service['longitude'],
                    'subcategoria' => [
                        'descricao' => TranslateService::translate($service['subcategoria']['descricao']),
                        'categoria' => TranslateService::translate($service['subcategoria']['categoria']['descricao']),
                        'identify' => $service['subcategoria']['uuid'],
                    ],
                    'redes' => RedeSocialResource::collection($service['redes']),
                    'tags' => TagResource::collection($service['tags']),
                ];
            }
        }

        return [
            'descricao' => TranslateService::translate($this['descricao']),
            'uuid' => $this['uuid'],
            'icone' => $this['icone']['descricao'],
            'servicos' => $servicos,
        ];
    }
}
