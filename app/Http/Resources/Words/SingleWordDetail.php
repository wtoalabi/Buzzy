<?php

namespace App\Http\Resources\Words;

use App\Http\Resources\Descriptions\DescriptionsCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleWordDetail extends JsonResource
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
          'slug' => str_slug($this->slug),
          'descriptions' => new DescriptionsCollection($this->descriptions),
          'user' => $this->user
        ];
    }
}
