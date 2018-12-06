<?php

namespace App\Http\Resources\SearchResults;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleTermResult extends JsonResource
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
          'title' => $this->title,
          'totalSymbols' => $this->symbolsCount(),
          'totalSounds' => $this->soundsCount(),
          'url' => str_slug($this->title)
        ];
    }
}
