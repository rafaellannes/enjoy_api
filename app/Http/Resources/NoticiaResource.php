<?php

namespace App\Http\Resources;

use App\Services\TranslateService;
use Illuminate\Http\Resources\Json\JsonResource;


class NoticiaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        /* dd($this->resource); */

        foreach ($this->img as $img) {
            $imgArr[] = [
                'url' => 'storage/img/noticias/' . $img,
            ];
        }

        return [
            'titulo' => TranslateService::translate($this->titulo),
            'img' => $imgArr,
            'descricao' => TranslateService::translate($this->descricao),
            'data_evento' => $this->data_evento,
            'categoria' => TranslateService::translate($this->categoria->descricao),
            'data_publicacao' => $this->created_at,
            'identify' => $this->uuid,

        ];
    }
}
