<?php

namespace App\Http\Resources\Descriptions;

use App\Http\Resources\Audios\SingleAudio;
use App\Http\Resources\Symbols\SingleSymbol;
use App\Http\Resources\Tags\TagsCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleDescription extends JsonResource
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
          'body' => $this->body,
          'symbol' => new SingleSymbol($this->symbol),
          'audio_file' => new SingleAudio($this->audio->first()),
        ];
    }
}
