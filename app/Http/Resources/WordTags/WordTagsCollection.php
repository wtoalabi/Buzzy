<?php

namespace App\Http\Resources\WordTags;

use App\Http\Resources\Tags\SingleTag;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WordTagsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($tag){
          return new SingleTag($tag);
        });
    }
}
