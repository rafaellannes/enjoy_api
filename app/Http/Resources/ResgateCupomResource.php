<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResgateCupomResource extends JsonResource
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
            'data_resgate' => $this['data_resgate'],
            'usado' => $this['usado'] ? true : false,
            'data_usado' => $this['data_usado'] ? $this['data_usado'] : '',
            'cupom' => new CupomResource($this->cupom),

        ];
    }
}
