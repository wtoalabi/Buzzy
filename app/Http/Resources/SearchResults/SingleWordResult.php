<?php

namespace App\Http\Resources\SearchResults;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleWordResult extends JsonResource
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
          'word' => $this->word,
          'totalDescriptionsCount' => $this->descriptions->count(),
          'totalTagsCount' => $this->tagsCount(),
          'slug' => $this->slug,
          'viewsCount' => $this->viewsCount()
        ];
    }
}
