<?php

namespace App\Http\Resources\Audios;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleAudio extends JsonResource
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
          'url' => $this->url
        ];
    }
}
