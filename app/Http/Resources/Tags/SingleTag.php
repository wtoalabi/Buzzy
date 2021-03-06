<?php

namespace App\Http\Resources\Tags;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleTag extends JsonResource
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
          'tag' => $this->tag,
          'slug' => $this->slug
        ];
    }
}
