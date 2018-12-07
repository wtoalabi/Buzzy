<?php

namespace App\Http\Resources\TermList;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleTerm extends JsonResource
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
          'url' => str_slug($this->title)
        ];
    }
}
