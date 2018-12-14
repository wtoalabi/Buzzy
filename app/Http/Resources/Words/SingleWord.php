<?php

namespace App\Http\Resources\Words;

use App\Http\Resources\Descriptions\DescriptionsCollection;
use App\Http\Resources\WordTags\WordTagsCollection;
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
          'descriptions' => new DescriptionsCollection($this->descriptions),
          'tags' => new WordTagsCollection($this->tags)
        ];
    }
}
