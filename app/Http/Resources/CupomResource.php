<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CupomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (isset($this->servico)) {
            $servico = new ServicoResource($this->servico);
        } else {
            $servico = '';
        }



        return [
            'descricao' => $this['descricao'],
            'detalhes' => $this['detalhes'],
            'vigencia_inicio' => $this['vigencia_inicio'],
            'vigencia_fim' => $this['vigencia_fim'],
            'valor' => $this['valor'],
            'tipo' => $this['tipo'],
            'identify' => $this['uuid'],
            'servico' => $servico,
        ];
    }
}
