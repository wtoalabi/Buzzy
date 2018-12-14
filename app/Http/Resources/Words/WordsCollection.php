<?php

namespace App\Http\Resources\Words;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WordsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($resource){
          return new SingleWord($resource);
        });
    }
}
