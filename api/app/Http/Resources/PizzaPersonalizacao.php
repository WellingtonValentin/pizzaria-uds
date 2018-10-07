<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PizzaPersonalizacao extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
            'valor' => $this->valor,
            'tempo_adicional' => $this->tempo_adicional
        ];
    }
}
