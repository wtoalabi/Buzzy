<?php

namespace App\Http\Resources\WordList;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleWord extends JsonResource
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
          'word' => $this->word,
          'url' => str_slug($this->word)
        ];
    }
}
