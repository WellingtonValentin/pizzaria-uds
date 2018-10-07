<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PizzaSabor extends Resource
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
            'tempo_adicional' => $this->tempo_adicional
        ];
    }
}
