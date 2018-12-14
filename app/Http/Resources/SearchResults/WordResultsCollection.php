<?php

namespace App\Http\Resources\SearchResults;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WordResultsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($word){
          return new SingleWordResult($word);
        });
    }
}
