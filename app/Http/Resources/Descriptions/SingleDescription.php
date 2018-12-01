<?php

namespace App\Http\Resources\Descriptions;

use App\Http\Resources\Sounds\SingleSound;
use App\Http\Resources\Symbols\SingleSymbol;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleDescription extends JsonResource
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
          'body' => $this->body,
          'symbol' => new SingleSymbol($this->symbol),
          'sound' => new SingleSound($this->sound)
        ];
    }
}
