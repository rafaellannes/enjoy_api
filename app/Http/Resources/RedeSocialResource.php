<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RedeSocialResource extends JsonResource
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
            'descricao' => $this->descricao,
            'icone' => $this->icone,
            'link' => $this->pivot->link,
        ];
    }
}
