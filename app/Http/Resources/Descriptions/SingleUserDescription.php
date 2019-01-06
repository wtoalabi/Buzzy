<?php

namespace App\Http\Resources\Descriptions;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleUserDescription extends JsonResource
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
          'body' => str_limit($this->body, 50),
          'date_created' => $this->created_at->diffForHumans(),
          'like_counts' => $this->likesCount(),
          'word' => $this->word->slug
        ];
    }
}
