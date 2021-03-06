<?php

namespace App\Http\Controllers\Likes;

use App\Helpers\Redis\Store;
use App\Http\Resources\Descriptions\SingleDescription;
use App\Models\Description;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class LikesController extends Controller
{
    public function toggleLikes($descriptionID){
      if(!auth()->check()){
        return response('You are not allowed to carry this action out!', 403);
      }
      $description = Description::find($descriptionID);
      $user = auth()->user()->id;
      Store::LikesCountFor($user, $description);
      return new SingleDescription($description);
    }
}
