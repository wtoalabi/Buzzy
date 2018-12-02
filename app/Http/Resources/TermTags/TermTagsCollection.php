<?php

namespace App\Http\Resources\TermTags;

use App\Http\Resources\Tags\SingleTag;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TermTagsCollection extends ResourceCollection
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
