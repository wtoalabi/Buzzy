<?php

namespace App\Http\Resources\Comments;

use function foo\func;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($comment){
          return new SingleComment($comment);
        });
    }
}
