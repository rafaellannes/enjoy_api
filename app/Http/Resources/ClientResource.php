<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'notificacao' => $this->notificacao,
            'descontos' => $this->descontos,
            "photo" =>  url("storage/{$this->photo}"),
            "sexo" => $this->sexo,
            'data_nascimento' => $this->data_nascimento,
            'favoritos' => ClientFavoritosResource::collection($this->favoritos),
        ];
    }
}
