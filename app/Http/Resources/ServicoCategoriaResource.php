<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\TranslateService;

class ServicoCategoriaResource extends JsonResource
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
            "descricao" => TranslateService::translate($this->descricao),
            "icone" => $this->icone->descricao,
            "identify" => $this->uuid,
        ];
    }
}
