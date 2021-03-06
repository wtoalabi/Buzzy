<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserDetail extends JsonResource
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
          'avatar' => $this->avatar(),
          'full_name' =>$this->full_name,
          'username' => $this->username,
          'words_count' => $this->words_count,
          'descriptions_count' => $this->descriptions_count,
          'changed_username' => $this->changed_username
        ];
    }
}
