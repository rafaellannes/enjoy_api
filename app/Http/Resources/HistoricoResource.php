<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoricoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

     return $this['servicos'];

        return
            [
                'servicos' => ServicoResource::collection($this->servicos),
                'noticias' => NoticiaResource::collection($this->noticias),
            ];
    }
}
