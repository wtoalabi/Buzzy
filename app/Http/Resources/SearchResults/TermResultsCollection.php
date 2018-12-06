<?php

namespace App\Http\Resources\SearchResults;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TermResultsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($term){
          return new SingleTermResult($term);
        });
    }
}
