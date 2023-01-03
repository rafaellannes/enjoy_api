<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\TranslateService;

class ServicosPorSubcategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //$servicos = json_decode(json_encode($this['servicos']), FALSE); // convert to object

        return [
            'descricao' => TranslateService::translate($this['descricao']),
            'uuid' => $this['uuid'],
            'servicos' => ServicoResource::collection($this['servicos']),
        ];
    }
}
