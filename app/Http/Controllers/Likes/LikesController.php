<?php

namespace App\Http\Controllers\Likes;

use App\Http\Resources\Descriptions\SingleDescription;
use App\Models\Description;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class LikesController extends Controller
{
    public function toggleLikes($descriptionID){
      $description = Description::find($descriptionID);
      $userID = auth()->user()->id;
      if($description->liked()){
        Redis::HDEL("Likes:Descriptions:description-$descriptionID", $userID);
      }else{
        Redis::HSET("Likes:Descriptions:description-$descriptionID", $userID, 1);
      }
      return new SingleDescription($description);
    }
}
