<?php

namespace App\Http\Resources\Words;

use App\Http\Resources\Descriptions\DescriptionsCollection;
use App\Http\Resources\Tags\TagsCollection;
use App\Http\Resources\User\UserDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleWordDetail extends JsonResource
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
          'sub_title' => $this->sub_title,
          'slug' => str_slug($this->slug),
          'descriptions' => new DescriptionsCollection($this->descriptions),
          'user' => new UserDetail($this->user),
          'tags' => new TagsCollection($this->tags)
        ];
    }
}
