<?php

namespace App\Http\Resources\Descriptions;

use function foo\func;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DescriptionsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($description){
          return new SingleDescription($description);
        });
    }
}
