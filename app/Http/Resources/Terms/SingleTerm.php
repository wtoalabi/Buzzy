<?php

namespace App\Http\Resources\Terms;

use App\Http\Resources\Comments\CommentsCollection;
use App\Http\Resources\TermTags\TermTagsCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleTerm extends JsonResource
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
          'title' => $this->title,
          'comments' => new CommentsCollection($this->comments),
          'tags' => new TermTagsCollection($this->tags)
        ];
    }
}
