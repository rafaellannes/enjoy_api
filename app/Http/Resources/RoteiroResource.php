<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoteiroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        return [
            'titulo' => $this['titulo'],
            'descricao' => $this['descricao'],
            'privado' => $this['privado'] ? true : false,
            'uuid' => $this['uuid'],
            'created_at' => $this['created_at'],
            /* 'servicos' => ServicoResource::collection($this['servicos']), */
            'servicos' => $this->when($this->relationLoaded('servicos'), ServicoResource::collection($this['servicos'])),
        ];
    }
}
