<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\TranslateService;

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

        /* dd($this['distance']); */
        foreach ($this['img'] as $img) {
            $imgArr[] = [
                'url' => 'storage/img/servicos/' . $img,
            ];
        }
        $array =  [
            'titulo' => TranslateService::translate($this['titulo']),
            'descricao' => TranslateService::translate($this['descricao']),
            'telefone' => $this['contato'],
            'endereco' => $this['endereco'],
            'img' => $imgArr,
            'latitude' => $this['latitude'],
            'longitude' => $this['longitude'],
            'identify' => $this['uuid'],
            'subcategoria' => [
                'descricao' => TranslateService::translate($this['subcategoria']['descricao']),
                'categoria' => TranslateService::translate($this['subcategoria']['categoria']['descricao']),
                'identify' => $this['subcategoria']['uuid'],
            ],
            'redes' => RedeSocialResource::collection($this['redes']),
            'tags' => TagResource::collection($this['tags']),
            /* 'distance' => $this->when($this['distance'], new DistanceResource($this['distance'])), */
        ];

        if (isset($this->pivot)) {
            $array['data_hora'] = $this->when($this->pivot, $this->pivot['data_hora']);
        }

        return $array;
    }
}
