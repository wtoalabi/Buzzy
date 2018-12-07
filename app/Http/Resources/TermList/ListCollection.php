<?php

namespace App\Http\Resources\TermList;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ListCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function ($item) {
          return new SingleTerm($item);
        });
    }
}
