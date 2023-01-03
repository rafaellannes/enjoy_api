<?php

namespace App\Http\Resources;

use App\Services\TranslateService;
use Illuminate\Http\Resources\Json\JsonResource;


class ServicosGroupBySubcategoriaResource extends JsonResource
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
            'descricao' => TranslateService::translate($this['descricao']),
            'uuid' => $this['uuid'],
            'servicos' => ServicoResource::collection($this['servicos']),
        ];
    }
}
