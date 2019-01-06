<?php

namespace App\Http\Resources\Descriptions;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserDescriptionsCollection extends ResourceCollection
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
          return new SingleUserDescription($description);
        });
    }
}
